<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

use App\Exceptions\ImageProcessorException;
use App\Exceptions\ModelNotSavedException;
use App\Libraries\UserVerification;
use App\Mail\UserEmailUpdated;
use App\Mail\UserPasswordUpdated;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request as HttpRequest;
use Mail;
use Request;

class AccountController extends Controller
{
    protected $section = 'home';
    protected $actionPrefix = 'account-';

    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            if (Auth::check() && Auth::user()->isSilenced()) {
                return abort(403);
            }

            return $next($request);
        }, [
            'except' => [
                'edit',
                'reissueCode',
                'updateEmail',
                'updatePage',
                'updatePassword',
                'verify',
            ],
        ]);

        $this->middleware('verify-user');
        $this->middleware('throttle:60,10', [
            'only' => [
                'updateEmail',
                'updatePassword',
            ],
        ]);

        return parent::__construct();
    }

    public function avatar()
    {
        try {
            Auth::user()->setAvatar(Request::file('avatar_file'));
        } catch (ImageProcessorException $e) {
            return error_popup($e->getMessage());
        }

        return Auth::user()->defaultJson();
    }

    public function cover()
    {
        if (Request::hasFile('cover_file') && !Auth::user()->osu_subscriber) {
            return error_popup(trans('errors.supporter_only'));
        }

        try {
            Auth::user()
                ->profileCustomization()
                ->setCover(Request::input('cover_id'), Request::file('cover_file'));
        } catch (ImageProcessorException $e) {
            return error_popup($e->getMessage());
        }

        return Auth::user()->defaultJson();
    }

    public function edit()
    {
        $blocks = Auth::user()->blocks()
            ->orderBy('username')
            ->get();

        $sessions = Request::session()
            ->currentUserSessions();

        $currentSessionId = Request::session()
            ->getIdWithoutPrefix();

        return view('accounts.edit', compact('blocks', 'sessions', 'currentSessionId'));
    }

    public function update()
    {
        $user = Auth::user();

        $customizationParams = get_params(
            request(),
            'user_profile_customization',
            [
                'extras_order:string[]',
            ]
        );

        $userParams = get_params(
            request(),
            'user',
            [
                'osu_playstyle:string[]',
                'playmode:string',
                'pm_friends_only:bool',
                'user_from:string',
                'user_interests:string',
                'user_msnm:string',
                'user_occ:string',
                'user_sig:string',
                'user_twitter:string',
                'user_website:string',
                'user_discord:string',
            ]
        );

        try {
            DB::transaction(function () use ($customizationParams, $user, $userParams) {
                if (count($customizationParams) > 0) {
                    $user
                        ->profileCustomization()
                        ->fill($customizationParams)
                        ->saveOrExplode();
                }

                if (count($userParams) > 0) {
                    $user->fill($userParams)->saveOrExplode();
                }
            });
        } catch (ModelNotSavedException $e) {
            return $this->errorResponse($user, $e);
        }

        return $user->defaultJson();
    }

    public function updateEmail()
    {
        $params = get_params(request(), 'user', ['current_password', 'user_email', 'user_email_confirmation']);
        $user = Auth::user()->validateCurrentPassword()->validateEmailConfirmation();
        $previousEmail = $user->user_email;

        if ($user->update($params) === true) {
            $addresses = [$user->user_email];
            if (present($previousEmail)) {
                $addresses[] = $previousEmail;
            }
            foreach ($addresses as $address) {
                Mail::to($address)->send(new UserEmailUpdated($user));
            }

            return response([], 204);
        } else {
            return $this->errorResponse($user);
        }
    }

    public function updatePage()
    {
        $user = Auth::user();

        priv_check('UserPageEdit', $user)->ensureCan();

        $user = $user->updatePage(Request::input('body'));

        return ['html' => $user->userPage->bodyHTML];
    }

    public function updatePassword()
    {
        $params = get_params(request(), 'user', ['current_password', 'password', 'password_confirmation']);
        $user = Auth::user()->validateCurrentPassword()->validatePasswordConfirmation();

        if ($user->update($params) === true) {
            if (present($user->user_email)) {
                Mail::to($user->user_email)->send(new UserPasswordUpdated($user));
            }

            return response([], 204);
        } else {
            return $this->errorResponse($user);
        }
    }

    public function verify(HttpRequest $request)
    {
        $verification = new UserVerification(Auth::user(), $request);

        return $verification->verify();
    }

    public function reissueCode(HttpRequest $request)
    {
        $verification = new UserVerification(Auth::user(), $request);

        return $verification->reissue();
    }

    private function errorResponse($user, $exception = null)
    {
        return response([
            'form_error' => ['user' => $user->validationErrors()->all()],
            'error' => optional($exception)->getMessage(),
        ], 422);
    }
}
