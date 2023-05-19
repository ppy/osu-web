<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Färdigförpackade samlingar med beatmaps som är baserade på ett gemensamt tema.',
        'empty' => 'Kommer snart!',
        'nav_title' => 'listning',
        'title' => 'Beatmap-samlingar',

        'blurb' => [
            'important' => 'LÄS DETTA INNAN NEDLADDNING',
            'install_instruction' => 'Installation: När ett paket har laddats ner, extrahera innehållet i paketet i osu! Låt-mappen och osu! kommer att göra resten.',
            'note' => [
                '_' => 'Notera att det är som högst rekommenderat att :scary, eftersom de äldsta mapparna är av mycket lägre kvalité jämfört med de nyaste mapparna.',
                'scary' => 'ladda ner samlingarna från senaste till tidigaste',
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
        'featured' => 'Utvald artist',
        'standard' => 'Standard',
        'theme' => 'Tema',
        'tournament' => 'Turnering',
    ],

    'require_login' => [
        '_' => 'Du behöver vara :link för att ladda ner',
        'link_text' => 'inloggad',
    ],
];
