<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Forhåndspakkede samlinger av beatmaps basert rundt et felles tema.',
        'nav_title' => 'liste',
        'title' => 'Beatmappakker',

        'blurb' => [
            'important' => 'LES DETTE FØR NEDLASTING',
            'install_instruction' => '',
            'note' => [
                '_' => 'Legg også merke til at det er sterkt anbefalt å :scary, ettersom de eldste mappene er av mye lavere kvalitet enn de fleste nye maps.',
                'scary' => 'laste ned de nye pakkene først',
            ],
        ],
    ],

    'show' => [
        'download' => 'Last ned',
        'item' => [
            'cleared' => 'fullført',
            'not_cleared' => 'ikke fullført',
        ],
        'no_diff_reduction' => [
            '_' => '',
            'link' => '',
        ],
    ],

    'mode' => [
        'artist' => 'Artist/Album',
        'chart' => 'I rampelyset',
        'standard' => 'Standard',
        'theme' => 'Tema',
    ],

    'require_login' => [
        '_' => 'Du må være :link for å laste ned',
        'link_text' => 'logget inn',
    ],
];
