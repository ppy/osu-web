<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SentryMetrics
{
    public function handle(Request $request, \Closure $next): Response
    {
        $start = microtime(true);

        $response = $next($request);

        $end = microtime(true);
        $duration = $end - $start;

        if ($duration > $GLOBALS['cfg']['osu']['sentry']['min_log_duration']) {
            $data = DatadogMetrics::makeLogTags($request, $response);
            $name = "{$data['namespace']}/{$data['controller']}:{$data['action']}";

            $transactionContext = \Sentry\Tracing\TransactionContext::make()
                ->setName($name)
                ->setData($data)
                ->setStartTimestamp($start)
                ->setParentSampled(false)
                ->setSampled(true);

            \Sentry\startTransaction($transactionContext)->finish($end);
        }

        return $response;
    }
}
