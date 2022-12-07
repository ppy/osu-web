<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'match' => [
        'beatmap-deleted' => 'удалённая карта',
        'difference' => 'с разницей в :difference очков',
        'failed' => 'НЕ ПРОШЁЛ',
        'header' => 'Многопользовательская игра',
        'in-progress' => '(матч в процессе)',
        'in_progress_spinner_label' => 'матч в процессе',
        'loading-events' => 'Загрузка событий...',
        'winner' => ':team победила',

        'events' => [
            'player-left' => ':user покинул комнату',
            'player-joined' => ':user зашёл в комнату',
            'player-kicked' => ':user был выгнан из комнаты',
            'match-created' => ':user создал комнату',
            'match-disbanded' => 'комната была распущена',
            'host-changed' => ':user стал хостом',

            'player-left-no-user' => 'игрок покинул комнату',
            'player-joined-no-user' => 'игрок зашёл в комнату',
            'player-kicked-no-user' => 'игрок был выгнан из комнаты',
            'match-created-no-user' => 'комната была создана',
            'match-disbanded-no-user' => 'комната была распущена',
            'host-changed-no-user' => 'хост поменялся',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Точность',
                'combo' => 'Комбо',
                'score' => 'Очки',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Каждый сам за себя',
            'tag-coop' => 'Прохождение по секциям',
            'team-vs' => 'Противостояние команд',
            'tag-team-vs' => 'Секционное противостояние команд',
        ],

        'teams' => [
            'blue' => 'Синяя команда',
            'red' => 'Красная команда',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Наибольшее кол-во очков',
            'accuracy' => 'Наилучшая точность',
            'combo' => 'Наивысшее комбо',
            'scorev2' => 'Score V2',
        ],
    ],
];
