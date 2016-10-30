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

use App\Exceptions\ImageProcessorException;
use App\Libraries\UserVerification;
use App\Models\User;
use App\Models\UserProfileCustomization;
use Auth;
use Illuminate\Http\Request as HttpRequest;
use Request;

class AccountController extends Controller
{
    protected $section = 'account';

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'logout']);

        $this->middleware(function ($request, $next) {
            if (Auth::check() && Auth::user()->isSilenced()) {
                return abort(403);
            }

            return $next($request);
        });

        $this->middleware('verify-user');

        return parent::__construct();
    }

    public function updateProfile()
    {
        if (Request::hasFile('cover_file') && !Auth::user()->osu_subscriber) {
            return error_popup(trans('errors.supporter_only'));
        }

        if (Request::hasFile('cover_file') || Request::has('cover_id')) {
            try {
                Auth::user()
                    ->profileCustomization()
                    ->firstOrCreate([])
                    ->setCover(Request::input('cover_id'), Request::file('cover_file'));
            } catch (ImageProcessorException $e) {
                return error_popup($e->getMessage());
            }
        }

        if (Request::has('order')) {
            $order = Request::input('order');

            $error = 'errors.account.profile-order.generic';

            // Checking whether the input has the same amount of elements
            // as the master sections array.
            if (count($order) !== count(UserProfileCustomization::$sections)) {
                return error_popup(trans($error));
            }

            // Checking if any section that was sent in input
            // also appears in the master sections arrray.
            foreach ($order as $i) {
                if (!in_array($i, UserProfileCustomization::$sections, true)) {
                    return error_popup(trans($error));
                }
            }

            // Checking whether the elements sent in input do not repeat.
            $occurences = array_count_values($order);

            foreach ($occurences as $i) {
                if ($i > 1) {
                    return error_popup(trans($error));
                }
            }

            Auth::user()
                ->profileCustomization()
                ->firstOrCreate([])
                ->setExtrasOrder($order);
        }

        return Auth::user()->defaultJson();
    }

    public function updatePage()
    {
        $user = Auth::user();

        priv_check('UserPageEdit', $user)->ensureCan();

        $user = $user->updatePage(Request::input('body'));

        return ['html' => $user->userPage->bodyHTML];
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
