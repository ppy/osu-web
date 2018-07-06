<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Http\Controllers;

use App\Libraries\GithubImporter;
use App\Models\Build;
use App\Models\BuildPropagationHistory;
use App\Models\Changelog;
use App\Models\UpdateStream;
use Cache;

class ChangelogController extends Controller
{
    protected $section = 'home';
    protected $actionPrefix = 'changelog-';

    private $latestBuilds = null;

    public function index()
    {
        $this->getBuilds();

        $chartConfig = Cache::remember(
            'chart_config_global',
            config('osu.changelog.build_history_interval'),
            function () {
                return $this->chartConfig(null);
            }
        );

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
            ])->orderBy('build_id', 'DESC')
            ->get();

        if (count($builds) === 1 && request('no_redirect') !== '1') {
            return ujs_redirect(build_url($builds[0]));
        }

        $buildsJson = json_collection($builds, 'Build', [
            'changelog_entries',
            'changelog_entries.github_user',
        ]);

        $indexJson = [
            'builds' => $buildsJson,
            'search' => $search,
        ];

        if (request()->expectsJson()) {
            return $indexJson;
        } else {
            return view('changelog.index', compact('chartConfig', 'indexJson'));
        }
    }

    public function github()
    {
        $token = config('osu.changelog.github_token');

        list($algo, $signature) = explode('=', request()->header('X-Hub-Signature'));
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
        $build = Build::default()->where('version', '=', $version)->firstOrFail();

        if ($build === null) {
            $normalizedVersion = preg_replace('#[^0-9.]#', '', $normalizedVersion);

            $build = Build::default()->where('version', '=', $normalizedVersion)->firstOrFail();
        }

        return ujs_redirect(build_url($build));
    }

    public function build($streamName, $version)
    {
        $this->getBuilds();

        $stream = UpdateStream::where('name', '=', $streamName)->firstOrFail();
        $build = json_item(
            $stream->builds()->default()->where('version', $version)->firstOrFail(),
            'Build',
            ['changelog_entries', 'changelog_entries.github_user', 'versions']
        );

        $chartConfig = Cache::remember(
            "chart_config_{$build['update_stream']['id']}",
            config('osu.changelog.build_history_interval'),
            function () use ($build) {
                return $this->chartConfig($build['update_stream']);
            });

        return view('changelog.build', compact('build', 'chartConfig'));
    }

    private function getBuilds()
    {
        $this->latestBuilds = json_collection(
            Build::latestByStream(config('osu.changelog.update_streams'))
                ->get()
                ->sortBy(function ($i) {
                    return $i->isFeatured() ? 0 : 1;
                }),
            'Build'
        );

        view()->share('latestBuilds', $this->latestBuilds);
    }

    private function chartConfig($stream)
    {
        $history = BuildPropagationHistory::changelog($stream['id'] ?? null, config('osu.changelog.chart_days'))->get();

        if ($stream === null) {
            $chartOrder = array_map(function ($b) {
                return $b['update_stream']['display_name'];
            }, $this->latestBuilds);
        } else {
            $chartOrder = $this->buildChartOrder($history);
            $streamName = kebab_case($stream['display_name']);
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
