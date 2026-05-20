<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class MembersController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function destroy(string $teamId, string $userId): Response
    {
        $teamMember = TeamMember::where([
            'team_id' => $teamId,
            'user_id' => $userId,
        ])->firstOrFail();
        $team = $teamMember->team;

        priv_check('TeamUpdate', $team)->ensureCan();

        $team->removeMember($teamMember);

        \Session::flash('popup', osu_trans('teams.members.destroy.success'));

        return response()->noContent();
    }

    public function index(string $teamId): Response
    {
        $team = Team::findOrFail($teamId);

        priv_check('TeamUpdate', $team)->ensureCan();

        $team->load('members.user');

        return ext_view('teams.members.index', compact('team'));
    }

    public function setLeader(string $teamId, string $userId): Response
    {
        $newLeader = User::default()->findOrFail($userId);
        $team = Team::findOrFail($teamId);
        $teamMember = TeamMember::where([
            'team_id' => $team->getKey(),
            'user_id' => $newLeader->getKey(),
        ])->firstOrFail();

        priv_check('TeamUpdate', $team)->ensureCan();

        $team->update(['leader_id' => $newLeader->getKey()]);

        \Session::flash('popup', osu_trans(
            'teams.members.set_leader.success',
            ['user' => $newLeader->username],
        ));

        return ujs_redirect(route('teams.show', $team));
    }
}
