<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use ErrorException;
use HTMLPurifier;
use HTMLPurifier_Config;

class CleanHTML
{
    private HTMLPurifier $purifier;

    public function __construct()
    {
        $cachePath = storage_path().'/htmlpurifier';
        try {
            mkdir($cachePath, 0700, true);
        } catch (ErrorException $e) {
            if (!is_dir($cachePath)) {
                throw $e;
            }
        }

        $config = HTMLPurifier_Config::createDefault();
        $config->set('Cache.SerializerPath', $cachePath);
        $config->set('Attr.AllowedRel', ['nofollow']);
        $config->set('HTML.Trusted', true);
        $config->set('CSS.Trusted', true);

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

        $def->addAttribute('img', 'loading', 'Text');
        $def->addAttribute('img', 'src', 'Text');

        $def->addAttribute('span', 'data-src', 'Text');
        $def->addAttribute('span', 'data-height', 'Text');
        $def->addAttribute('span', 'data-width', 'Text');
        $def->addAttribute('span', 'data-index', 'Text');
        $def->addAttribute('span', 'data-gallery-id', 'Text');

        $def->addAttribute('a', 'data-user-id', 'Text');

        $this->purifier = new HTMLPurifier($config);
    }

    public function purify($text)
    {
        return $this->purifier->purify($text);
    }
}
