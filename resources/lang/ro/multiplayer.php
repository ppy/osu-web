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
        'header' => 'Meciuri multijucător',
        'team-types' => [
            'head-to-head' => 'Cap la cap',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],
        'events' => [
            'player-left' => ':user a părăsit meciul',
            'player-joined' => ':user s-a alăturat meciului',
            'player-kicked' => ':user a fost dat afară din meci',
            'match-created' => ':user a creat meciul',
            'match-disbanded' => 'meciul a fost desființat',
            'host-changed' => ':user a devenit gazda',

            'player-left-no-user' => 'un jucător a părăsit meciul',
            'player-joined-no-user' => 'un jucător s-a alăturat meciului',
            'player-kicked-no-user' => 'un jucător a fost dat afară din meci',
            'match-created-no-user' => 'meciul a fost creat',
            'match-disbanded-no-user' => 'meciul a fost desființat',
            'host-changed-no-user' => 'gazda s-a schimbat',
        ],
        'in-progress' => '(meci în desfășurare)',
        'score' => [
            'stats' => [
                'accuracy' => 'Precizie',
                'combo' => 'Combo',
                'score' => 'Scor',
            ],
        ],
        'failed' => 'EȘUAT',
        'teams' => [
            'blue' => 'Echipa albastră',
            'red' => 'Echipa roșie',
        ],
        'winner' => ':team câștigă',
        'difference' => 'cu :difference puncte',
        'loading-events' => 'Se încarcă evenimentele...',
        'more-events' => 'vezi tot...',
        'beatmap-deleted' => 'beatmap șters',
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Cel mai mare scor',
            'accuracy' => 'Cea mai mare precizie',
            'combo' => 'Cel mai mare combo',
            'scorev2' => 'Score V2',
        ],
    ],
];
