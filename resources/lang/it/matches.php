<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'match' => [
        'beatmap-deleted' => 'beatmap cancellata',
        'failed' => 'FALLITO',
        'header' => 'Partite Multigiocatore',
        'in-progress' => '(partita in corso)',
        'in_progress_spinner_label' => 'partita in corso',
        'loading-events' => 'Caricamento eventi...',
        'winner' => ':team vince',
        'winner_by' => ':winner di :difference',

        'events' => [
            'game_aborted' => 'la partita è stata annullata',
            'game_aborted_no_user' => 'la partita è stata annullata',
            'game_completed' => 'la partita è terminata',
            'game_completed_no_user' => 'la partita è terminata',
            'host_changed' => ':user è diventato l\'host',
            'host_changed_no_user' => 'l\'host è stato cambiato',
            'player_joined' => ':user si è unito al match',
            'player_joined_no_user' => 'un giocatore si è unito al match',
            'player_kicked' => ':user è stato cacciato dal match',
            'player_kicked_no_user' => 'un giocatore è stato cacciato dal match',
            'player_left' => ':user ha lasciato il match',
            'player_left_no_user' => 'un giocatore ha lasciato il match',
            'room_created' => ':user ha creato il match',
            'room_created_no_user' => 'il match è stato creato',
            'room_disbanded' => 'il match è terminato',
            'room_disbanded_no_user' => 'il match è terminato',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Precisione',
                'combo' => 'Combo',
                'score' => 'Punteggio',
            ],
        ],

        'team_types' => [
            'head_to_head' => 'Testa a Testa',
            'tag_coop' => 'Tag Co-op',
            'tag_team_versus' => 'Tag a squadre',
            'team_versus' => 'A Squadre',
        ],

        'teams' => [
            'blue' => 'Squadra Blu',
            'red' => 'Squadra Rossa',
        ],
    ],
    'game' => [
        'freestyle' => 'Freestyle',

        'scoring-type' => [
            'score' => 'Punteggio più alto',
            'accuracy' => 'Precisione più alta',
            'combo' => 'Combo più alta',
            'scorev2' => 'Punteggio V2',
        ],
    ],
];
