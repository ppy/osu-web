<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

class ProxyMediaController extends Controller
{
    public function __invoke()
    {
        $url = presence(get_string(request('url')));

        if (!isset($url)) {
            return response('Missing url parameter', 422);
        }

        // Tell browser not to request url for a while.
        return redirect(proxy_media($url))->header('Cache-Control', 'max-age=600');
    }
}
