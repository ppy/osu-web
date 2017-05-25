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
use App\Libraries\UserVerification;
use App\Mail\UserEmailUpdated;
use App\Mail\UserPasswordUpdated;
use App\Models\User;
use App\Models\UserEmail;
use App\Models\UserPassword;
use Auth;
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
        });

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
        return view('accounts.edit');
    }

    public function update()
    {
        $customizationParams = get_params(
            Request::all(),
            'user_profile_customization',
            [
                'extras_order:string[]',
            ]
        );

        $userParams = get_params(
            Request::all(),
            'user',
            [
                'user_from:string',
                'user_interests:string',
                'user_msnm:string',
                'user_occ:string',
                'user_twitter:string',
                'user_website:string',
                'user_sig:string',
                'osu_playstyle:string[]',
            ]
        );

        if (count($customizationParams) > 0) {
            Auth::user()
                ->profileCustomization()
                ->update($customizationParams);
        }

        if (count($userParams) > 0) {
            Auth::user()->update($userParams);
        }

        return Auth::user()->defaultJson();
    }

    public function updateEmail()
    {
        $user = Auth::user();
        $previousEmail = $user->user_email;
        $userEmail = (new UserEmail($user))
            ->fill(Request::input('user_email'));

        if ($userEmail->save() === true) {
            $addresses = [$user->user_email];
            if (present($previousEmail)) {
                $addresses[] = $previousEmail;
            }
            foreach ($addresses as $address) {
                Mail::to($address)->send(new UserEmailUpdated($user));
            }

            return ['message' => trans('accounts.update_email.updated')];
        } else {
            return response(['form_error' => [
                'user_email' => $userEmail->validationErrors()->all(),
            ]], 422);
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
        $user = Auth::user();
        $userPassword = (new UserPassword($user))
            ->fill(Request::input('user_password'));

        if ($userPassword->save() === true) {
            if (present($user->user_email)) {
                Mail::to($user->user_email)->send(new UserPasswordUpdated($user));
            }

            return ['message' => trans('accounts.update_password.updated')];
        } else {
            return response(['form_error' => [
                'user_password' => $userPassword->validationErrors()->all(),
            ]], 422);
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
}
