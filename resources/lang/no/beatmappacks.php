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
            'instruction' => [
                '_' => "Installasjon: Pakk ut .rar filen i osu!'s \"Songs\" mappe når en pakke er lastet ned,
                    Alle sanger i pakken er fortsatt i filformatet .zip og/eller .osz, så osu! vil pakke dem ut automatisk neste gang du spiller.
                    :scary pakk ut zip/osz filene selv,
                    ettersom dette kan medføre til at beatmappene ikke vises eller fungerer riktig i osu!",
                'scary' => 'ALDRI',
            ],
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
