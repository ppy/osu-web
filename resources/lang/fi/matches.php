<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'match' => [
        'beatmap-deleted' => 'poistettu rytmikartta',
        'failed' => 'HÄVISI',
        'header' => 'Moninpelit',
        'in-progress' => '(peli meneillään)',
        'in_progress_spinner_label' => 'peli meneillään',
        'loading-events' => 'Ladataan tapahtumia...',
        'winner' => ':team voitti',
        'winner_by' => ':winner :difference pisteellä',

        'events' => [
            'game_aborted' => 'peli peruutettiin',
            'game_aborted_no_user' => 'peli peruutettiin',
            'game_completed' => 'peli on päättynyt',
            'game_completed_no_user' => 'peli on päättynyt',
            'host_changed' => ':user on nyt isäntä',
            'host_changed_no_user' => 'isäntä vaihdettiin',
            'player_joined' => ':user liittyi peliin',
            'player_joined_no_user' => 'pelaaja liittyi peliin',
            'player_kicked' => ':user potkittiin pelistä',
            'player_kicked_no_user' => 'pelaaja potkittiin pelistä',
            'player_left' => ':user poistui pelistä',
            'player_left_no_user' => 'pelaaja poistui pelistä',
            'room_created' => ':user loi pelin',
            'room_created_no_user' => 'peli luotiin',
            'room_disbanded' => 'peli hajoitettiin',
            'room_disbanded_no_user' => 'peli hajoitettiin',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Tarkkuus',
                'combo' => 'Iskuputki',
                'score' => 'Pisteet',
            ],
        ],

        'team_types' => [
            'head_to_head' => 'Kaikki vastakkain',
            'tag_coop' => 'Yhteistyöpeli',
            'tag_team_versus' => 'Tiimi yhteistyöpeli VS',
            'team_versus' => 'Tiimi VS',
        ],

        'teams' => [
            'blue' => 'Sininen joukkue',
            'red' => 'Punainen joukkue',
        ],
    ],
    'game' => [
        'freestyle' => 'Freestyle',

        'scoring-type' => [
            'score' => 'Korkeimmat Pisteet',
            'accuracy' => 'Korkein tarkkuus',
            'combo' => 'Korkein iskuputki',
            'scorev2' => 'Pisteytys V2',
        ],
    ],
];
