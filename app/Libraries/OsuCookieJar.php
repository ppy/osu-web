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
