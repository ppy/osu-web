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
        'beatmap-deleted' => 'beatmap on poistettu',
        'difference' => ':difference pisteen erotuksella',
        'failed' => 'HÄVISI',
        'header' => 'Moninpelit',
        'in-progress' => '(peli meneillään)',
        'in_progress_spinner_label' => '',
        'loading-events' => 'Ladataan tapahtumia...',
        'winner' => ':team voitti',

        'events' => [
            'player-left' => ':user poistui pelistä',
            'player-joined' => ':user liittyi peliin',
            'player-kicked' => ':user potkittiin pelistä',
            'match-created' => ':user loi pelin',
            'match-disbanded' => 'peli lakkautettiin',
            'host-changed' => ':user on nyt isäntä',

            'player-left-no-user' => 'pelaaja poistui pelistä',
            'player-joined-no-user' => 'pelaaja liittyi peliin',
            'player-kicked-no-user' => 'pelaaja potkittiin pelistä',
            'match-created-no-user' => 'peli luotiin',
            'match-disbanded-no-user' => 'peli lakkautettiin',
            'host-changed-no-user' => 'isäntä vaihtui',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Tarkkuus',
                'combo' => 'Combo',
                'score' => 'Pisteet',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Kaikki vastakkain',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Tiimi VS',
            'tag-team-vs' => 'Tag Tiimi VS',
        ],

        'teams' => [
            'blue' => 'Sininen joukkue',
            'red' => 'Punainen joukkue',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Korkeimmat Pisteet',
            'accuracy' => 'Korkein tarkkuus',
            'combo' => 'Korkein combo',
            'scorev2' => 'Pisteytys V2',
        ],
    ],
];
