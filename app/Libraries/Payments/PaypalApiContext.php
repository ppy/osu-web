<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Payments;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

class PaypalApiContext
{
    public static function client()
    {
        $clientId = config('payments.paypal.client_id');
        $clientSecret = config('payments.paypal.client_secret');

        $environment = config('payments.sandbox') === true
            ? new SandboxEnvironment($clientId, $clientSecret)
            : new ProductionEnvironment($clientId, $clientSecret);

        return new PayPalHttpClient($environment);
    }
}
