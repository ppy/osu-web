<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Färdigförpackade samlingar med beatmaps som är baserade på ett gemensamt tema.',
        'nav_title' => 'listning',
        'title' => 'Beatmap-samlingar',

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
                '_' => 'Notera att det är som högst rekommenderat att :scary, eftersom de äldsta mapparna är av mycket lägre kvalité jämfört med de nyaste mapparna.',
                'scary' => 'ladda ner samlingarna från nyaste till äldsta',
            ],
        ],
    ],

    'show' => [
        'download' => 'Ladda ner',
        'item' => [
            'cleared' => 'avklarad',
            'not_cleared' => 'ej avklarad',
        ],
        'no_diff_reduction' => [
            '_' => ':link kan inte användas för att avklara detta paket.',
            'link' => 'Mods för minskad svårighetsgrad',
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
