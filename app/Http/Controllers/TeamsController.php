<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Exceptions\ModelNotSavedException;
use App\Models\Beatmap;
use App\Models\Team;
use App\Models\User;
use App\Transformers\UserCompactTransformer;
use Symfony\Component\HttpFoundation\Response;

class TeamsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth', ['only' => ['create', 'part']]);
    }

    public static function pageLinks(string $current, Team $team): array
    {
        $ret = [
            [
                'active' => $current === 'show',
                'title' => osu_trans('teams.header_links.show'),
                'url' => route('teams.show', ['team' => $team->getKey()]),
            ],
            [
                'active' => $current === 'leaderboard',
                'title' => osu_trans('teams.header_links.leaderboard'),
                'url' => route('teams.leaderboard', ['team' => $team->getKey()]),
            ],
        ];

        if (priv_check('TeamUpdate', $team)->can()) {
            $applicationCount = $team->applications()->count();
            $ret[] = [
                'active' => $current === 'edit',
                'title' => osu_trans('teams.header_links.edit'),
                'url' => route('teams.edit', ['team' => $team->getKey()]),
            ];
            $ret[] = [
                'active' => $current === 'members.index',
                'count' => $applicationCount === 0 ? null : $applicationCount,
                'title' => osu_trans('teams.header_links.members.index'),
                'url' => route('teams.members.index', ['team' => $team->getKey()]),
            ];
        }

        return $ret;
    }

    public function create(): Response
    {
        $currentUser = \Auth::user();
        $teamId = $currentUser?->team?->getKey() ?? $currentUser?->teamApplication?->team_id;
        if ($teamId !== null) {
            return ujs_redirect(route('teams.show', $teamId));
        }

        return ext_view('teams.create', [
            'team' => new Team(),
        ]);
    }

    public function destroy(string $id): Response
    {
        $team = Team::findOrFail($id);
        priv_check('TeamUpdate', $team)->ensureCan();

        $team->delete();
        \Session::flash('popup', osu_trans('teams.destroy.ok'));

        return ujs_redirect(route('home'));
    }

    public function edit(string $id): Response
    {
        $team = Team::findOrFail($id);
        priv_check('TeamUpdate', $team)->ensureCan();

        return ext_view('teams.edit', compact('team'));
    }

    public function leaderboard(string $id, ?string $ruleset = null): Response
    {
        $team = Team::findOrFail($id);
        $ruleset ??= Beatmap::modeStr($team->default_ruleset_id);
        $statisticsRelationName = User::statisticsRelationName($ruleset);
        if ($statisticsRelationName === null) {
            throw new InvariantException(osu_trans('beatmaps.invalid_ruleset'));
        }
        $leaderboard = $team
            ->members
            ->loadMissing("user.{$statisticsRelationName}")
            ->map(fn ($member) =>
                (
                    $member->user->$statisticsRelationName
                    ?? $member->user->$statisticsRelationName()->make()
                )->setRelation('user', $member->user))
            ->sortByDesc(['rank_score', 'total_score'])
            ->values();

        return ext_view('teams.leaderboard', compact('leaderboard', 'ruleset', 'team'));
    }

    public function part(string $id): Response
    {
        $team = Team::findOrFail($id);
        priv_check('TeamPart', $team)->ensureCan();

        $team->members()->findOrFail(\Auth::user()->getKey())->delete();
        \Session::flash('popup', osu_trans('teams.part.ok'));

        return ujs_redirect(route('teams.show', ['team' => $team]));
    }

    public function show(string $id): Response
    {
        $team = Team
            ::with(array_map(
                fn (string $preload): string => "members.user.{$preload}",
                UserCompactTransformer::CARD_INCLUDES_PRELOAD,
            ))->findOrFail($id);

        return ext_view('teams.show', compact('team'));
    }

    public function store(): Response
    {
        priv_check('TeamStore')->ensureCan();

        $params = get_params(\Request::all(), 'team', [
            'name',
            'short_name',
        ]);

        $user = \Auth::user();
        $team = (new Team([...$params, 'leader_id' => $user->getKey()]));
        try {
            \DB::transaction(function () use ($params, $team, $user) {
                $team->saveOrExplode();
                $team->members()->createOrFirst(['user_id' => $user->getKey()]);
            });
        } catch (ModelNotSavedException) {
            return ext_view('teams.create', compact('team'), status: 422);
        }

        \Session::flash('popup', osu_trans('teams.store.ok'));

        return ujs_redirect(route('teams.show', $team));
    }

    public function update(string $id): Response
    {
        $team = Team::findOrFail($id);
        priv_check('TeamUpdate', $team)->ensureCan();
        $params = get_params(\Request::all(), 'team', [
            'default_ruleset_id:int',
            'description',
            'header:file',
            'header_remove:bool',
            'is_open:bool',
            'logo:file',
            'logo_remove:bool',
            'url',
        ]);

        $team->fill($params)->saveOrExplode();

        \Session::flash('popup', osu_trans('teams.edit.ok'));

        return response(null, 201);
    }
}
