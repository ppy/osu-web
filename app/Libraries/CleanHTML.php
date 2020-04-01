<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

        $def->addAttribute('audio', 'preload', 'Text');

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
