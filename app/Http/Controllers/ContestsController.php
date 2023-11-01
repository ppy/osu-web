<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Models\Contest;
use Auth;

class ContestsController extends Controller
{
    public function index()
    {
        $contests = Contest::orderBy('id', 'desc');

        if (!Auth::check() || !Auth::user()->isGroup('admin')) {
            $contests->where('visible', true);
        }

        return ext_view('contests.index', [
            'contests' => $contests->get(),
        ]);
    }

    public function show($id)
    {
        $contest = Contest::findOrFail($id);

        $user = Auth::user();
        if (!$contest->visible && (!$user || !$user->isGroup('admin'))) {
            abort(404);
        }

        if ($contest->isVotingStarted() && isset($contest->getExtraOptions()['children'])) {
            $contestIds = $contest->getExtraOptions()['children'];
            $contests = Contest::whereIn('id', $contestIds)
                ->orderByField('id', $contestIds)
                ->get();
        } else {
            $contests = collect([$contest]);
        }

        if ($contest->isVotingStarted()) {
            if ($contest->isVotingOpen()) {
                // TODO: add support for $contests requirement instead of at parent
                try {
                    $contest->assertVoteRequirement($user);
                } catch (InvariantException $e) {
                    $noVoteReason = $e->getMessage();
                }
            }

            return ext_view('contests.voting', [
                'contestMeta' => $contest,
                'contests' => $contests,
                'noVoteReason' => $noVoteReason ?? null,
            ]);
        } else {
            return ext_view('contests.enter', [
                'contestMeta' => $contest,
                'contest' => $contests->first(),
            ]);
        }
    }
}
