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
        'beatmap-deleted' => 'beatmap cancellata',
        'difference' => 'di :difference',
        'failed' => 'FALLITO',
        'header' => 'Partite Multigiocatore',
        'in-progress' => '(partita in corso)',
        'in_progress_spinner_label' => 'partita in corso',
        'loading-events' => 'Caricamento eventi...',
        'winner' => ':team vince',

        'events' => [
            'player-left' => ':user ha lasciato la partita',
            'player-joined' => ':user si è unito alla partita',
            'player-kicked' => ':user è stato cacciato dalla partita',
            'match-created' => ':user ha creato la partita',
            'match-disbanded' => 'la partita è stata terminata',
            'host-changed' => ':user è diventato l\'host',

            'player-left-no-user' => 'un giocatore ha lasciato la partita',
            'player-joined-no-user' => 'un giocatore si è unito alla partita',
            'player-kicked-no-user' => 'un giocatore è stato cacciato dalla partita',
            'match-created-no-user' => 'la partita è stata creata',
            'match-disbanded-no-user' => 'la partita è stata terminata',
            'host-changed-no-user' => 'l\'host è cambiato',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Precisione',
                'combo' => 'Combo',
                'score' => 'Punteggio',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Testa a Testa',
            'tag-coop' => 'Tag Cooperativo',
            'team-vs' => 'VS a squadre',
            'tag-team-vs' => 'Tag VS a Squadre',
        ],

        'teams' => [
            'blue' => 'Team Blu',
            'red' => 'Team Rosso',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Punteggio più alto',
            'accuracy' => 'Precisione più alta',
            'combo' => 'Combo più alta',
            'scorev2' => 'Punteggio V2',
        ],
    ],
];
