<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class LegacyInterOpAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $timestamp = $request->query('timestamp');
        $diff = Carbon::createFromTimestamp($timestamp)->diffInSeconds();
        $signature = $request->header('X-LIO-Signature');
        $expected = hash_hmac('sha1', $request->fullUrl(), config('osu.legacy.shared_interop_secret'));

        if (!present($signature) || !present($timestamp) || $diff > 300 || !hash_equals($expected, $signature)) {
            abort(403);
        }

        return $next($request);
    }
}
