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
        'header' => 'Tryb wieloosobowy',
        'team-types' => [
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],
        'events' => [
            'player-left' => 'gracz :user wyszedł z meczu',
            'player-joined' => 'gracz :user dołączył do meczu',
            'player-kicked' => 'gracz :user został wyrzucony z meczu',
            'match-created' => 'gracz :user stworzył mecz',
            'match-disbanded' => 'mecz został rozwiązany ',
            'host-changed' => 'gracz :user został hostem',

            'player-left-no-user' => 'gracz opuścił mecz',
            'player-joined-no-user' => 'gracz dołączył do meczu',
            'player-kicked-no-user' => 'gracz został wyrzucony z meczu',
            'match-created-no-user' => 'mecz został utworzony',
            'match-disbanded-no-user' => 'mecz został zakończony',
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
            'blue' => 'Drużyna niebieska',
            'red' => 'Drużyna czerwona',
        ],
        'winner' => ':team wygrywa',
        'difference' => 'różnicą :difference punktów',
        'loading-events' => 'Ładowanie zdarzeń...',
        'more-events' => 'wyświetl wszystkie...',
        'beatmap-deleted' => 'usunięta beatmapa',
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
