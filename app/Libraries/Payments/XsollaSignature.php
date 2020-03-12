<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Payments;

use Illuminate\Http\Request;

class XsollaSignature implements PaymentSignature
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function isValid()
    {
        $received = $this->receivedSignature();
        \Log::debug("XsollaSignature::isValidSignature calc: {$this->calculatedSignature()}, signed: {$received}");

        return $received === null
            ? false
            : hash_equals($this->calculatedSignature(), $received);
    }

    public static function calculateSignature(string $content)
    {
        return sha1($content.config('payments.xsolla.secret_key'));
    }

    private function receivedSignature()
    {
        preg_match('~^Signature (?<signature>[0-9a-f]{40})$~', $this->request->header('Authorization'), $matches);

        return $matches['signature'] ?? null;
    }

    private function calculatedSignature()
    {
        return static::calculateSignature($this->request->getContent());
    }
}
