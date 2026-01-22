<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;
use App\Transformers\TeamMemberTransformer;
use App\Transformers\UserCompactTransformer;
use Symfony\Component\HttpFoundation\Response;

class MembersController extends Controller
{
    const int PAGE_SIZE = 50;

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth')->except(['index']);
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

        if (!is_json_request()) {
            priv_check('TeamUpdate', $team)->ensureCan();

            $team->load('members.user');

            return ext_view('teams.members.index', compact('team'));
        }

        $offset = max(0, get_int(\Request::input('offset')) ?? 0);
        $limit = \Number::clamp(get_int(\Request::input('limit')) ?? self::PAGE_SIZE, 1, 100);
        $withLeader = get_bool(\Request::input('withLeader')) ?? true;

        $query = $team->members()->default()
            ->with(prefix_strings('user.', UserCompactTransformer::CARD_INCLUDES_PRELOAD))
            ->join('phpbb_users', 'phpbb_users.user_id', '=', 'team_members.user_id')
            ->orderBy('username')
            ->offset($offset)->limit($limit);

        if (!$withLeader) {
            $query->whereNot('phpbb_users.user_id', $team->leader_id);
        }

        $members = $query->get();
        $count = $team->members()->default()->count();

        return response()->json([
            'items' => json_collection(
                $members,
                new TeamMemberTransformer(),
                prefix_strings('user.', UserCompactTransformer::CARD_INCLUDES)
            ),
            'total' => $withLeader ? $count : $count - 1,
        ]);
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
