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
        'beatmap-deleted' => 'tinanggal na beatmap',
        'difference' => 'ng :difference',
        'failed' => 'NABIGO',
        'header' => 'Mga Multiplayer na Laban',
        'in-progress' => '(laban na nag-uunlad)',
        'in_progress_spinner_label' => 'laban na nag-uunlad',
        'loading-events' => 'Naglo-load ng mga pangyayari...',
        'winner' => 'Nanalo ang :team',

        'events' => [
            'player-left' => 'Umalis si:user sa laro',
            'player-joined' => 'Sumali si:user sa laro',
            'player-kicked' => 'Tinanggal si:user sa laro',
            'match-created' => 'Gianwa ni:user ang laro',
            'match-disbanded' => 'ang laro ay binuwag',
            'host-changed' => 'Naging host si :user',

            'player-left-no-user' => 'umalis ang isang manlalaro sa laban',
            'player-joined-no-user' => 'sumali ang isang manlalaro sa laban',
            'player-kicked-no-user' => 'na-kick ang isang manlalaro sa laban',
            'match-created-no-user' => 'ang laban ay nilikha',
            'match-disbanded-no-user' => 'ang laban ay binuwag',
            'host-changed-no-user' => 'ang host ay pinalit',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Accuracy',
                'combo' => 'Combo',
                'score' => 'Iskor',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Head-to-Head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],

        'teams' => [
            'blue' => 'Asul na Pangkat',
            'red' => 'Pula na Pangkat',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Pinakamataas na Iskor',
            'accuracy' => 'Pinakamataas na Accuracy',
            'combo' => 'Pinakamataas na Combo',
            'scorev2' => 'Iskor V2',
        ],
    ],
];
