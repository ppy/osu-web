<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use App\Exceptions\ClientCheckParseTokenException;
use App\Models\Build;
use Illuminate\Http\Request;

class ClientCheck
{
    public static function parseToken(Request $request): array
    {
        $token = $request->header('x-token');
        $assertValid = $GLOBALS['cfg']['osu']['client']['check_version'];
        $ret = [
            'buildId' => $GLOBALS['cfg']['osu']['client']['default_build_id'],
            'token' => null,
        ];

        try {
            if ($token === null) {
                throw new ClientCheckParseTokenException('missing token header');
            }

            $input = static::splitToken($token);

            $build = Build::firstWhere([
                'hash' => $input['clientHash'],
                'allow_ranking' => true,
            ]);

            if ($build === null) {
                throw new ClientCheckParseTokenException('invalid client hash');
            }

            $ret['buildId'] = $build->getKey();

            $computed = hash_hmac(
                'sha1',
                $input['clientData'],
                static::getKey($build),
                true,
            );

            if (!hash_equals($computed, $input['expected'])) {
                throw new ClientCheckParseTokenException('invalid verification hash');
            }

            $now = time();
            if (abs($now - $input['clientTime']) > $GLOBALS['cfg']['osu']['client']['token_lifetime']) {
                throw new ClientCheckParseTokenException('expired token');
            }

            $ret['token'] = $token;

            $ret['multipart'] = static::getMultipartData($request);
            $ret['body'] = base64_encode($request->getContent());
            $ret['url'] = $request->getRequestUri();
        } catch (ClientCheckParseTokenException $e) {
            abort_if($assertValid, 422, $e->getMessage());
        }

        return $ret;
    }

    public static function validateToken(?array $tokenData, ?int $scoreId = null): void
    {
        if ($tokenData['token'] === null) {
            return;
        }

        $validationRequestId = bin2hex(random_bytes(16));
        $validationKey = "osu-queue:token-validation:{$validationRequestId}";

        \LaravelRedis::lpush($GLOBALS['cfg']['osu']['client']['token_queue'], json_encode([
            'body' => $tokenData['body'],
            'multipart_data' => $tokenData['multipart'],
            'score_id' => $scoreId,
            'token' => $tokenData['token'],
            'url' => $tokenData['url'],
            'validation_key' => $validationKey,
        ]));

        $result = \LaravelRedis::blPop([$validationKey], $GLOBALS['cfg']['osu']['client']['token_validation_timeout']);

        if ($result === null) {
            // TODO: perhaps abort in the future
            datadog_increment('token_validation_timeout');
            return;
        }

        $validationResult = $result[1];

        if ($validationResult !== 'success') {
            abort(422, $validationResult);
        }
    }

    private static function getKey(Build $build): string
    {
        return $GLOBALS['cfg']['osu']['client']['token_keys'][$build->platform()]
            ?? $GLOBALS['cfg']['osu']['client']['token_keys']['default']
            ?? '';
    }

    private static function getMultipartData(Request $request): ?array
    {
        $contentType = $request->header('Content-Type', '');
        $isMultipart = str_starts_with($contentType, 'multipart/form-data');

        return $isMultipart ? $request->post() : null;
    }

    private static function splitToken(string $token): array
    {
        $data = substr($token, -82);
        if (strlen($data) !== 82 || !ctype_xdigit($data)) {
            $data = str_repeat('0', 82);
        }
        $clientTime = unpack('V', hex2bin(substr($data, 32, 8)))[1];

        return [
            'clientData' => substr($data, 0, 40),
            'clientHash' => hex2bin(substr($data, 0, 32)),
            'clientTime' => $clientTime,
            'expected' => hex2bin(substr($data, 40, 40)),
            'version' => hexdec(substr($data, 80, 2)),
        ];
    }
}
