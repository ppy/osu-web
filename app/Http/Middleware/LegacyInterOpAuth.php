<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Auth\Guard;

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
        if (!$request->hasHeader('X-LIO-Signature') || !presence($request->query('timestamp'))) {
            abort(403);
        }

        $timestamp = $request->query('timestamp');
        $signature = $request->header('X-LIO-Signature');
        $expected = hash_hmac('sha1', $request->fullUrl(), config('osu.legacy.shared_cookie_secret'));

        $diff = Carbon::createFromTimestamp($timestamp)->diffInSeconds();

        if ($diff > 300 || $signature !== $expected) {
            abort(403);
        }

        return $next($request);
    }
}
