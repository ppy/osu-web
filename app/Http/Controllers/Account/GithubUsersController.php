<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\GithubUser;
use Github\Client as GithubClient;
use GuzzleHttp\Client as HttpClient;

class GithubUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verify-user');

        parent::__construct();
    }

    public function callback()
    {
        $params = get_params(request()->all(), null, [
            'code:string',
            'state:string',
        ]);

        abort_unless(isset($params['code']), 422, 'Invalid code.');
        abort_unless(
            isset($params['state']) && $params['state'] === session()->pull('github_auth_state'),
            403,
            'Invalid state.',
        );

        $tokenResponseBody = (new HttpClient())
            ->request('POST', 'https://github.com/login/oauth/access_token', [
                'query' => [
                    'client_id' => config('osu.github.client_id'),
                    'client_secret' => config('osu.github.client_secret'),
                    'code' => $params['code'],
                ],
            ])
            ->getBody()
            ->getContents();
        parse_str($tokenResponseBody, $tokenResponseBodyParams);
        $token = $tokenResponseBodyParams['access_token'] ?? null;

        abort_if($token === null, 500, 'Invalid response from GitHub API.');

        $githubClient = new GithubClient();
        $githubClient->authenticate($token, null, GithubClient::AUTH_ACCESS_TOKEN);
        $githubApiUser = $githubClient->currentUser()->show();

        GithubUser::importFromGithub($githubApiUser, auth()->user());

        return redirect(route('account.edit').'#github');
    }

    public function create()
    {
        abort_unless(GithubUser::canAuthenticate(), 404);

        $state = bin2hex(random_bytes(32));
        session()->put('github_auth_state', $state);

        return redirect('https://github.com/login/oauth/authorize?'.http_build_query([
            'allow_signup' => 'false',
            'client_id' => config('osu.github.client_id'),
            'scope' => '',
            'state' => $state,
        ]));
    }

    public function destroy(int $id)
    {
        auth()->user()
            ->githubUsers()
            ->withGithubInfo()
            ->findOrFail($id)
            ->update(['user_id' => null]);

        return response(null, 204);
    }
}
