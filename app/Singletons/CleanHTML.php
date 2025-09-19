<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Singletons;

use HTMLPurifier;
use HTMLPurifier_Config;

class CleanHTML
{
    private HTMLPurifier $purifier;

    public function __construct()
    {
        $cachePath = storage_path('htmlpurifier');
        if (!is_dir($cachePath)) {
            try {
                mkdir($cachePath, 0700, true);
            } catch (\ErrorException $e) {
                // There may be race condition between first is_dir and mkdir
                if (!is_dir($cachePath)) {
                    throw $e;
                }
            }
        }

        $config = HTMLPurifier_Config::createDefault();
        $config->set('Cache.SerializerPath', $cachePath);
        $config->set('Attr.AllowedRel', ['nofollow']);
        $config->set('CSS.Trusted', true);
        $config->set('HTML.MaxImgLength', 5000);
        $config->set('HTML.SafeIframe', true);
        $config->set('URI.SafeIframeRegexp', '#^https://www.youtube.com/embed/[A-z0-9_-]+\?rel=0$#');

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
        $def->addAttribute('img', 'style', 'Text');

        $def->addAttribute('img', 'data-src', 'Text');
        $def->addAttribute('img', 'data-height', 'Text');
        $def->addAttribute('img', 'data-width', 'Text');
        $def->addAttribute('img', 'data-index', 'Text');
        $def->addAttribute('img', 'data-gallery-id', 'Text');

        $def->addAttribute('a', 'data-user-id', 'Text');

        $def->addAttribute('iframe', 'allowfullscreen', 'Text');

        $this->purifier = new HTMLPurifier($config);
    }

    public function purify($text)
    {
        return $this->purifier->purify($text);
    }
}
