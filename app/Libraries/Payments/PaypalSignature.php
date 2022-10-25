<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Payments;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PaypalSignature implements PaymentSignature
{
    const VERIFIED_RESPONSE = 'VERIFIED';

    public function __construct(private Request $request)
    {
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
