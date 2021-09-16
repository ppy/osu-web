<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'show' => [
        'title' => ':username su :title [:version]',

        'beatmap' => [
            'by' => 'di :artist',
        ],

        'player' => [
            'by' => 'Giocata da',
            'submitted_on' => 'Inviato il',

            'rank' => [
                'country' => ' Classifica Nazionale',
                'global' => 'Classifica Globale',
            ],
        ],
    ],

    'status' => [
        'non_best' => 'Solo i punteggi personali migliori attribuiscono pp',
        'processing' => 'Questo punteggio dev\'essere ancora calcolato e verrà mostrato presto',
    ],
];
