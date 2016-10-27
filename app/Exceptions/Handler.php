<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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

use App;
use Auth;
use Exception;
use Illuminate\Auth\Access\AuthorizationException as LaravelAuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Sentry;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
        HttpException::class,
        LaravelAuthorizationException::class,
        ModelNotFoundException::class,
        TokenMismatchException::class,
        ValidationException::class,

        // local
        AuthorizationException::class,
        SilencedException::class,
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
        view()->share('current_action', $this->statusCode($e));
        view()->share('current_section', 'error');

        // immediately done if the error should not be reported
        if ($this->shouldntReport($e)) {
            return;
        }

        if (config('sentry.dsn')) {
            $this->reportWithSentry($e);
        } else {
            return parent::report($e);
        }
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
        } elseif ($e instanceof AuthorizationException) {
            return 403;
        } else {
            return 500;
        }
    }

    private function reportWithSentry($e)
    {
        $tags = [
            'http_code' => $this->statusCode($e),
        ];

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

        Sentry::user_context($userContext);

        $ref = Sentry::getIdent(Sentry::captureException($e, $tags));

        view()->share('ref', $ref);
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
            if ($this->isHttpException($e)) {
                $response = $this->renderHttpException($e);
            } else {
                $response = parent::render($request, $e);
            }
        } else {
            if ($request->ajax()) {
                $response = response(['error' => $e->getMessage()]);
            } else {
                $response = response()->view('layout.error');
            }
        }

        return $response->setStatusCode($this->statusCode($e));
    }

    protected function unauthenticated($request, $exception)
    {
        if ($request->expectsJson()) {
            return response(['authentication' => 'basic'], 401);
        }

        return response()->view('users.login')->setStatusCode(401);
    }
}
