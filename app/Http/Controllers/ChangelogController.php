<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Libraries\CommentBundle;
use App\Libraries\GithubImporter;
use App\Models\Build;
use App\Models\BuildPropagationHistory;
use App\Models\UpdateStream;
use Cache;

class ChangelogController extends Controller
{
    private $updateStreams = null;

    public function index()
    {
        $this->getUpdateStreams();

        $search = [
            'stream' => presence(request('stream')),
            'from' => presence(request('from')),
            'to' => presence(request('to')),
            'max_id' => get_int(request('max_id')),
            'limit' => 21,
        ];

        $builds = Build::search($search)
            ->default()
            ->with([
                'updateStream',
                'defaultChangelogs.user',
                'defaultChangelogEntries.githubUser.user',
                'defaultChangelogEntries.repository',
            ])->orderBy('build_id', 'DESC')
            ->get();

        if (!is_json_request() && count($builds) === 1 && request('no_redirect') !== '1') {
            return ujs_redirect(build_url($builds[0]));
        }

        $buildsJson = json_collection($builds, 'Build', [
            'changelog_entries',
            'changelog_entries.github_user',
        ]);

        $indexJson = [
            'streams' => $this->updateStreams,
            'builds' => $buildsJson,
            'search' => $search,
        ];

        if (is_json_request()) {
            return $indexJson;
        } else {
            $chartConfig = Cache::remember(
                'chart_config_global',
                config('osu.changelog.build_history_interval'),
                function () {
                    return $this->chartConfig(null);
                }
            );

            return ext_view('changelog.index', compact('chartConfig', 'indexJson'));
        }
    }

    public function github()
    {
        $token = config('osu.changelog.github_token');

        $signatureHeader = explode('=', request()->header('X-Hub-Signature'));

        if (count($signatureHeader) !== 2) {
            abort(422, 'invalid signature header');
        }

        [$algo, $signature] = $signatureHeader;

        if (!in_array($algo, hash_hmac_algos(), true)) {
            abort(422, 'unknown signature algorithm');
        }

        $hash = hash_hmac($algo, request()->getContent(), $token);

        if (!hash_equals((string) $hash, (string) $signature)) {
            abort(403);
        }

        (new GithubImporter([
            'eventType' => request()->header('X-GitHub-Event'),
            'data' => request()->json()->all(),
        ]))->import();

        return [];
    }

    public function show($version)
    {
        if (request('key') === 'id') {
            $build = Build::default()->findOrFail($version);
        } else {
            // Search by exact version first.
            $build = Build::default()->where('version', '=', $version)->first();
        }

        // Failing that, check if $version is actually a stream name.
        if ($build === null) {
            $stream = UpdateStream::where('name', '=', $version)->first();

            if ($stream !== null) {
                $build = $stream->builds()->default()->orderBy('build_id', 'desc')->first();
            }
        }

        // When there's no build found, strip everything but numbers and dots then search again.
        // 404 if still nothing found.
        if ($build === null) {
            $normalizedVersion = preg_replace('#[^0-9.]#', '', $version);

            $build = Build::default()->where('version', '=', $normalizedVersion)->firstOrFail();
        }

        return ujs_redirect(build_url($build));
    }

    public function build($streamName, $version)
    {

        $stream = UpdateStream::where('name', '=', $streamName)->firstOrFail();
        $build = $stream->builds()->default()->where('version', $version)->firstOrFail();
        $buildJson = json_item($build, 'Build', [
            'changelog_entries', 'changelog_entries.github_user', 'versions',
        ]);

        if (is_json_request()) {
            return $buildJson;
        }

        $this->getUpdateStreams();

        $commentBundle = CommentBundle::forEmbed($build);

        $chartConfig = Cache::remember(
            "chart_config:v2:{$build->updateStream->getKey()}",
            config('osu.changelog.build_history_interval'),
            function () use ($build) {
                return $this->chartConfig($build->updateStream);
            }
        );

        return ext_view('changelog.build', compact('build', 'buildJson', 'chartConfig', 'commentBundle'));
    }

    private function getUpdateStreams()
    {
        $this->updateStreams = json_collection(
            UpdateStream::whereHasBuilds()
                ->orderByField('stream_id', config('osu.changelog.update_streams'))
                ->find(config('osu.changelog.update_streams'))
                ->sortBy(function ($i) {
                    return $i->isFeatured() ? 0 : 1;
                }),
            'UpdateStream',
            ['latest_build', 'user_count']
        );

        view()->share('updateStreams', $this->updateStreams);
    }

    private function chartConfig($stream)
    {
        $history = BuildPropagationHistory::changelog(optional($stream)->getKey(), config('osu.changelog.chart_days'))->get();

        if ($stream === null) {
            $chartOrder = array_map(function ($b) {
                return $b['display_name'];
            }, $this->updateStreams);
        } else {
            $chartOrder = $this->buildChartOrder($history);
            $streamName = kebab_case($stream->pretty_name);
        }

        return [
            'build_history' => json_collection($history, 'BuildHistoryChart'),
            'order' => $chartOrder,
            'stream_name' => $streamName ?? null,
        ];
    }

    private function buildChartOrder($history)
    {
        return $history
            ->unique('label')
            ->pluck('label')
            ->sortByDesc(function ($label) {
                $parts = explode('.', $label);

                if (count($parts) >= 1 && strlen($parts[0]) >= 8) {
                    $date = substr($parts[0], 0, 8);
                } elseif (count($parts) >= 2 && strlen($parts[0]) === 4 && strlen($parts[1]) >= 3 && strlen($parts[1]) <= 4) {
                    $date = $parts[0].str_pad($parts[1], 4, '0', STR_PAD_LEFT);
                }

                return $date ?? null;
            })->values();
    }
}
