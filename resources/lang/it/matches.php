<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'A Squadre',
            'tag-team-vs' => 'Tag a Squadre',
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
