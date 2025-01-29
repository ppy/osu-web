<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\ModelNotSavedException;
use App\Models\Team;
use App\Transformers\UserCompactTransformer;
use Symfony\Component\HttpFoundation\Response;

class TeamsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth', ['only' => ['part']]);
    }

    public static function pageLinks(string $current, Team $team): array
    {
        $ret = [
            [
                'active' => $current === 'show',
                'title' => osu_trans('teams.header_links.show'),
                'url' => route('teams.show', ['team' => $team->getKey()]),
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

    public function store(): Reponse
    {
        priv_check('TeamStore')->ensureCan();

        $params = get_params(\Request::all(), 'team', [
            'name',
            'short_name',
        ]);

        $team = new Team([...$params, 'leader_id' => \Auth::user()->getKey()]);
        try {
            $team->saveOrExplode();
        } catch (ModelNotSavedException) {
            return ext_view('teams.create', compact('team'), status: 422);
        }

        \Session::flash('popup', osu_trans('teams.store.saved'));

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

        \Session::flash('popup', osu_trans('teams.edit.saved'));

        return response(null, 201);
    }
}
