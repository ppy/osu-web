<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

use App\Models\Build;
use App\Models\BuildPropagationHistory;
use App\Models\Changelog;
use Carbon\Carbon;
use DB;

class ChangelogController extends Controller
{
    protected $section = 'home';
    protected $actionPrefix = 'changelog-';

    public function index()
    {
        $from = Changelog::default()->first();
        $changelogs = Changelog::default()
            ->with('user')
            ->where('date', '>', $from->date->subWeeks(config('osu.changelog.recent_weeks')))
            ->get()
            ->groupBy(function ($item) {
                return i18n_date($item->date);
            });

        $streams = Build::latestByStream(config('osu.changelog.update_streams'))
            ->get();

        $featuredStream = null;
        $activeStream = null;

        foreach ($streams as $index => $stream) {
            if ($stream->stream_id === config('osu.changelog.featured_stream')) {
                $featuredStream = $stream;
                unset($streams[$index]);
            }
        }

        $buildsTable = with(new Build)->getTable();
        $propagationTable = with(new BuildPropagationHistory)->getTable();
        $buildHistory = BuildPropagationHistory::changelog($activeStream, config('osu.changelog.chart_days'))->get();

        $chartOrder = null;

        $chartOrder = collect([$featuredStream])->merge($streams)->map(function ($el) {
            return $el->updateStream->pretty_name;
        });

        return view('changelog.index', compact('changelogs', 'streams', 'featuredStream', 'build', 'buildHistory', 'chartOrder'));
    }

    public function show($buildId)
    {
        $changelogs = Changelog::default()
            ->with('user');

        $build = Build::default()
            ->with('updateStream')
            ->where('version', $buildId)
            ->firstOrFail();

        $changelogs =  $changelogs
            ->where('build', $build->version)
            ->visibleOnBuilds()
            ->get();

        if (count($changelogs) === 0) {
            $changelogs = [Changelog::placeholder()];
        }
                
        $streams = Build::latestByStream(config('osu.changelog.update_streams'))
            ->get();

        $featuredStream = null;
        $activeStream = null;

        foreach ($streams as $index => $stream) {
            if ($stream->version === $buildId) {
                $activeStream = $stream->stream_id;
            }

            if ($stream->stream_id === config('osu.changelog.featured_stream')) {
                $featuredStream = $stream;
                unset($streams[$index]);
            }
        }

        $buildsTable = with(new Build)->getTable();
        $propagationTable = with(new BuildPropagationHistory)->getTable();
        $buildHistory = BuildPropagationHistory::changelog($activeStream, config('osu.changelog.chart_days'))->get();

        $chartOrder = null;

        $chartOrder = BuildPropagationHistory::baseChangelog($activeStream, config('osu.changelog.chart_days'))
            ->select(DB::raw('DISTINCT(version) as version'))
            ->get()
            ->sortByDesc(function ($el) {
                $date = explode('.', $el->version)[0];

                return Carbon::parse($date);
            })->map(function ($el) {
                return $el->version;
            })->values();

        return view('changelog.show', compact('changelogs', 'streams', 'featuredStream', 'build', 'buildHistory', 'chartOrder'));
    }
}
