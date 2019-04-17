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
