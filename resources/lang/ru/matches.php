<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'match' => [
        'beatmap-deleted' => 'удалённая карта',
        'difference' => 'с разницей в :difference очков',
        'failed' => 'НЕ ПРОШЁЛ',
        'header' => 'Многопользовательская игра',
        'in-progress' => '(игра в процессе)',
        'in_progress_spinner_label' => 'игра в процессе',
        'loading-events' => 'Загрузка событий...',
        'winner' => ':team победила',

        'events' => [
            'player-left' => ':user покинул игру',
            'player-joined' => ':user зашёл в игру',
            'player-kicked' => ':user был выгнан из игры',
            'match-created' => ':user создал игру',
            'match-disbanded' => 'игра была распущена',
            'host-changed' => ':user стал хостом',

            'player-left-no-user' => 'игрок покинул игру',
            'player-joined-no-user' => 'игрок присоединился к игре',
            'player-kicked-no-user' => 'игрок был кикнут из игры',
            'match-created-no-user' => 'игра была создана',
            'match-disbanded-no-user' => 'игра была распущена',
            'host-changed-no-user' => 'хост игры поменялся',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Точность',
                'combo' => 'Комбо',
                'score' => 'Очки',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],

        'teams' => [
            'blue' => 'Синяя команда',
            'red' => 'Красная команда',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Лучшие очки',
            'accuracy' => 'Лучшая точность',
            'combo' => 'Лучшее комбо',
            'scorev2' => 'Score V2',
        ],
    ],
];
