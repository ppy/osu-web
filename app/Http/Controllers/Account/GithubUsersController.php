<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\GithubUser;
use Github\Client as GithubClient;
use League\OAuth2\Client\Provider\Github as GithubProvider;

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

        $client = new GithubClient();
        $provider = $this->makeGithubOAuthProvider();
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $params['code'],
        ]);
        $client->authenticate($token->getToken(), null, GithubClient::AUTH_ACCESS_TOKEN);
        $apiUser = $client->currentUser()->show();
        $user = GithubUser::firstWhere('canonical_id', $apiUser['id']);

        abort_if($user === null, 422, osu_trans('accounts.github_user.error.no_contribution'));

        abort_if($user->user_id !== null, 422, osu_trans('accounts.github_user.error.already_linked'));

        $user->update([
            'user_id' => auth()->id(),
            'username' => $apiUser['login'],
        ]);

        return redirect(route('account.edit').'#github');
    }

    public function create()
    {
        abort_unless(GithubUser::canAuthenticate(), 404);
        abort_if(
            auth()->user()->githubUser()->exists(),
            422,
            'Cannot link more than one GitHub account.',
        );

        $provider = $this->makeGithubOAuthProvider();
        $url = $provider->getAuthorizationUrl([
            'allow_signup' => 'false',
            'scope' => ' ', // Provider doesn't support empty scope
        ]);

        session()->put('github_auth_state', $provider->getState());

        return redirect($url);
    }

    public function destroy(int $id)
    {
        GithubUser
            ::where('user_id', auth()->id())
            ->findOrFail($id)
            ->update(['user_id' => null]);

        return response(null, 204);
    }

    private function makeGithubOAuthProvider(): GithubProvider
    {
        return new GithubProvider([
            'clientId' => config('osu.github.client_id'),
            'clientSecret' => config('osu.github.client_secret'),
        ]);
    }
}
