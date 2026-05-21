<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'show' => [
        'non_preserved' => 'Esta pontuação está marcada para eliminação e desaparecerá em breve.',
        'title' => ':username em :title [:version]',

        'beatmap' => [
            'by' => 'por :artist',
        ],

        'player' => [
            'by' => 'Jogado por',
            'played_on' => 'Jogado em',
            'submitted_on' => 'Submetido a',
            'watched' => 'Assistido',
            'watched_count' => ':count_delimited vez|:count_delimited vezes',

            'rank' => [
                'country' => 'Classificação Nacional',
                'global' => 'Classificação Global',
            ],
        ],
    ],

    'status' => [
        'non_best' => 'Apenas as melhores pontuações pessoais atribuem pp',
        'no_pp' => 'não são atribuídos pp para esta pontuação',
        'processing' => 'Esta pontuação ainda está a ser calculada e será apresentada em breve',
        'no_rank' => 'Esta pontuação não tem classificação por estar não classificada ou marcada para eliminação',
    ],
];
