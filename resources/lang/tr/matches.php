<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
                'accuracy' => 'İsabetlilik',
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
            'accuracy' => 'En Yüksek İsabetlilik',
            'combo' => 'En yüksek Kombo',
            'scorev2' => 'Skor V2',
        ],
    ],
];
