<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Tournament;
use Auth;

class TournamentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => [
            'register',
        ]]);

        parent::__construct();
    }

    public function index()
    {
        return ext_view('tournaments.index', [
            'listing' => Tournament::getGroupedListing(),
        ]);
    }

    public function show($id)
    {
        return ext_view('tournaments.show', [
            'tournament' => Tournament::findOrFail($id),
        ]);
    }

    public function unregister($id)
    {
        $tournament = Tournament::findOrFail($id);

        if (!$tournament->isRegistrationOpen()) {
            return error_popup('registrations are closed!');
        }

        $tournament->unregister(Auth::user());

        return ujs_redirect(route('tournaments.show', $tournament));
    }

    public function register($id)
    {
        $tournament = Tournament::findOrFail($id);
        $user = Auth::user();

        if (!$tournament->isRegistrationOpen()) {
            return error_popup('registrations are closed!');
        }

        if (!$tournament->isValidRank($user)) {
            return error_popup('invalid rank!');
        }

        $tournament->register($user);

        return ujs_redirect(route('tournaments.show', $tournament));
    }
}
