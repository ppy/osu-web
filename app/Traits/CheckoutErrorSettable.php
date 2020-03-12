<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Traits;

use App\Models\Store\Order;
use Session;

trait CheckoutErrorSettable
{
    public function setAndRedirectCheckoutError(?Order $order, $message = '', $errors = [])
    {
        Session::flash('checkout.error.message', $message);
        Session::flash('checkout.error.errors', $errors);

        // TODO: what to do if order is null?
        return ujs_redirect(route('store.checkout.show', $order), 422);
    }
}
