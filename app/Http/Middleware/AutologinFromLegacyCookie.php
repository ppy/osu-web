<?php

namespace App\Http\Middleware;

use App\Models\LegacySession;
use Closure;
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
        if ($this->auth->guest()) {
            $session = LegacySession::loadFromRequest($request);

            if ($session !== null) {
                $request->session()->flush();
                $this->auth->loginUsingId($session->session_user_id, $session->session_autologin);
                $request->session()->migrate(true, $session->session_user_id);
            }
        }

        return $next($request);
    }
}
