<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Payments;

use App\Exceptions\InvalidSignatureException;
use Illuminate\Http\Request;

class XsollaSignature implements PaymentSignature
{
    public function __construct(private Request $request)
    {
    }

    public function assertValid(): void
    {
        $received = $this->receivedSignature();

        if ($received === null) {
            throw new InvalidSignatureException('missing signature');
        }

        $calculated = $this->calculatedSignature();

        if (!hash_equals($calculated, $received)) {
            throw new InvalidSignatureException('hash mismatch', compact('calculated', 'received'));
        }
    }

    public static function calculateSignature(string $content)
    {
        return sha1($content.$GLOBALS['cfg']['payments']['xsolla']['secret_key']);
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
