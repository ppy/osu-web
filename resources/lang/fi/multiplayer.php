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
        'header' => 'Moninpeliottelut',
        'team-types' => [
            'head-to-head' => 'Kasvokkain',
            'tag-coop' => '',
            'team-vs' => '',
            'tag-team-vs' => '',
        ],
        'events' => [
            'player-left' => ':user poistui ottelusta',
            'player-joined' => ':user liittyi otteluun',
            'player-kicked' => ':user on potkittu ottelusta',
            'match-created' => ':user loi ottelun',
            'match-disbanded' => 'ottelu lakkautettiin',
            'host-changed' => 'käyttäjästä :user tuli isäntä',

            'player-left-no-user' => 'pelaaja poistui ottelusta',
            'player-joined-no-user' => 'pelaaja liittyi otteluun',
            'player-kicked-no-user' => 'pelaaja on potkittu ottelusta',
            'match-created-no-user' => 'ottelu luotiin',
            'match-disbanded-no-user' => 'ottelu lakkautettiin',
            'host-changed-no-user' => 'isäntä muuttui',
        ],
        'in-progress' => '(ottelu kesken)',
        'score' => [
            'stats' => [
                'accuracy' => 'Tarkkuus',
                'combo' => 'Combo',
                'score' => 'Pistemäärä',
            ],
        ],
        'failed' => 'EPÄONNISTUNUT',
        'teams' => [
            'blue' => 'Sininen joukkue',
            'red' => 'Punainen joukkue',
        ],
        'winner' => ':team voitti',
        'difference' => 'erotuksella :difference',
        'loading-events' => 'Ladataan tapahtumia...',
        'more-events' => 'näytä kaikki...',
        'beatmap-deleted' => 'poistettu rytmikartta',
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Korkein pistemäärä',
            'accuracy' => 'Korkein tarkkuus',
            'combo' => 'Korkein combo',
            'scorev2' => '',
        ],
    ],
];
