<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Http\Controllers;

use App\Models\UserClient;
use Auth;
use Request;

class ClientVerificationsController extends Controller
{
    protected $section = 'home';
    protected $actionPrefix = 'client_verifications-';

    public function __construct()
    {
        $this->middleware('auth', ['only' => 'store']);
        $this->middleware('verify-user');
        $this->middleware('throttle:60,10');

        return parent::__construct();
    }

    public function create()
    {
        if (!auth()->check()) {
            return ext_view('sessions.create', null, null, 401);
        }

        $hash = request('ch');
        $client = UserClient::lookupOrNew(auth()->user()->getKey(), $hash);

        if ($client === null) {
            abort(422); // TODO: add page mentioning invalid hash
        }

        if ($client->verified) {
            return ext_view('client_verifications.completed');
        }

        return ext_view('client_verifications.create', compact('hash'));
    }

    public function store()
    {
        $hash = request('ch');
        $client = UserClient::lookupOrNew(auth()->user()->getKey(), $hash);

        if ($client === null) {
            abort(422); // TODO: add page mentioning invalid hash
        }

        $client->fill(['verified' => true])->save();

        return ext_view('client_verifications.completed');
    }
}
