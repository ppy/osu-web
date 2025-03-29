<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use ChaseConey\LaravelDatadogHelper\Middleware\LaravelDatadogMiddleware;
use Datadog;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DatadogMetrics extends LaravelDatadogMiddleware
{
    public static function makeLogTags(Request $request, Response $response): array
    {
        static $hostname;
        if (!isset($hostname)) {
            $hostname = gethostname();
            if (!is_string($hostname)) {
                $hostname = 'unknown';
            }
        }

        return [
            'action' => 'error_page',
            'api' => is_api_request() ? 'true' : 'false',
            'controller' => 'error',
            'namespace' => 'error',
            'pod_name' => $hostname,
            'section' => 'error',
            'status_code' => $response->getStatusCode(),
            'status_code_extra' => $request->attributes->get('status_code_extra'),
            ...app('route-section')->getOriginal(),
        ];
    }

    /**
     * Logs the duration of a specific request through the application
     *
     * @param Request $request
     * @param Response $response
     * @param float $startTime
     */
    protected static function logDuration(Request $request, Response $response, $startTime)
    {
        $tags = static::makeLogTags($request, $response);

        $duration = microtime(true) - $startTime;

        Datadog::timing($GLOBALS['cfg']['datadog-helper']['prefix_web'].'.request_time', $duration, 1, $tags);
    }
}
