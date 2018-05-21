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
        'header' => 'Çok Oyunculu Maçlar',
        'team-types' => [
            'head-to-head' => 'Başa-baş',
            'tag-coop' => 'Sıralı Co-op',
            'team-vs' => 'Takım VS',
            'tag-team-vs' => 'Tag takım VS',
        ],
        'events' => [
            'player-left' => ':user maçtan ayrıldı',
            'player-joined' => ':user maça katıldı',
            'player-kicked' => ':user maçtan atıldı',
            'match-created' => ':user maçı oluşturdu',
            'match-disbanded' => 'maç dağıtıldı',
            'host-changed' => ':user oda sahibi oldu',

            'player-left-no-user' => 'bir oyuncu maçı terk etti',
            'player-joined-no-user' => 'bir oyuncu maça katıldı',
            'player-kicked-no-user' => 'bir oyuncu maçtan atıldı',
            'match-created-no-user' => 'maç oluşturuldu',
            'match-disbanded-no-user' => 'maç dağıtıldı',
            'host-changed-no-user' => 'oda sahibi değiştirildi',
        ],
        'in-progress' => '(maç devam ediyor)',
        'score' => [
            'stats' => [
                'accuracy' => 'Doğruluk',
                'combo' => 'Kombo',
                'score' => 'Skor',
            ],
        ],
        'failed' => 'BAŞARISIZ',
        'teams' => [
            'blue' => 'Mavi Takım',
            'red' => 'Kırmızı Takım',
        ],
        'winner' => ':team kazandı',
        'difference' => ':difference farkla',
        'loading-events' => 'Olaylar yükleniyor...',
        'more-events' => 'hepsini gör...',
        'beatmap-deleted' => 'silinmiş beatmap',
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'En Yüksek Skor',
            'accuracy' => 'Yüksek doğruluk',
            'combo' => 'En yüksek Kombo',
            'scorev2' => 'Skor V2',
        ],
    ],
];
