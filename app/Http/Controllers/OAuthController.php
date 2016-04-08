<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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

use Auth;
use Request;
use Response;
use Authorizer;
use DB;

class OAuthController extends Controller
{
    protected $section = 'oauth';

    public function __construct()
    {
        # TODO: uh yeah, there's gotta be a better way to do this :v
        if (current_action() !== 'getAccessToken') {
            $this->middleware('auth');
        }
        return parent::__construct();
    }

    public function authorizeForm()
    {
        $user = Auth::user();
        $authParams = Authorizer::getAuthCodeRequestParams();
        $formParams = array_except($authParams, 'client');
        $formParams['client_id'] = $authParams['client']->getId();
        $formParams['scope'] = implode(config('oauth2.scope_delimiter'), array_map(function ($scope) {
            return $scope->getId();
        }, $authParams['scopes']));

        $client_id = $formParams['client_id'];

        $sessions = DB::table('oauth_sessions')
            ->where('client_id', '=', $client_id)
            ->where('owner_id', $user->user_id)
            ->join('oauth_clients', 'oauth_clients.id', '=', 'oauth_sessions.client_id')
            ->groupBy('oauth_sessions.client_id')
            // TODO: check that grants are the same when we start using grants
            ->get();

        if ($sessions) {
            $formParams['user_id'] = $user->user_id;
            return redirect(Authorizer::issueAuthCode('user', $user->user_id, $formParams));
        } else {
            return view('oauth.authorization-form', ['params' => $formParams, 'client' => $authParams['client']]);
        }
    }

    public function authorizePost()
    {
        $params = Authorizer::getAuthCodeRequestParams();
        $params['user_id'] = Auth::user()->user_id;
        $redirectUri = '/';

        // If the user has allowed the client to access its data, redirect back to the client with an auth code.
        if (Request::has('approve')) {
            $redirectUri = Authorizer::issueAuthCode('user', $params['user_id'], $params);
        }

        // If the user has denied the client to access its data, redirect back to the client with an error message.
        if (Request::has('deny')) {
            $redirectUri = Authorizer::authCodeRequestDeniedRedirectUri();
        }

        return redirect($redirectUri);
    }

    public function getAccessToken()
    {
        return Response::json(Authorizer::issueAccessToken());
    }
}
