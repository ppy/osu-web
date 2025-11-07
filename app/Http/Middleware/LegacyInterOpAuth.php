<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use App\Singletons\OsuAuthorize;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class LegacyInterOpAuth
{
    private static function validateSignature(Request $request, string $fullUrl): ?string
    {
        $timestamp = get_int($request->query('timestamp'));
        if ($timestamp === null) {
            return 'missing_timestamp';
        }

        $diff = Carbon::createFromTimestamp($timestamp)->diffInSeconds(absolute: true);
        if ($diff > 300) {
            return 'expired_signature';
        }

        $signature = get_string($request->header('X-LIO-Signature'));
        if (!present($signature)) {
            return 'missing_signature';
        }

        $expected = hash_hmac('sha1', $fullUrl, $GLOBALS['cfg']['osu']['legacy']['shared_interop_secret']);
        if (!hash_equals($expected, $signature)) {
            return 'invalid_signature';
        }

        return null;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // don't use $request->fullUrl() because it returns normalised url.
        $fullUrl = $request->getSchemeAndHttpHost().$request->getRequestUri();

        $err = static::validateSignature($request, $fullUrl);
        if ($err !== null) {
            abort(403, "{$err} ({$fullUrl})");
        }

        $request->attributes->set(OsuAuthorize::REQUEST_IS_INTEROP_KEY, true);

        return $next($request);
    }
}
