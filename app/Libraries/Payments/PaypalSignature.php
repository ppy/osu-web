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

namespace App\Libraries\Payments;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PaypalSignature implements PaymentSignature
{
    const VERIFIED_RESPONSE = 'VERIFIED';

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function isValid()
    {
        if (empty($this->receivedSignature())) {
            return false;
        }

        $client = new Client();
        $response = $client->request('POST', config('payments.paypal.url'), [
            'allow_redirects' => false,
            'form_params' => $this->calculatedSignature(),
        ]);

        if ($response->getStatusCode() === 200 && trim($response->getBody()) === static::VERIFIED_RESPONSE) {
            return true;
        }

        $string = substr($response->getBody(), 0, 20);
        \Log::error("IPN verification returned: status `{$response->getStatusCode()}`: `{$string}`");

        // NB: leave the default as false.
        return false;
    }

    private function receivedSignature()
    {
        return $this->request->input();
    }

    private function calculatedSignature()
    {
        return array_merge(['cmd' => '_notify-validate'], $this->receivedSignature());
    }
}
