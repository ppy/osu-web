<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\GithubUser;
use League\OAuth2\Client\Provider\Exception\GithubIdentityProviderException;
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
            'error:string',
            'state:string',
        ], ['null_missing' => true]);

        abort_if($params['state'] === null, 422, 'Missing state parameter.');
        abort_unless(
            hash_equals(session()->pull('github_auth_state', ''), $params['state']),
            403,
            'Invalid state.',
        );

        // If the user denied authorization on GitHub, redirect back to the GitHub account settings
        // <https://docs.github.com/en/apps/oauth-apps/maintaining-oauth-apps/troubleshooting-authorization-request-errors#access-denied>
        if ($params['error'] === 'access_denied') {
            return redirect(route('account.edit').'#github');
        }

        abort_if($params['error'] !== null, 500, 'Error obtaining authorization from GitHub.');
        abort_if($params['code'] === null, 422, 'Missing code parameter.');

        try {
            $token = $this
                ->makeGithubOAuthProvider()
                ->getAccessToken('authorization_code', ['code' => $params['code']]);
        } catch (GithubIdentityProviderException $exception) {
            // <https://docs.github.com/en/apps/oauth-apps/maintaining-oauth-apps/troubleshooting-oauth-app-access-token-request-errors#bad-verification-code>
            abort_if(
                $exception->getMessage() === 'bad_verification_code',
                422,
                'Invalid authorization code.',
            );

            // <https://docs.github.com/en/apps/oauth-apps/maintaining-oauth-apps/troubleshooting-oauth-app-access-token-request-errors#unverified-user-email>
            abort_if(
                $exception->getMessage() === 'unverified_user_email',
                422,
                osu_trans('accounts.github_user.error.unverified_email'),
            );

            throw $exception;
        }

        $client = new \Github\Client();
        $client->authenticate($token->getToken(), \Github\AuthMethod::ACCESS_TOKEN);
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
