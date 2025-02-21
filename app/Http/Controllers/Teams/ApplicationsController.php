<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use App\Jobs\Notifications\TeamApplicationReject;
use App\Models\Team;
use App\Models\TeamApplication;
use Symfony\Component\HttpFoundation\Response;

class ApplicationsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function accept(string $teamId, string $id): Response
    {
        $team = Team::findOrFail($teamId);
        $application = $team->applications()->findOrFail($id);

        priv_check('TeamApplicationAccept', $application)->ensureCan();

        $team->addMember($application);

        \Session::flash('popup', osu_trans('teams.applications.accept.ok'));

        return response(null, 204);
    }

    public function destroy(string $teamId, string $id): Response
    {
        $currentUser = \Auth::user();
        TeamApplication::where('team_id', $teamId)->findOrFail($currentUser->getKey())->delete();

        \Session::flash('popup', osu_trans('teams.applications.destroy.ok'));

        return response(null, 204);
    }

    public function reject(string $teamId, string $id): Response
    {
        $team = Team::findOrFail($teamId);
        $application = $team->applications()->findOrFail($id);
        priv_check('TeamUpdate', $team)->ensureCan();

        $application->delete();

        (new TeamApplicationReject($application, \Auth::user()))->dispatch();
        \Session::flash('popup', osu_trans('teams.applications.reject.ok'));

        return response(null, 204);
    }

    public function store(string $teamId): Response
    {
        $team = Team::findOrFail($teamId);
        priv_check('TeamApplicationStore', $team)->ensureCan();

        $team->applications()->createOrFirst(['user_id' => \Auth::id()]);
        \Session::flash('popup', osu_trans('teams.applications.store.ok'));

        return response(null, 204);
    }
}
