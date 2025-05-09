<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Kullanıcı takıma eklendi.',
        ],
        'destroy' => [
            'ok' => 'Giriş isteği iptal edildi.',
        ],
        'reject' => [
            'ok' => 'Giriş isteği reddedildi.',
        ],
        'store' => [
            'ok' => 'Takıma girmek için istek gönderildi.',
        ],
    ],

    'create' => [
        'submit' => 'Takım Oluştur',

        'form' => [
            'name_help' => 'Takım adınız. Ad şimdilik kalıcıdır.',
            'short_name_help' => 'En fazla 4 karakter.',
            'title' => "Hadi yeni bir takım kuralım",
        ],

        'intro' => [
            'description' => "",
            'title' => 'Takım!',
        ],
    ],

    'destroy' => [
        'ok' => 'Takım silindi.',
    ],

    'edit' => [
        'ok' => 'Ayarlar başarıyla kaydedildi.',
        'title' => 'Takım Ayarları',

        'description' => [
            'label' => 'Açıklama',
            'title' => 'Takım Açıklaması',
        ],

        'flag' => [
            'label' => 'Takım Bayrağı',
            'title' => 'Takım Bayrağı Ayarla',
        ],

        'header' => [
            'label' => 'Başlık Resmi',
            'title' => 'Başlık Resmi Ayarla',
        ],

        'settings' => [
            'application_help' => '',
            'default_ruleset_help' => '',
            'flag_help' => 'Maksimum boyut :width×:height',
            'header_help' => 'Maksimum boyut :width×:height',
            'title' => 'Takım Ayarları',

            'application_state' => [
                'state_0' => 'Kapalı',
                'state_1' => 'Açık',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'ayarlar',
        'leaderboard' => 'sıralama',
        'show' => 'bilgi',

        'members' => [
            'index' => 'üyeleri yönet',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Küresel Sıralama',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Takım üyesi kaldırıldı',
        ],

        'index' => [
            'title' => 'Üyeleri Yönet',

            'applications' => [
                'accept_confirm' => '',
                'created_at' => '',
                'empty' => 'Şu anda katılma isteği yok.',
                'empty_slots' => 'Kullanılabilir alan',
                'empty_slots_overflow' => '',
                'reject_confirm' => '',
                'title' => 'Katılma İstekleri',
            ],

            'table' => [
                'joined_at' => 'Katılma Tarihi',
                'remove' => 'Kaldır',
                'remove_confirm' => '',
                'set_leader' => '',
                'set_leader_confirm' => '',
                'status' => 'Durum',
                'title' => 'Şu anki üyeler',
            ],

            'status' => [
                'status_0' => 'Pasif',
                'status_1' => 'Aktif',
            ],
        ],

        'set_leader' => [
            'success' => '',
        ],
    ],

    'part' => [
        'ok' => ';_; takımdan ayrıldı',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Takım Sohbeti',
            'destroy' => 'Takımı dağıt',
            'join' => 'Katılmak İste',
            'join_cancel' => 'Katılmayı İptal Et',
            'part' => 'Takımdan Ayrıl',
        ],

        'info' => [
            'created' => 'Oluşturuldu',
        ],

        'members' => [
            'members' => 'Takım Üyeleri',
            'owner' => 'Takım Lideri',
        ],

        'sections' => [
            'about' => 'Hakkımızda!',
            'info' => 'Bilgi',
            'members' => 'Üyeler',
        ],

        'statistics' => [
            'rank' => 'Sıralama',
            'leader' => 'Takım Lideri',
        ],
    ],

    'store' => [
        'ok' => 'Takım oluşturuldu.',
    ],
];
