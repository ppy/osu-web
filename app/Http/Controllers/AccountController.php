<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Exceptions\ImageProcessorException;
use App\Exceptions\ModelNotSavedException;
use App\Libraries\UserVerification;
use App\Libraries\UserVerificationState;
use App\Mail\UserEmailUpdated;
use App\Mail\UserPasswordUpdated;
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

        $this->middleware('throttle:60,10', ['only' => [
            'reissueCode',
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

        try {
            $user->setAvatar(Request::file('avatar_file'));
        } catch (ImageProcessorException $e) {
            return error_popup($e->getMessage());
        }

        return json_item($user, new CurrentUserTransformer());
    }

    public function cover()
    {
        $user = auth()->user();

        if (Request::hasFile('cover_file') && !$user->osu_subscriber) {
            return error_popup(osu_trans('errors.supporter_only'));
        }

        try {
            $user
                ->profileCustomization()
                ->setCover(Request::input('cover_id'), Request::file('cover_file'));
        } catch (ImageProcessorException $e) {
            return error_popup($e->getMessage());
        }

        return json_item($user, new CurrentUserTransformer());
    }

    public function edit()
    {
        $user = auth()->user();

        $blocks = $user->blocks()
            ->orderBy('username')
            ->get();

        $sessions = Request::session()
            ->currentUserSessions();

        $currentSessionId = Request::session()
            ->getIdWithoutKeyPrefix();

        $authorizedClients = json_collection(Client::forUser($user), 'OAuth\Client', 'user');
        $ownClients = json_collection($user->oauthClients()->where('revoked', false)->get(), 'OAuth\Client', ['redirect', 'secret']);

        $legacyApiKey = $user->apiKeys()->available()->first();
        $legacyApiKeyJson = $legacyApiKey === null ? null : json_item($legacyApiKey, new LegacyApiKeyTransformer());

        $legacyIrcKey = $user->legacyIrcKey;
        $legacyIrcKeyJson = $legacyIrcKey === null ? null : json_item($legacyIrcKey, new LegacyIrcKeyTransformer());

        $notificationOptions = $user->notificationOptions->keyBy('name');

        return ext_view('accounts.edit', compact(
            'authorizedClients',
            'blocks',
            'currentSessionId',
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
        ]);

        try {
            $user->fill($params)->saveOrExplode();
        } catch (ModelNotSavedException $e) {
            return ModelNotSavedException::makeResponse($e, compact('user'));
        }

        return json_item($user, new CurrentUserTransformer());
    }

    public function updateEmail()
    {
        $params = get_params(request()->all(), 'user', ['current_password', 'user_email', 'user_email_confirmation']);
        $user = Auth::user()->validateCurrentPassword()->validateEmailConfirmation();
        $previousEmail = $user->user_email;

        if ($user->update($params) === true) {
            $addresses = [$user->user_email];
            if (present($previousEmail)) {
                $addresses[] = $previousEmail;
            }
            foreach ($addresses as $address) {
                Mail::to($address)->locale($user->preferredLocale())->send(new UserEmailUpdated($user));
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
            'profile_cover_expanded:bool',
            'user_list_filter:string',
            'user_list_sort:string',
            'user_list_view:string',
        ]);

        try {
            if (!empty($userParams)) {
                $user->fill($userParams)->saveOrExplode();
            }

            if (!empty($profileParams)) {
                $user->profileCustomization()->fill($profileParams)->saveOrExplode();
            }
        } catch (ModelNotSavedException $e) {
            return ModelNotSavedException::makeResponse($e, [
                'user' => $user,
                'user_profile_customization' => $user->profileCustomization(),
            ]);
        }

        return json_item($user, new CurrentUserTransformer());
    }

    public function updatePassword()
    {
        $params = get_params(request()->all(), 'user', ['current_password', 'password', 'password_confirmation']);
        $user = Auth::user()->validateCurrentPassword()->validatePasswordConfirmation();

        if ($user->update($params) === true) {
            if (present($user->user_email)) {
                Mail::to($user)->send(new UserPasswordUpdated($user));
            }

            $user->resetSessions();
            $this->login($user);
            UserVerification::fromCurrentRequest()->markVerified();

            return response([], 204);
        } else {
            return ModelNotSavedException::makeResponse(null, compact('user'));
        }
    }

    public function verify()
    {
        return UserVerification::fromCurrentRequest()->verify();
    }

    public function verifyLink()
    {
        $state = UserVerificationState::fromVerifyLink(request('key'));

        if ($state === null) {
            UserVerification::logAttempt('link', 'fail', 'incorrect_key');

            return ext_view('accounts.verification_invalid', null, null, 404);
        }

        UserVerification::logAttempt('link', 'success');
        $state->markVerified();

        return ext_view('accounts.verification_completed');
    }

    public function reissueCode()
    {
        return UserVerification::fromCurrentRequest()->reissue();
    }
}
