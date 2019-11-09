<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Exceptions;

use App;
use Auth;
use Exception;
use Illuminate\Auth\Access\AuthorizationException as LaravelAuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Laravel\Passport\Exceptions\MissingScopeException;
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

        // oauth
        \League\OAuth2\Server\Exception\OAuthServerException::class,
    ];

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
        view()->share('currentAction', $this->statusCode($e));
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

        if ($e instanceof AuthenticationException) {
            return $this->unauthenticated($request, $e);
        }

        if (config('app.debug')) {
            $response = parent::render($request, $e);
        } else {
            $message = $this->exceptionMessage($e);

            if (is_json_request()) {
                $response = response(['error' => $message]);
            } else {
                $response = response()->view('layout.error', ['exceptionMessage' => $message]);
            }
        }

        return $response->setStatusCode($this->statusCode($e));
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if (is_json_request()) {
            return response(['authentication' => 'basic'], 401);
        }

        return response()->view('users.login');
    }

    private function exceptionMessage($e)
    {
        if ($e instanceof ModelNotFoundException) {
            return;
        }

        if ($this->statusCode($e) >= 500) {
            return;
        }

        return $e->getMessage();
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
            $scope->setTag('http_code', (string) $this->statusCode($e));
        });

        $ref = app('sentry')->captureException($e);

        view()->share('ref', $ref);
    }

    private function statusCode($e)
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
        } else {
            return 500;
        }
    }
}
