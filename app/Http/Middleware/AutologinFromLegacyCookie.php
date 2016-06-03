<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Auth;
use Illuminate\Contracts\Auth\Guard;

class AutologinFromLegacyCookie
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param Guard $auth
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->shared_secret = config('osu.legacy.shared_cookie_secret');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $this->auth->user();

        if (!$user && isset($_COOKIE['phpbb3_2cjk5_sid']) && isset($_COOKIE['phpbb3_2cjk5_sid_check'])) {
            $phpbb_sid = $_COOKIE['phpbb3_2cjk5_sid'];
            $confirmation = $_COOKIE['phpbb3_2cjk5_sid_check'];
            if (hash_hmac('sha1', $phpbb_sid, $this->shared_secret) === $confirmation) {
                $session = DB::table('phpbb_sessions')->where('session_id', '=', $phpbb_sid)->first();

                if ($session) {
                    Auth::loginUsingId($session->session_user_id, $session->session_autologin);
                }
            }
        }

        return $next($request);
    }
}
