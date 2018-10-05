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
        'beatmap-deleted' => 'silinmiş beatmap',
        'difference' => ':difference puan farkla kazandı',
        'failed' => 'BAŞARISIZ',
        'header' => 'Çok Oyunculu Maçlar',
        'in-progress' => '(devam eden maç)',
        'in_progress_spinner_label' => 'devam eden maç',
        'loading-events' => 'Olaylar yükleniyor...',
        'winner' => ':team',

        'events' => [
            'player-left' => ':user maçtan ayrıldı',
            'player-joined' => ':user maça katıldı',
            'player-kicked' => ':user maçtan atıldı',
            'match-created' => ':user maçı oluşturdu',
            'match-disbanded' => 'maç dağıtıldı',
            'host-changed' => ':user odanın sahibi oldu',

            'player-left-no-user' => 'bir oyuncu maçı terk etti',
            'player-joined-no-user' => 'bir oyuncu maça katıldı',
            'player-kicked-no-user' => 'bir oyuncu maçtan atıldı',
            'match-created-no-user' => 'maç oluşturuldu',
            'match-disbanded-no-user' => 'maç dağıtıldı',
            'host-changed-no-user' => 'odanın sahibi değiştirildi',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Doğruluk',
                'combo' => 'Kombo',
                'score' => 'Skor',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Başa-baş',
            'tag-coop' => 'Sıralı Co-op',
            'team-vs' => 'Takım VS',
            'tag-team-vs' => 'Tag takım VS',
        ],

        'teams' => [
            'blue' => 'Mavi Takım',
            'red' => 'Kırmızı Takım',
        ],
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
