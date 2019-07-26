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
    'match' => [
        'beatmap-deleted' => 'выдаленая бітмапа',
        'difference' => 'з розніцай у :difference ачкоў',
        'failed' => 'ПРОЙГРЫШ',
        'header' => 'Шматкарыстальніцкая гульня',
        'in-progress' => '(матч ў працэсе)',
        'in_progress_spinner_label' => 'матч ў працэсе',
        'loading-events' => 'Загрузка падзей...',
        'winner' => ':team перамагла,',

        'events' => [
            'player-left' => ':user пакінуў гульню',
            'player-joined' => ':user далучыўся да гульні',
            'player-kicked' => ':user быў выгнаны з гульні',
            'match-created' => ':user стварыў гульню',
            'match-disbanded' => 'гульня была распушчана',
            'host-changed' => ':user стаў хастом',

            'player-left-no-user' => 'гулец пакінуў гульню',
            'player-joined-no-user' => 'гулец далучыўся да гульні',
            'player-kicked-no-user' => 'гулец быў выкінуты з гульні',
            'match-created-no-user' => 'гульня была створана',
            'match-disbanded-no-user' => 'гульня была распушчана',
            'host-changed-no-user' => 'хвост быў зменены',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Дакладнасць',
                'combo' => 'Комба',
                'score' => 'Ачкі',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],

        'teams' => [
            'blue' => 'Сіняя каманда',
            'red' => 'Чырвоная каманда',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Найлепшыя ачкі',
            'accuracy' => 'Найлепшая дакладнасць',
            'combo' => 'Найлепшае комба',
            'scorev2' => 'Score V2',
        ],
    ],
];
