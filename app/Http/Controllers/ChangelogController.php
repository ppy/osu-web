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
use Cache;
use DB;

class ChangelogController extends Controller
{
    protected $section = 'home';
    protected $actionPrefix = 'changelog-';

    public function __construct()
    {
        $this->builds = Build::latestByStream(config('osu.changelog.update_streams'))
            ->get();
        
        $this->featuredBuild = null;

        foreach ($this->builds as $index => $build) {
            if ($build->stream_id === config('osu.changelog.featured_stream')) {
                $this->featuredBuild = $build;
                unset($this->builds[$index]);
            }
        }

        view()->share('builds', $this->builds);
        view()->share('featuredBuild', $this->featuredBuild);

        return parent::__construct();
    }

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

        $buildHistory = Cache::remember('build_propagation_history_global', config('osu.changelog.build_history_interval'), function () {
            return BuildPropagationHistory::changelog(null, config('osu.changelog.chart_days'))->get();
        });

        $chartOrder = collect([$this->featuredBuild])->merge($this->builds)->map(function ($el) {
            return $el->updateStream->pretty_name;
        });

        return view('changelog.index', compact('changelogs', 'buildHistory', 'chartOrder'));
    }

    public function show($buildId)
    {
        $changelogs = Changelog::default()
            ->with('user');

        $activeBuild = Build::default()
            ->with('updateStream')
            ->where('version', $buildId)
            ->firstOrFail();

        $changelogs =  $changelogs
            ->where('build', $activeBuild->version)
            ->visibleOnBuilds()
            ->get();

        if (count($changelogs) === 0) {
            $changelogs = [Changelog::placeholder()];
        }

        $buildHistory = Cache::remember("build_propagation_history_{$activeBuild->stream_id}", config('osu.changelog.build_history_interval'), function () use ($activeBuild) {
            return BuildPropagationHistory::changelog($activeBuild->stream_id, config('osu.changelog.chart_days'))->get();
        });

        $chartOrder = $buildHistory
            ->unique('label')
            ->pluck('label')
            ->sortByDesc(function ($el) {
                $date = explode('.', $el)[0];
                
                return Carbon::parse($date);
            })->values();

        return view('changelog.show', compact('changelogs', 'activeBuild', 'buildHistory', 'chartOrder'));
    }
}
