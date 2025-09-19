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
        $sort = get_string(\Request::input('sort'));
        if ($sort !== 'score') {
            $sort = 'performance';
        }

        $leaderboard = $team
            ->members
            ->loadMissing("user.{$statisticsRelationName}")
            ->map(fn ($member) =>
                (
                    $member->user->$statisticsRelationName
                    ?? $member->user->$statisticsRelationName()->make()
                )->setRelation('user', $member->user))
            ->sortByDesc($sort === 'score' ? 'ranked_score' : 'rank_score')
            ->values();

        return ext_view('teams.leaderboard', compact('leaderboard', 'ruleset', 'sort', 'team'));
    }

    public function part(string $id): Response
    {
        $team = Team::findOrFail($id);
        priv_check('TeamPart', $team)->ensureCan();

        $teamMember = $team->members()->findOrFail(\Auth::user()->getKey());
        $team->removeMember($teamMember);
        \Session::flash('popup', osu_trans('teams.part.ok'));

        return ujs_redirect(route('teams.show', ['team' => $team]));
    }

    public function show(string $id, ?string $ruleset = null): Response
    {
        $params = str_starts_with($id, '@')
            ? ['short_name' => substr($id, 1)]
            : ['id' => $id];

        $team = Team::where($params)->firstOrFail();

        if ($ruleset === null) {
            $rulesetId = $team->default_ruleset_id;
        } else {
            $rulesetId = Beatmap::MODES[$ruleset] ?? null;

            if ($rulesetId === null) {
                abort(422, 'invalid ruleset name');
            }
        }

        if ($id !== (string) $team->getKey()) {
            return ujs_redirect(route('teams.show', compact('team', 'ruleset')));
        }

        $statistics = $team->statistics()->firstOrNew(['ruleset_id' => $rulesetId]);

        $team->loadMissing(prefix_strings('members.user.', UserCompactTransformer::CARD_INCLUDES_PRELOAD));

        return ext_view('teams.show', compact('rulesetId', 'statistics', 'team'));
    }

    public function store(): Response
    {
        priv_check('TeamStore')->ensureCan();

        $team = new Team(get_params(\Request::all(), 'team', [
            'name',
            'short_name',
        ]));
        $team->leader()->associate(\Auth::user());
        try {
            $team->saveOrExplode();
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
            'flag:file',
            'header:file',
            'is_open:bool',
            'url',
        ]);

        $team->fill($params)->saveOrExplode();

        \Session::flash('popup', osu_trans('teams.edit.ok'));

        return response(null, 201);
    }
}
