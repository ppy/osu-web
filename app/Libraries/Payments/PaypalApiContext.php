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

namespace App\Libraries\Payments;

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PaypalApiContext
{
    public static function get($clientId = null, $clientSecret = null)
    {
        $clientId = $clientId ?? config('payments.paypal.client_id');
        $clientSecret = $clientSecret ?? config('payments.paypal.client_secret');

        $context = new ApiContext(
            new OAuthTokenCredential($clientId, $clientSecret)
        );

        $context->setConfig(
            [
                'mode' => 'sandbox',
                'log.LogEnabled' => true,
                'log.FileName' => 'PayPal.log',
                'log.LogLevel' => 'DEBUG',
                'cache.enabled' => true,
            ]
        );

        return $context;
    }
}
