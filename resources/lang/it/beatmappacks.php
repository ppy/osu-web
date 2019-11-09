<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'index' => [
        'blurb' => [
            'important' => 'LEGGI PRIMA DI SCARICARE',
            'instruction' => [
                '_' => "Installazione: Una volta scaricato il pacchetto desiderato, estrai il .rar nella cartella Songs di osu!.
                    Tutte le canzoni saranno ancora .zip e/o .osz dentro il pacchetto, quindi osu! dovrà estrarre le beatmap la prossima volta che entri nella modalità Play.
                    :scary estrarre gli zip/osz manualmente,
                    altrimenti le beatmap non verrano visualizzate correttamente su osu! e non funzioneranno a dovere.",
                'scary' => 'NON',
            ],
            'note' => [
                '_' => 'Nota inoltre che è altamente consigliato di :scary, dato che le mappe più vecchie sono di qualità molto inferiore rispetto a quelle più recenti.',
                'scary' => 'scaricare i pacchetti dal più recente al più vecchio',
            ],
        ],
        'title' => 'Pacchetti Beatmap',
        'description' => 'Collezioni pre-confezionate di beatmap con un tema comune.',
    ],

    'show' => [
        'back' => '',
        'download' => 'Scarica',
        'item' => [
            'cleared' => 'completata',
            'not_cleared' => 'non completata',
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
