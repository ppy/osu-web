<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

namespace App\Models\Wiki;

class Redirect extends Page
{
    public $path;
    public $locale;

    public function __construct($path, $locale)
    {
        $this->path = $this->cleanPath($path);
        $this->locale = $locale;
    }

    public function target()
    {
        $redirectList = explode(PHP_EOL, static::fetchContent('redirect.txt'));
        $pattern = '/^'.preg_quote($this->path, '/').'/';
        foreach ($redirectList as &$value) {
            if (preg_match($pattern, $value)) {
                $target = preg_replace('/^.*\s/', '', $value);
                return $target;
            }
        }
    }

}
