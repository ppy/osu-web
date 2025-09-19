<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'match' => [
        'beatmap-deleted' => 'удалённая карта',
        'failed' => 'НЕ ПРОШЁЛ',
        'header' => 'Многопользовательская игра',
        'in-progress' => '(матч в процессе)',
        'in_progress_spinner_label' => 'матч в процессе',
        'loading-events' => 'Загрузка событий...',
        'winner' => ':team победила',
        'winner_by' => ':winner с разницей в :difference очков',

        'events' => [
            'game_aborted' => 'игра была прервана',
            'game_aborted_no_user' => 'игра была прервана',
            'game_completed' => 'игра завершилась',
            'game_completed_no_user' => 'игра завершилась',
            'host_changed' => ':user стал хостом',
            'host_changed_no_user' => 'хост поменялся',
            'player_joined' => ':user зашёл в комнату',
            'player_joined_no_user' => 'игрок зашёл в комнату',
            'player_kicked' => ':user был выгнан из комнаты',
            'player_kicked_no_user' => 'игрок был выгнан из комнаты',
            'player_left' => ':user покинул комнату',
            'player_left_no_user' => 'игрок покинул комнату',
            'room_created' => ':user создал комнату',
            'room_created_no_user' => 'комната была создана',
            'room_disbanded' => 'комната была распущена',
            'room_disbanded_no_user' => 'комната была распущена',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Точность',
                'combo' => 'Комбо',
                'score' => 'Очки',
            ],
        ],

        'team_types' => [
            'head_to_head' => 'Каждый сам за себя',
            'tag_coop' => 'Совместное прохождение',
            'tag_team_versus' => 'Совместное прохождение по командам',
            'team_versus' => 'Противостояние команд',
        ],

        'teams' => [
            'blue' => 'Синяя команда',
            'red' => 'Красная команда',
        ],
    ],
    'game' => [
        'freestyle' => 'Фристайл',

        'scoring-type' => [
            'score' => 'Наибольшее кол-во очков',
            'accuracy' => 'Наилучшая точность',
            'combo' => 'Наивысшее комбо',
            'scorev2' => 'Score V2',
        ],
    ],
];
