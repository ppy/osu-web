<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Payments;

use Illuminate\Http\Request;

class CentiliSignature implements PaymentSignature
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function isValid()
    {
        $received = $this->receivedSignature();
        \Log::debug("CentiliSignature::isValidSignature calc: {$this->calculatedSignature()}, signed: {$received}");
        if ($received === null) {
            return false;
        }

        return hash_equals($this->calculatedSignature(), $received);
    }

    public static function calculateSignature(array $params)
    {
        // Centili signature is a HMAC of the concatenation of all params values sorted alphabetically by key name.
        $content = static::stringifyInput($params);

        return hash_hmac('sha1', $content, config('payments.centili.secret_key'), false);
    }

    public static function stringifyInput(array $input)
    {
        ksort($input);
        unset($input['sign']);

        return implode('', array_values($input)); // array_values might not be needed.
    }

    private function receivedSignature()
    {
        return $this->request->input('sign');
    }

    private function calculatedSignature()
    {
        return static::calculateSignature($this->request->input());
    }
}
