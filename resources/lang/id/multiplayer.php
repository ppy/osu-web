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
        'beatmap-deleted' => 'beatmap dihapus',
        'difference' => 'dengan :difference',
        'failed' => 'GAGAL',
        'header' => 'Pertandingan Multiplayer',
        'in-progress' => '(pertandingan sedang berlangsung)',
        'in_progress_spinner_label' => 'pertandingan sedang berlangsung',
        'loading-events' => 'Memuat peristiwa...',
        'winner' => ':team menang',

        'events' => [
            'player-left' => ':user meninggalkan pertandingan',
            'player-joined' => ':user bergabung dalam pertandingan',
            'player-kicked' => ':user telah dikeluarkan dari pertandingan',
            'match-created' => ':user membuat pertandingan',
            'match-disbanded' => 'pertandingan dibubarkan',
            'host-changed' => ':user menjadi host',

            'player-left-no-user' => 'seorang pengguna meninggalkan pertandingan',
            'player-joined-no-user' => 'seorang pengguna bergabung dalam pertandingan',
            'player-kicked-no-user' => 'seorang pengguna telah dikeluarkan dari pertandingan',
            'match-created-no-user' => 'pertandingan telah dibuat',
            'match-disbanded-no-user' => 'pertandingan telah dibubarkan',
            'host-changed-no-user' => 'host diubah',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Akurasi',
                'combo' => 'Kombo',
                'score' => 'Skor',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],

        'teams' => [
            'blue' => 'Tim Biru',
            'red' => 'Tim Merah',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Skor Tertinggi',
            'accuracy' => 'Akurasi Tertinggi',
            'combo' => 'Kombo Tertinggi',
            'scorev2' => 'Score V2',
        ],
    ],
];
