<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamMember;
use App\Transformers\UserCompactTransformer;
use Symfony\Component\HttpFoundation\Response;

class TeamsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth', ['only' => ['part']]);
    }

    public function edit(string $id): Response
    {
        $team = Team::findOrFail($id);
        priv_check('TeamUpdate', $team)->ensureCan();

        return ext_view('teams.edit', compact('team'));
    }

    public function part(): Response
    {
        $member = TeamMember::findOrFail(\Auth::user()->getKey());

        $member->delete();
        \Session::flash('popup', osu_trans('teams.part.ok'));

        return ujs_redirect(route('teams.show', ['team' => $member->team_id]));
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
