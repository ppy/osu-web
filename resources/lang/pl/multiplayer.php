<?php
/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'header' => 'Tryb Wieloosobowy',
        'team-types' => [
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],
        'events' => [
            'player-left' => ':user wyszedł z gry',
            'player-joined' => ':user dołączył do gry',
            'player-kicked' => ':user został wyrzucony z gry',
            'match-created' => ':user stworzył grę',
            'match-disbanded' => 'gra została rozwiązana',
            'host-changed' => ':user został hostem',
            'player-left-no-user' => 'użytkownik wyszedł z gry',
            'player-joined-no-user' => 'użytkownik dołączył do gry',
            'player-kicked-no-user' => 'użytkownik został wyrzucony z gry',
            'match-created-no-user' => 'gra została stworzona',
            'match-disbanded-no-user' => 'gra została rozwiązana',
            'host-changed-no-user' => 'host został zmieniony',
        ],
        'in-progress' => '(mecz trwa)',
        'score' => [
            'stats' => [
                'accuracy' => 'Celność',
                'combo' => 'Combo',
                'score' => 'Wynik',
            ],
        ],
        'failed' => 'PRZEGRAŁA',
        'teams' => [
            'blue' => 'Niebieska Drużyna',
            'red' => 'Czarwona Drużyna',
        ],
        'winner' => ':team wygrywa',
        'difference' => 'o :difference',
        'loading-events' => 'Ładowanie zdarzeń...',
        'more-events' => 'Pokaż wszystkie...',
        'beatmap-deleted' => 'usunięto mapę',
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Najwięcej punktów',
            'accuracy' => 'Najwyższa celność',
            'combo' => 'Najwyższe combo',
            'scorev2' => 'Score V2',
        ],
    ],
];
