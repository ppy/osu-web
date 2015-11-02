<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License as published by
 *    the Free Software Foundation, version 3 of the License.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace App\Libraries;

use HTMLPurifier;
use HTMLPurifier_Config;

class CleanHTML
{
    public static function purify($text)
    {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Cache.SerializerPath', storage_path().'/htmlpurifier');
        $config->set('Attr.AllowedRel', ['nofollow']);
        $config->set('HTML.Trusted', true);

        $def = $config->getHTMLDefinition(true);

        $def->addAttribute('img', 'data-layzr', 'Text');
        $def->addAttribute('img', 'src', 'Text');

        $def->addAttribute('span', 'data-src', 'Text');
        $def->addAttribute('span', 'data-height', 'Text');
        $def->addAttribute('span', 'data-width', 'Text');
        $def->addAttribute('span', 'data-index', 'Text');
        $def->addAttribute('span', 'data-gallery-id', 'Text');

        return (new HTMLPurifier($config))->purify($text);
    }
}
