<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
