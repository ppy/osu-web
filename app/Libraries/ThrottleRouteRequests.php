<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use Illuminate\Routing\Middleware\ThrottleRequests;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

class ThrottleRouteRequests extends ThrottleRequests
{
    /**
     * Overriden to skip adding the headers for now.
     */
    protected function addHeaders(Response $response, $maxAttempts, $remainingAttempts, $retryAfter = null)
    {
        return $response;
    }

    /**
     * {@inheritdoc}
     */
    protected function resolveRequestSignature($request)
    {
        $userId = optional($request->user())->getAuthIdentifier() ?? $request->ip();

        if ($route = $request->route()) {
            return sha1($userId.'|'.$route->getDomain().'|'.$request->path());
        }

        throw new RuntimeException('Unable to generate the request signature. Route unavailable.');
    }
}
