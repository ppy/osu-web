<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'show' => [
        'title' => ':username на :title [:version]',

        'beatmap' => [
            'by' => 'от :artist',
        ],

        'player' => [
            'by' => 'Сыграна',
            'submitted_on' => 'Рекорд поставлен',

            'rank' => [
                'country' => 'Рейтинг страны',
                'global' => 'Место в рейтинге',
            ],
        ],
    ],

    'status' => [
        'non_best' => 'Только лучшие рекорды приносят pp',
        'non_passing' => 'Только проверенные рекорды приносят pp',
        'processing' => 'Этот результат все ещё подсчитывается и будет отображен позже',
    ],
];
