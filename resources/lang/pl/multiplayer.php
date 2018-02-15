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
        'header' => 'Tryb wieloosobowy',
        'team-types' => [
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],
        'events' => [
            'player-left' => 'gracz :user wyszedł z gry',
            'player-joined' => 'gracz :user dołączył do gry',
            'player-kicked' => 'gracz :user został wyrzucony z gry',
            'match-created' => 'gracz :user stworzył grę',
            'match-disbanded' => 'gra została rozwiązana',
            'host-changed' => 'gracz :user został hostem',
            'player-left-no-user' => 'gracz wyszedł z gry',
            'player-joined-no-user' => 'gracz dołączył do gry',
            'player-kicked-no-user' => 'gracz został wyrzucony z meczu',
            'match-created-no-user' => 'Mecz został stworzona',
            'match-disbanded-no-user' => 'Mecz został zakończony',
            'host-changed-no-user' => 'host został zmieniony',
        ],
        'in-progress' => '(mecz trwa)',
        'score' => [
            'stats' => [
                'accuracy' => 'Precyzja',
                'combo' => 'Combo',
                'score' => 'Wynik',
            ],
        ],
        'failed' => 'PRZEGRANA',
        'teams' => [
            'blue' => 'Drużyna Niebieska',
            'red' => 'Drużyna Czerwona',
        ],
        'winner' => ':team wygrywa',
        'difference' => 'różnicą :difference punktów',
        'loading-events' => 'Ładowanie zdarzeń...',
        'more-events' => 'Wyświetl wszystkie...',
        'beatmap-deleted' => 'usunięto beatmapę',
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Najlepszy wynik',
            'accuracy' => 'Najwyższa precyzja',
            'combo' => 'Największe combo',
            'scorev2' => 'Score V2',
        ],
    ],
];
