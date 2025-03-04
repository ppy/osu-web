<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Exceptions\ModelNotSavedException;
use App\Libraries\Session\Store as SessionStore;
use App\Libraries\SessionVerification;
use App\Libraries\User\AvatarHelper;
use App\Libraries\User\CountryChange;
use App\Libraries\User\CountryChangeTarget;
use App\Mail\UserEmailUpdated;
use App\Mail\UserPasswordUpdated;
use App\Models\Beatmap;
use App\Models\GithubUser;
use App\Models\OAuth\Client;
use App\Models\UserAccountHistory;
use App\Models\UserNotificationOption;
use App\Transformers\CurrentUserTransformer;
use App\Transformers\LegacyApiKeyTransformer;
use App\Transformers\LegacyIrcKeyTransformer;
use Auth;
use DB;
use Mail;
use Request;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'verifyLink',
        ]]);

        $this->middleware(function ($request, $next) {
            if (Auth::check() && Auth::user()->isSilenced()) {
                return abort(403, osu_trans('authorization.silenced'));
            }

            return $next($request);
        }, [
            'except' => [
                'edit',
                'reissueCode',
                'updateCountry',
                'updateEmail',
                'updateNotificationOptions',
                'updateOptions',
                'updatePassword',
                'verify',
                'verifyLink',
            ],
        ]);

        $this->middleware('verify-user', ['except' => [
            'updateOptions',
        ]]);

        $this->middleware('throttle:3,5', ['only' => [
            'reissueCode',
        ]]);

        $this->middleware('throttle:60,10', ['only' => [
            'updateEmail',
            'updatePassword',
            'verify',
            'verifyLink',
        ]]);

        parent::__construct();
    }

    public function avatar()
    {
        $user = auth()->user();

        AvatarHelper::set($user, Request::file('avatar_file'));

        return json_item($user, new CurrentUserTransformer());
    }

    public function cover()
    {
        $user = \Auth::user();
        $params = get_params(\Request::all(), null, [
            'cover_file:file',
            'cover_id:int',
        ], ['null_missing' => true]);

        if ($params['cover_file'] !== null && !$user->osu_subscriber) {
            return error_popup(osu_trans('errors.supporter_only'));
        }

        $user->cover()->set($params['cover_id'], $params['cover_file']);
        $user->save();

        return json_item($user, new CurrentUserTransformer());
    }

    public function edit()
    {
        $user = auth()->user();

        $blocks = $user->blocks()
            ->orderBy('username')
            ->get();

        $sessions = SessionStore::sessions($user->getKey());
        $currentSessionId = \Session::getId();

        $authorizedClients = json_collection(Client::forUser($user), 'OAuth\Client', 'user');
        $ownClients = json_collection($user->oauthClients()->where('revoked', false)->get(), 'OAuth\Client', ['redirect', 'secret']);

        $legacyApiKey = $user->apiKeys()->available()->first();
        $legacyApiKeyJson = $legacyApiKey === null ? null : json_item($legacyApiKey, new LegacyApiKeyTransformer());

        $legacyIrcKey = $user->legacyIrcKey;
        $legacyIrcKeyJson = $legacyIrcKey === null ? null : json_item($legacyIrcKey, new LegacyIrcKeyTransformer());

        $notificationOptions = $user->notificationOptions->keyBy('name');

        $githubUser = GithubUser::canAuthenticate() && $user->githubUser !== null
            ? json_item($user->githubUser, 'GithubUser')
            : null;

        return ext_view('accounts.edit', compact(
            'authorizedClients',
            'blocks',
            'currentSessionId',
            'githubUser',
            'legacyApiKeyJson',
            'legacyIrcKeyJson',
            'notificationOptions',
            'ownClients',
            'sessions'
        ));
    }

    public function update()
    {
        $user = Auth::user();

        $params = get_params(request()->all(), 'user', [
            'user_from:string',
            'user_interests:string',
            'user_occ:string',
            'user_sig:string',
            'user_twitter:string',
            'user_website:string',
            'user_discord:string',
            'user_style:int',
        ]);

        // setting it to null (default) is always allowed
        if (isset($params['user_style']) && !$user->osu_subscriber) {
            return error_popup(osu_trans('errors.supporter_only'));
        }

        try {
            $user->fill($params)->saveOrExplode();
        } catch (ModelNotSavedException $e) {
            return ModelNotSavedException::makeResponse($e, compact('user'));
        }

        return json_item($user, new CurrentUserTransformer());
    }

    public function updateCountry()
    {
        $newCountry = get_string(Request::input('country_acronym'));
        $user = Auth::user();

        if ($newCountry === null || CountryChangeTarget::get($user) !== $newCountry) {
            abort(403, 'specified country_acronym is not allowed');
        }

        CountryChange::handle($user, $newCountry, 'account settings');
        \Session::flash('popup', osu_trans('common.saved'));

        return ext_view('layout.ujs-reload', [], 'js');
    }

    public function updateEmail()
    {
        priv_check('UserUpdateEmail')->ensureCan();

        $params = get_params(request()->all(), 'user', ['current_password', 'user_email', 'user_email_confirmation']);
        $user = Auth::user()->validateCurrentPassword()->validateEmailConfirmation();
        $previousEmail = $user->user_email;

        if ($user->update($params) === true) {
            foreach ([$previousEmail, $user->user_email] as $address) {
                if (is_valid_email_format($address)) {
                    Mail::to($address)->locale($user->preferredLocale())->send(new UserEmailUpdated($user));
                }
            }

            UserAccountHistory::logUserUpdateEmail($user, $previousEmail);

            return response([], 204);
        } else {
            return ModelNotSavedException::makeResponse(null, compact('user'));
        }
    }

    public function updateNotificationOptions()
    {
        $requestParams = request()->all()['user_notification_option'] ?? [];
        if (!is_array($requestParams)) {
            abort(422);
        }

        DB::transaction(function () use ($requestParams) {
            $user = auth()->user();
            $user
                ->notificationOptions()
                ->whereIn('name', array_keys($requestParams))
                ->select('user_id')
                ->lockForUpdate()
                ->get();
            foreach ($requestParams as $key => $value) {
                if (!UserNotificationOption::supportsNotifications($key)) {
                    continue;
                }

                $params = get_params($value, null, ['details:any']);

                $option = $user->notificationOptions()->firstOrNew(['name' => $key]);
                // TODO: show correct field error.
                $option->fill($params)->saveOrExplode();
            }
        });

        return response(null, 204);
    }

    public function updateOptions()
    {
        $user = Auth::user();
        $params = request()->all();

        $userParams = get_params($params, 'user', [
            'hide_presence:bool',
            'osu_playstyle:string[]',
            'playmode:string',
            'pm_friends_only:bool',
            'user_notify:bool',
        ]);

        if (isset($userParams['playmode']) && !Beatmap::isModeValid($userParams['playmode'])) {
            abort(422, 'invalid value specified for user[playmode]');
        }

        $profileParams = get_params($params, 'user_profile_customization', [
            'audio_autoplay:bool',
            'audio_muted:bool',
            'audio_volume:float',
            'beatmapset_card_size:string',
            'beatmapset_download:string',
            'beatmapset_show_nsfw:bool',
            'beatmapset_title_show_original:bool',
            'comments_show_deleted:bool',
            'comments_sort:string',
            'extras_order:string[]',
            'forum_posts_show_deleted:bool',
            'legacy_score_only:bool',
            'profile_cover_expanded:bool',
            'scoring_mode:string',
            'user_list_filter:string',
            'user_list_sort:string',
            'user_list_view:string',
        ]);

        $profileCustomization = $user->userProfileCustomization()->createOrFirst();
        $user->setRelation('userProfileCustomization', $profileCustomization);

        try {
            if (!empty($userParams)) {
                $user->fill($userParams)->saveOrExplode();
            }

            if (!empty($profileParams)) {
                $profileCustomization->fill($profileParams)->saveOrExplode();
            }
        } catch (ModelNotSavedException $e) {
            return ModelNotSavedException::makeResponse($e, [
                'user' => $user,
                'user_profile_customization' => $profileCustomization,
            ]);
        }

        return json_item($user, new CurrentUserTransformer());
    }

    public function updatePassword()
    {
        $params = get_params(request()->all(), 'user', ['current_password', 'password', 'password_confirmation']);
        $user = Auth::user()->validateCurrentPassword()->validatePasswordConfirmation();

        if ($user->update($params) === true) {
            if (is_valid_email_format($user->user_email)) {
                Mail::to($user)->send(new UserPasswordUpdated($user));
            }

            $user->resetSessions(\Session::getId());

            return response([], 204);
        } else {
            return ModelNotSavedException::makeResponse(null, compact('user'));
        }
    }

    public function verify()
    {
        return SessionVerification\Controller::verify();
    }

    public function verifyLink()
    {
        return SessionVerification\Controller::verifyLink();
    }

    public function reissueCode()
    {
        return SessionVerification\Controller::reissue();
    }
}
