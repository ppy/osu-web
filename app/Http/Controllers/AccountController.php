<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
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

class AccountController extends Controller
{
    protected $section = 'account';

    public function __construct()
    {
        $this->middleware('auth');

        if (Auth::user()->isSilenced()) {
            abort(403);
        }

        return parent::__construct();
    }

    public function updateProfileCover()
    {
        if (Request::hasFile('cover_file') && !Auth::user()->osu_subscriber) {
            return error_popup(trans('errors.supporter_only'));
        }

        $customization = Auth::user()->profileCustomization()->firstOrNew([]);
        $customization->setCover($errors, Request::input('cover_id'), Request::file('cover_file'));
        if (count($errors) === 0) {
            return Auth::user()->defaultJson();
        } else {
            return error_popup(implode(',', $errors));
        }
    }

    public function updatePage()
    {
        $user = Auth::user();
        if (!$user->osu_subscriber && $user->userPage === null) {
            abort(403);
        }

        $user = $user->updatePage(Request::input('body'));

        return ['html' => $user->userPage->bodyHTML];
    }
}
