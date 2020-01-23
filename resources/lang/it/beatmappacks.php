<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'index' => [
        'description' => 'Collezioni pre-confezionate di beatmap con un tema comune.',
        'nav_title' => 'lista',
        'title' => 'Pacchetti Beatmap',

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
    ],

    'show' => [
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
