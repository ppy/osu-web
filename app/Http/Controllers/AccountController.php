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
use Auth;
use Illuminate\Http\Request as HttpRequest;
use Request;
use App\Models\User;

class AccountController extends Controller
{
    protected $section = 'account';

    public function __construct()
    {
        $this->middleware('auth');

        if (Auth::check() && Auth::user()->isSilenced()) {
            abort(403);
        }

        return parent::__construct();
    }

    public function updateProfileCover()
    {
        if (Request::hasFile('cover_file') && !Auth::user()->osu_subscriber) {
            return error_popup(trans('errors.supporter_only'));
        }

        try {
            Auth::user()
                ->profileCustomization()
                ->firstOrCreate([])
                ->setCover(Request::input('cover_id'), Request::file('cover_file'));
        } catch (ImageProcessorException $e) {
            return error_popup($e->getMessage());
        }

        return Auth::user()->defaultJson();
    }

    public function updatePage()
    {
        $user = Auth::user();

        if (!$user->osu_subscriber && $user->userPage === null) {
            abort(403);
        }

        if (!$user->userPage->canBeEditedBy($user)) {
            abort(403);
        }

        $user = $user->updatePage(Request::input('body'));

        return ['html' => $user->userPage->bodyHTML];
    }

    /**
     * Gets the new order of user profile page elements from request,
     * and saves it into the database.
     */
    public function updateProfileExtrasOrder(HttpRequest $request)
    {
        $this->validate($request, [
            'order' => 'required|array',
        ]);

        if (!Auth::check())
        {
            abort(403, trans('errors.codes.http-403'));
        }

        $user = Auth::user();
        $order = Request::input('order');

        // jQuery's AJAX methods convert ints to strings unfortunately,
        // so here we convert them back
        $order = array_map(function ($x) {
            if (gettype($x) === 'string')
            {
                return intval($x);
            }
            else
            {
                return $x;
            }
        }, $order);

        $count = array_fill(1, User::EXTRAS_COUNT, 0);

        foreach($order as $i)
        {
            // Checking whether there are any values in the order array
            // that are not IDs of profile page blocks.
            if($i > User::EXTRAS_COUNT || $i < 1)
            {
                return response()
                    ->json([
                        'status' => 'error',
                        'errors' => [
                            trans('errors.account.profile-order.invalid-id', ['count' => User::EXTRAS_COUNT])
                        ]
                    ]);
            }
        }

        // Checking whether the values in the order array are unique,
        // so we don't get repeating blocks on the profile page.
        $occurences = array_count_values($order);

        foreach($occurences as $i)
        {
            if($i > 1)
            {
                return response()
                    ->json([
                        'status' => 'error',
                        'errors' => [
                            trans('errors.account.profile-order.duplicate')
                        ]
                    ]);
            }
        }

        $user->extras_order = $order;
        $user->save();

        return response()
            ->json([
                'status' => 'OK'
            ]);
    }
}
