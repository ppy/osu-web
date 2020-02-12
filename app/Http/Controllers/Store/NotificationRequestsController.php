<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

namespace App\Http\Controllers\Store;

use App\Models\Store\Product;
use Auth;
use Illuminate\Database\QueryException;

class NotificationRequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        if (!$this->isAllowRestrictedUsers()) {
            $this->middleware('check-user-restricted');
        }

        return parent::__construct();
    }

    public function store($productId)
    {
        $product = Product::findOrFail($productId);

        if ($product->inStock()) {
            return error_popup(trans('store.product.notification_in_stock'));
        }

        try {
            $product
                ->notificationRequests()
                ->create(['user_id' => Auth::user()->user_id]);
        } catch (QueryException $e) {
            if (!is_sql_unique_exception($e)) {
                throw $e;
            }
        }

        return ext_view('layout.ujs-reload', [], 'js');
    }

    public function destroy($productId)
    {
        Product::findOrFail($productId)
            ->notificationRequests()
            ->where('user_id', '=', Auth::user()->user_id)
            ->delete();

        return ext_view('layout.ujs-reload', [], 'js');
    }
}
