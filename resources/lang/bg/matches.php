<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'match' => [
        'beatmap-deleted' => 'изтрит бийтмап',
        'difference' => 'по :difference',
        'failed' => 'ПРОВАЛИЛ СЕ',
        'header' => 'Мултиплейър състезания',
        'in-progress' => '(състезание в ход)',
        'in_progress_spinner_label' => 'състезание в ход',
        'loading-events' => 'Зареждане на събитията...',
        'winner' => ':team победи',

        'events' => [
            'player-left' => ':user напусна състезанието',
            'player-joined' => ':user се присъедини към състезанието',
            'player-kicked' => ':user е изгонен от състезанието',
            'match-created' => ':user създаде състезанието',
            'match-disbanded' => 'състезанието е разпуснато',
            'host-changed' => ':user стана домакин',

            'player-left-no-user' => 'играч напусна състезанието',
            'player-joined-no-user' => 'играч се присъедини към състезанието',
            'player-kicked-no-user' => 'играч е изгонен от състезанието',
            'match-created-no-user' => 'състезанието е създадено',
            'match-disbanded-no-user' => 'състезанието е разпуснато',
            'host-changed-no-user' => 'домакинът е променен',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Прецизност',
                'combo' => 'Комбо',
                'score' => 'Точки',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],

        'teams' => [
            'blue' => 'Синият отбор',
            'red' => 'Червеният отбор',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Най-висок резултат',
            'accuracy' => 'Най-висока прецизност',
            'combo' => 'Най-дълго комбо',
            'scorev2' => 'Score V2',
        ],
    ],
];
