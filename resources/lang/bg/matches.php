<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'match' => [
        'beatmap-deleted' => 'изтрит бийтмап',
        'difference' => 'по :difference',
        'failed' => 'ПРОВАЛИЛ СЕ',
        'header' => 'Мултиплейър мачове',
        'in-progress' => '(мач в ход)',
        'in_progress_spinner_label' => 'мач в ход',
        'loading-events' => 'Зареждане на събитията...',
        'winner' => ':team печели',

        'events' => [
            'player-left' => ':user напусна мача',
            'player-joined' => ':user се присъедини към мача',
            'player-kicked' => ':user бе изритан от мача',
            'match-created' => ':user създаде този мач',
            'match-disbanded' => 'мачът се разпадна',
            'host-changed' => ':user стана домакин',

            'player-left-no-user' => 'играч напусна мача',
            'player-joined-no-user' => 'играч се присъедини към мача',
            'player-kicked-no-user' => 'играч бе изритан от мача',
            'match-created-no-user' => 'мачът бе създаден',
            'match-disbanded-no-user' => 'мачът се разпадна',
            'host-changed-no-user' => 'домакинът бе сменен',
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
            'combo' => 'Най-голямо комбо',
            'scorev2' => 'Score V2',
        ],
    ],
];
