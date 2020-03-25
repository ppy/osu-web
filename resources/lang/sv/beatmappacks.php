<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'För-samlade kollektioner av beatmaps baserad på ett gemensamt tema.',
        'nav_title' => '',
        'title' => 'Beatmap Samlingar',

        'blurb' => [
            'important' => 'LÄS DETTA INNAN NEDLADDNING',
            'instruction' => [
                '_' => "Installation: När en samling har laddats ner, extrahera .rar filen till din osu! Songs mapp.
                    Alla låtar är fortfarande i .zip/.osz-samlingen, så osu! kommer behöva extrahera beatmapsen nästa gång du går in i spelläget.
                    Extrahera :scary .zip/.osz själv,
                    annars kommer beatmapsen visas inkorrekt i osu! och kommer inte fungera korrekt.",
                'scary' => 'INTE',
            ],
            'note' => [
                '_' => 'Notera att det är högst rekommenderat att :scary, eftersom de äldsta mapsen är av mycket lägre kvalité jämfört med de nyaste mapsen.',
                'scary' => 'ladda ner samlingarna från nyaste till äldsta',
            ],
        ],
    ],

    'show' => [
        'download' => 'Ladda ner',
        'item' => [
            'cleared' => 'rensad',
            'not_cleared' => 'ej rensad',
        ],
    ],

    'mode' => [
        'artist' => 'Artist/Album',
        'chart' => 'I rampljuset',
        'standard' => 'Standard',
        'theme' => 'Tema',
    ],

    'require_login' => [
        '_' => 'Du behöver vara :link för att ladda ner',
        'link_text' => 'inloggad',
    ],
];
