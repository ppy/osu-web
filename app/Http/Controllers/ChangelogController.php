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

/**
 * @group Changelog
 */
class ChangelogController extends Controller
{
    private $updateStreams = null;

    private static function changelogEntryMessageIncludes(?array $formats): array
    {
        static $validFormats = [
            'html' => 'changelog_entries.message_html',
            'markdown' => 'changelog_entries.message',
        ];

        if (is_api_request()) {
            $ret = [];
            foreach ($formats ?? [] as $format) {
                if (array_key_exists($format, $validFormats)) {
                    $ret[$format] ??= $validFormats[$format];
                }
            }

            return count($ret) === 0
                ? [$validFormats['html'], $validFormats['markdown']]
                : array_values($ret);
        } else {
            return [$validFormats['html']];
        }
    }

    /**
     * Get Changelog Listing
     *
     * Returns a listing of update streams, builds, and changelog entries.
     *
     * ---
     *
     * ### Response Format
     *
     * Field         | Type                            | Notes
     * --------------|---------------------------------|------
     * builds        | [Build](#build)[]               | Includes `changelog_entries`, `changelog_entries.github_user`, and changelog entry message in requested formats.
     * search.from   | string?                         | `from` input.
     * search.limit  | number                          | Always `21`.
     * search.max_id | number?                         | `max_id` input.
     * search.stream | string?                         | `stream` input.
     * search.to     | string?                         | `to` input.
     * streams       | [UpdateStream](#updatestream)[] | Always contains all available streams. Includes `latest_build` and `user_count`.
     *
     * @queryParam from string Minimum build version. No-example
     * @queryParam max_id integer Maximum build ID. No-example
     * @queryParam stream string Stream name to return builds from. No-example
     * @queryParam to string Maximum build version. No-example
     * @queryParam message_formats[] string `html`, `markdown`. Default to both.
     * @response {
     *   "streams": [
     *     {
     *       "id": 5,
     *       "name": "stable40",
     *       "display_name": "Stable",
     *       "is_featured": true,
     *       "latest_build": {
     *         "id": 5778,
     *         "version": "20210520.2",
     *         "display_version": "20210520.2",
     *         "users": 23683,
     *         "created_at": "2021-05-20T14:28:04+00:00",
     *         "update_stream": {
     *           "id": 5,
     *           "name": "stable40",
     *           "display_name": "Stable",
     *           "is_featured": true
     *         }
     *       },
     *       "user_count": 23965
     *     },
     *     // ...
     *   ],
     *   "builds": [
     *     {
     *       "id": 5823,
     *       "version": "2021.619.1",
     *       "display_version": "2021.619.1",
     *       "users": 0,
     *       "created_at": "2021-06-19T08:30:45+00:00",
     *       "update_stream": {
     *         "id": 7,
     *         "name": "lazer",
     *         "display_name": "Lazer",
     *         "is_featured": false
     *       },
     *       "changelog_entries": [
     *         {
     *           "id": 12925,
     *           "repository": "ppy/osu",
     *           "github_pull_request_id": 13572,
     *           "github_url": "https://github.com/ppy/osu/pull/13572",
     *           "url": null,
     *           "type": "fix",
     *           "category": "Reliability",
     *           "title": "Fix game crashes due to attempting localisation load for unsupported locales",
     *           "message_html": null,
     *           "major": true,
     *           "created_at": "2021-06-19T08:09:39+00:00",
     *           "github_user": {
     *             "id": 218,
     *             "display_name": "bdach",
     *             "github_url": "https://github.com/bdach",
     *             "osu_username": null,
     *             "user_id": null,
     *             "user_url": null
     *           }
     *         }
     *       ]
     *     },
     *     // ...
     *   ],
     *   "search": {
     *     "stream": null,
     *     "from": null,
     *     "to": null,
     *     "max_id": null,
     *     "limit": 21
     *   }
     * }
     */
    public function index()
    {
        $this->getUpdateStreams();

        $params = get_params(request()->all(), null, [
            'message_formats:string[]',
            'from',
            'max_id:int',
            'stream',
            'to',
        ], ['null_missing' => true]);

        $search = [
            'stream' => $params['stream'],
            'from' => $params['from'],
            'to' => $params['to'],
            'max_id' => $params['max_id'],
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

        $buildJsonIncludes = [
            'changelog_entries',
            'changelog_entries.github_user',
            ...static::changelogEntryMessageIncludes($params['message_formats']),
        ];
        $buildsJson = json_collection($builds, 'Build', $buildJsonIncludes);

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

    /**
     * Lookup Changelog Build
     *
     * Returns details of the specified build.
     *
     * ---
     *
     * ### Response Format
     *
     * See [Get Changelog Build](#get-changelog-build).
     *
     * @urlParam changelog string required Build version, update stream name, or build ID. Example: 20210520.2
     * @queryParam key string Unset to query by build version or stream name, or `id` to query by build ID. No-example
     * @queryParam message_formats[] string `html`, `markdown`. Default to both.
     * @response See "Get Changelog Build" response.
     */
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

        if (is_json_request()) {
            return $this->buildJson($build);
        }

        return ujs_redirect(build_url($build));
    }

    /**
     * Get Changelog Build
     *
     * Returns details of the specified build.
     *
     * ---
     *
     * ### Response Format
     *
     * A [Build](#build) with `changelog_entries`, `changelog_entries.github_user`, and `versions` included.
     *
     * @urlParam stream string required Update stream name. Example: stable40
     * @urlParam build string required Build version. Example: 20210520.2
     * @response {
     *   "id": 5778,
     *   "version": "20210520.2",
     *   "display_version": "20210520.2",
     *   "users": 22093,
     *   "created_at": "2021-05-20T14:28:04+00:00",
     *   "update_stream": {
     *     "id": 5,
     *     "name": "stable40",
     *     "display_name": "Stable",
     *     "is_featured": true
     *   },
     *   "changelog_entries": [
     *     {
     *       "id": null,
     *       "repository": null,
     *       "github_pull_request_id": null,
     *       "github_url": null,
     *       "url": "https://osu.ppy.sh/home/news/2021-05-20-spring-fanart-contest-results",
     *       "type": "fix",
     *       "category": "Misc",
     *       "title": "Spring is here!",
     *       "message_html": "<div class='changelog-md'><p class=\"changelog-md__paragraph\">New seasonal backgrounds ahoy! Amazing work by the artists.</p>\n</div>",
     *       "major": true,
     *       "created_at": "2021-05-20T10:56:49+00:00",
     *       "github_user": {
     *         "id": null,
     *         "display_name": "peppy",
     *         "github_url": null,
     *         "osu_username": "peppy",
     *         "user_id": 2,
     *         "user_url": "https://osu.ppy.sh/users/2"
     *       }
     *     }
     *   ],
     *   "versions": {
     *     "previous": {
     *       "id": 5774,
     *       "version": "20210519.3",
     *       "display_version": "20210519.3",
     *       "users": 10,
     *       "created_at": "2021-05-19T11:51:48+00:00",
     *       "update_stream": {
     *         "id": 5,
     *         "name": "stable40",
     *         "display_name": "Stable",
     *         "is_featured": true
     *       }
     *     }
     *   }
     * }
     */
    public function build($streamName, $version)
    {

        $stream = UpdateStream::where('name', '=', $streamName)->firstOrFail();
        $build = $stream
            ->builds()
            ->default()
            ->where('version', $version)
            ->with([
                'defaultChangelogs.user',
                'defaultChangelogEntries.githubUser.user',
                'defaultChangelogEntries.repository',
            ])->firstOrFail();
        $buildJson = $this->buildJson($build);

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

    private function buildJson(Build $build): array
    {
        return json_item($build, 'Build', [
            'changelog_entries',
            'changelog_entries.github_user',
            ...static::changelogEntryMessageIncludes(get_arr(request('message_formats'))),
            'versions',
        ]);
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
