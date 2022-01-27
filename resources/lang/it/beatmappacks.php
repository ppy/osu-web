<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Collezioni pre-confezionate di beatmap con un tema comune.',
        'nav_title' => 'lista',
        'title' => 'Pacchetti Beatmap',

        'blurb' => [
            'important' => 'LEGGI PRIMA DI SCARICARE',
            'install_instruction' => 'Installazione: Una volta che un pacchetto è stato scaricato, estrai il contenuto del pacchetto nella cartella contenente i brani di osu!, lui penserà al resto.',
            'note' => [
                '_' => 'Nota inoltre che è altamente consigliato di :scary, dato che le mappe più vecchie sono di qualità molto inferiore rispetto a quelle più recenti.',
                'scary' => 'scaricare i pacchetti dal più recente al più vecchio',
            ],
        ],
    ],

    'show' => [
        'download' => 'Scarica',
        'item' => [
            'cleared' => 'completata',
            'not_cleared' => 'non completata',
        ],
        'no_diff_reduction' => [
            '_' => 'Le :link non possono essere utilizzate per completare questo pacchetto.',
            'link' => 'mod che riducono la difficoltà',
        ],
    ],

    'mode' => [
        'artist' => 'Artista/Album',
        'chart' => 'Spotlight',
        'standard' => 'Standard',
        'theme' => 'Tema',
    ],

    'require_login' => [
        '_' => 'Devi :link per scaricare',
        'link_text' => 'accedere',
    ],
];
