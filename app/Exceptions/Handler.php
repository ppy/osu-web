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

namespace App\Exceptions;

use App\Libraries\UserVerification;
use Auth;
use Exception;
use Illuminate\Auth\Access\AuthorizationException as LaravelAuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Laravel\Passport\Exceptions\MissingScopeException;
use Laravel\Passport\Exceptions\OAuthServerException as PassportOAuthServerException;
use League\OAuth2\Server\Exception\OAuthServerException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        // laravel's
        AuthenticationException::class,
        LaravelAuthorizationException::class,
        ModelNotFoundException::class,
        TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,

        // local
        AuthorizationException::class,
        SilencedException::class,
        VerificationRequiredException::class,

        // oauth
        OAuthServerException::class,
    ];

    public static function exceptionMessage($e)
    {
        if ($e instanceof ModelNotFoundException) {
            return;
        }

        if (static::statusCode($e) >= 500) {
            return;
        }

        return $e->getMessage();
    }

    public static function statusCode($e)
    {
        if (method_exists($e, 'getStatusCode')) {
            return $e->getStatusCode();
        } elseif ($e instanceof ModelNotFoundException) {
            return 404;
        } elseif ($e instanceof NotFoundHttpException) {
            return 404;
        } elseif ($e instanceof TokenMismatchException) {
            return 403;
        } elseif ($e instanceof AuthenticationException) {
            return 401;
        } elseif ($e instanceof AuthorizationException || $e instanceof MissingScopeException) {
            return 403;
        } elseif (static::isOAuthServerException($e)) {
            return $e->getPrevious()->getHttpStatusCode();
        } else {
            return 500;
        }
    }

    private static function isOAuthServerException($e)
    {
        return ($e instanceof PassportOAuthServerException) && ($e->getPrevious() instanceof OAuthServerException);
    }

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception $e
     *
     * @return void
     */
    public function report(Exception $e)
    {
        view()->share('currentAction', static::statusCode($e));
        view()->share('currentSection', 'error');

        // immediately done if the error should not be reported
        if ($this->shouldntReport($e)) {
            return;
        }

        if (config('sentry.dsn')) {
            $this->reportWithSentry($e);
        }

        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $e
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if (method_exists($e, 'getResponse')) {
            return $e->getResponse();
        }

        if ($e instanceof VerificationRequiredException) {
            return $this->unverified();
        }

        if ($e instanceof AuthenticationException) {
            return $this->unauthenticated($request, $e);
        }

        if (config('app.debug')) {
            $response = parent::render($request, $e);
        } else {
            $message = static::exceptionMessage($e);

            if (is_json_request() || $request->ajax()) {
                $response = response(['error' => $message]);
            } else {
                $response = ext_view('layout.error', ['exceptionMessage' => $message]);
            }
        }

        return $response->setStatusCode(static::statusCode($e));
    }

    protected function shouldntReport(Exception $e)
    {
        return parent::shouldntReport($e) || $this->isOAuthServerException($e);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if (is_json_request() || $request->ajax()) {
            return response(['authentication' => 'basic'], 401);
        }

        return ext_view('users.login', null, null, 401);
    }

    protected function unverified()
    {
        return UserVerification::fromCurrentRequest()->initiate();
    }

    private function reportWithSentry($e)
    {
        if (Auth::check()) {
            $userContext = [
                'id' => Auth::user()->user_id,
                'username' => Auth::user()->username_clean,
            ];
        } else {
            $userContext = [
                'id' => null,
            ];
        }

        app('sentry')->configureScope(function ($scope) use ($e, $userContext) {
            $scope->setUser($userContext);
            $scope->setTag('http_code', (string) static::statusCode($e));
        });

        $ref = app('sentry')->captureException($e);

        view()->share('ref', $ref);
    }
}
