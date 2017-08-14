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

use Illuminate\Http\Request;

class XsollaHeaderSignature
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function isValid()
    {
        $received = $this->receivedSignature();
        \Log::debug("isValidSignature calc: {$this->calculatedSignature()}, signed: {$received}");
        if ($received === null) {
            return false;
        }

        return hash_equals($this->calculatedSignature(), $received);
    }

    private function receivedSignature()
    {
        $matches = [];
        preg_match('~^Signature (?<signature>[0-9a-f]{40})$~', $this->request->header('Authorization'), $matches);

        return isset($matches['signature']) ? $matches['signature'] : null;
    }

    private function calculatedSignature()
    {
        return sha1($this->request->getContent() . config('payments.xsolla.secret_key'));
    }
}
