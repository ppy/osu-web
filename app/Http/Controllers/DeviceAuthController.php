<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Libraries\ClientCheck;
use App\Libraries\OAuth\DeviceAuth;
use App\Libraries\OAuth\EncodeToken;
use App\Models\OAuth;
use App\Models\User;
use Carbon\CarbonImmutable;
use Laravel\Passport\Passport;

class DeviceAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['authorisation', 'token']]);
        $this->middleware('verify-user', ['except' => ['authorisation', 'token']]);
    }

    public function authorisation()
    {
        ClientCheck::parseToken(\Request::instance());

        return DeviceAuth::authorisation();
    }

    public function create()
    {
        return ext_view('device_auth.create');
    }

    public function store()
    {
        return DeviceAuth::store(get_string(request('user_code')), \Auth::user()->getKey())
            ? ujs_redirect(route('device-auth.completed'))
            : error_popup('Authorisation failed. Close the page and try again', 422);
    }

    public function completed()
    {
        return ext_view('device_auth.completed');
    }

    public function token()
    {
        $result = DeviceAuth::retrieve(get_string(request('device_code')));

        if (isset($result['error'])) {
            return response($result, 400);
        }

        $user = User::findOrFail($result['user_id']);
        $client = OAuth\Client::findOrFail($GLOBALS['cfg']['osu']['api']['device_auth_client_id']);
        $now = CarbonImmutable::now();
        $token = $client->tokens()->create([
            'expires_at' => $now->add(Passport::tokensExpireIn()),
            'id' => uniqid(),
            'revoked' => false,
            'scopes' => ['*'],
            'user_id' => $user->getKey(),
            'verified' => true,
        ]);
        $refreshToken = $token->refreshToken()->create([
            'expires_at' => $now->add(Passport::refreshTokensExpireIn()),
            'id' => \Str::random(40),
            'revoked' => false,
        ]);

        return [
            'access_token' => EncodeToken::encodeAccessToken($token),
            'refresh_token' => EncodeToken::encodeRefreshToken($refreshToken, $token),
        ];
    }
}
