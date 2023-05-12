<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Pre-packaged collections of beatmaps based around a common theme.',
        'empty' => 'Coming soon!',
        'nav_title' => 'listing',
        'title' => 'Beatmap Packs',

        'blurb' => [
            'important' => 'READ THIS BEFORE DOWNLOADING',
            'install_instruction' => 'Installation: Once a pack has been downloaded, extract the contents of the pack into your osu! Songs directory and osu! will do the rest.',
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
        'featured' => 'Featured Artist',
        'loved' => 'Project Loved',
        'standard' => 'Standard',
        'theme' => 'Theme',
        'tournament' => 'Tournament',
    ],

    'require_login' => [
        '_' => 'You need to be :link to download',
        'link_text' => 'signed in',
    ],
];
