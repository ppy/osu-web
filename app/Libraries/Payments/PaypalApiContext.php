<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Payments;

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

class PaypalApiContext
{
    public static function environment()
    {
        $clientId = config('payments.paypal.client_id');
        $clientSecret = config('payments.paypal.client_secret');

        return config('payments.sandbox') === true
            ? new SandboxEnvironment($clientId, $clientSecret)
            : new ProductionEnvironment($clientId, $clientSecret);
    }

    public static function get($clientId = null, $clientSecret = null)
    {
        $clientId = $clientId ?? config('payments.paypal.client_id');
        $clientSecret = $clientSecret ?? config('payments.paypal.client_secret');

        $context = new ApiContext(
            new OAuthTokenCredential($clientId, $clientSecret)
        );

        $config = [
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'DEBUG',
            'cache.FileName' => storage_path('paypal_auth.cache'),
            'cache.enabled' => true,
            'mode' => 'live',
        ];

        if (config('payments.sandbox') === true) {
            $config = array_merge($config, [
                'mode' => 'sandbox',
            ]);
        }

        $context->setConfig($config);

        return $context;
    }
}
