<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

class ProxyMediaController extends Controller
{
    public function __invoke()
    {
        if (!from_app_url()) {
            return response('Forbidden', 403);
        }

        $url = presence(get_string(\Request::input('url')));

        if (!isset($url)) {
            return response('Missing url parameter', 422);
        }

        // Tell browser to cache redirect url for a while.
        return redirect(proxy_media($url))->header('Cache-Control', 'max-age=86400');
    }
}
