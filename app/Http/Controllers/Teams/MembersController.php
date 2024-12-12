<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TeamMember;
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

        if ($teamMember->user_id === \Auth::user()->getKey()) {
            abort(422, 'can not remove self from team');
        }

        priv_check('TeamUpdate', $teamMember->team)->ensureCan();

        $teamMember->delete();
        \Session::flash('popup', osu_trans('teams.members.destroy.success'));

        return response(null, 204);
    }

    public function index(string $teamId): Response
    {
        $team = Team::findOrFail($teamId);

        priv_check('TeamUpdate', $team)->ensureCan();

        return ext_view('teams.members.index', compact('team'));
    }
}
