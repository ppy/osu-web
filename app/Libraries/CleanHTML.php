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

        $def->addElement(
            'audio',
            'Inline',
            'Inline',
            'Common',
            [
                'src' => 'URI',
                'controls' => 'Text',
            ]
        );

        $def->addAttribute('img', 'data-normal', 'Text');
        $def->addAttribute('img', 'src', 'Text');

        $def->addAttribute('span', 'data-src', 'Text');
        $def->addAttribute('span', 'data-height', 'Text');
        $def->addAttribute('span', 'data-width', 'Text');
        $def->addAttribute('span', 'data-index', 'Text');
        $def->addAttribute('span', 'data-gallery-id', 'Text');

        $def->addAttribute('a', 'data-user-id', 'Text');

        return (new HTMLPurifier($config))->purify($text);
    }
}
