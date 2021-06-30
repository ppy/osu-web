<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
            return error_popup(osu_trans('store.product.notification_in_stock'));
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
