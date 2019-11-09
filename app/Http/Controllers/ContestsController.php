<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Http\Controllers;

use App\Models\Contest;
use Auth;

class ContestsController extends Controller
{
    protected $section = 'community';

    public function index()
    {
        $contests = Contest::orderBy('id', 'desc');

        if (!Auth::check() || !Auth::user()->isAdmin()) {
            $contests->where('visible', true);
        }

        return view('contests.index')
            ->with('contests', $contests->get());
    }

    public function show($id)
    {
        $contest = Contest::findOrFail($id);

        $user = Auth::user();
        if (!$contest->visible && (!$user || !$user->isAdmin())) {
            abort(404);
        }

        if ($contest->isVotingStarted() && isset($contest->extra_options['children'])) {
            $contestIds = $contest->extra_options['children'];
            $contests = Contest::whereIn('id', $contestIds)
                ->orderByField('id', $contestIds)
                ->get();
        } else {
            $contests = collect([$contest]);
        }

        if ($contest->isVotingStarted()) {
            return view('contests.voting')
                    ->with('contestMeta', $contest)
                    ->with('contests', $contests);
        } else {
            return view('contests.enter')
                ->with('contestMeta', $contest)
                ->with('contest', $contests->first());
        }
    }
}
