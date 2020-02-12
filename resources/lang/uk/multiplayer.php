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
        'beatmap-deleted' => 'видалена карта',
        'difference' => 'з різницею в :difference очок',
        'failed' => 'ПРОГРАШ',
        'header' => 'Багатокористувацька гра',
        'in-progress' => '(гра в процесі)',
        'in_progress_spinner_label' => 'гра в процесі',
        'loading-events' => 'Завантаження подій...',
        'winner' => ':team перемогла,',

        'events' => [
            'player-left' => ':user покинув гру',
            'player-joined' => ':user зайшов в гру',
            'player-kicked' => ':user був вигнаний з гри',
            'match-created' => ':user створив гру',
            'match-disbanded' => 'гра була розпущена',
            'host-changed' => ':user став хостом',

            'player-left-no-user' => 'гравець покинув гру',
            'player-joined-no-user' => 'гравець приєднався до гри',
            'player-kicked-no-user' => 'був вигнаний з гри',
            'match-created-no-user' => 'гра була створена',
            'match-disbanded-no-user' => 'гра була розпущена',
            'host-changed-no-user' => 'хост гри змінився',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Точність',
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
            'blue' => 'Синя команда',
            'red' => 'Червона команда',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Найвищий бал',
            'accuracy' => 'Найвища точність',
            'combo' => 'Найбільше комбо',
            'scorev2' => 'Score V2',
        ],
    ],
];
