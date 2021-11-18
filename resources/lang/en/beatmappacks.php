<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Pre-packaged collections of beatmaps based around a common theme.',
        'nav_title' => 'listing',
        'title' => 'Beatmap Packs',

        'blurb' => [
            'important' => 'READ THIS BEFORE DOWNLOADING',
            'instruction' => [
                '_' => 'Installation: Once a pack has been downloaded, extract the contents of the pack into your osu! Songs directory.',
            ],
            'note' => [
                '_' => 'Also note that it is highly recommended to :scary, since older maps are generally of much lower quality than more recent maps.',
                'scary' => 'download the packs from latest to earliest',
            ],
        ],
    ],

    'show' => [
        'download' => 'Download',
        'item' => [
            'cleared' => 'cleared',
            'not_cleared' => 'not cleared',
        ],
        'no_diff_reduction' => [
            '_' => ':link may not be used to clear this pack.',
            'link' => 'Difficulty reduction mods',
        ],
    ],

    'mode' => [
        'artist' => 'Artist/Album',
        'chart' => 'Spotlights',
        'standard' => 'Standard',
        'theme' => 'Theme',
    ],

    'require_login' => [
        '_' => 'You need to be :link to download',
        'link_text' => 'signed in',
    ],
];
