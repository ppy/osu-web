<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use Illuminate\Cookie\CookieJar;
use Symfony\Component\HttpFoundation\Cookie;

class OsuCookieJar extends CookieJar
{
    public function queueForget($name, $path = null, $domain = null)
    {
        $domain = $domain ?? $this->domain;
        $path = $path ?? $this->path;

        // Don't use $this->make as it can't set empty domain.
        // Protip:
        // - when using 'domain', browser sets '.domain'
        // - when using '.domain', browser sets '.domain'
        // - when using '', browser sets 'domain'
        $cookie = new Cookie($name, '', 1, $path, $domain);

        // Don't use $this->queue as it doesn't handle duplicate cookies
        // with same name and path but different domain.
        $this->queued["{$domain}:{$name}"][$path] = $cookie;
    }
}
