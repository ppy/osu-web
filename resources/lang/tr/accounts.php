<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'edit' => [
        'title' => '<strong>Hesap</strong> Ayarları',
        'title_compact' => 'ayarlar',
        'username' => 'kullanıcı adı',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Avatarının :link\'na uyduğundan emin ol.<br/>Bu avatarının <strong>her yaş grubuna</strong> uygun olması gerektiği anlamına gelir. Yani çıplaklık, küfür veya müstehcen içerik olmamalıdır.',
            'rules_link' => 'topluluk kuralları',
        ],

        'email' => [
            'current' => 'mevcut e-posta',
            'new' => 'yeni e-posta',
            'new_confirmation' => 'e-posta onayı',
            'title' => 'E-posta',
        ],

        'password' => [
            'current' => 'mevcut şifre',
            'new' => 'yeni şifre',
            'new_confirmation' => 'şifre onayı',
            'title' => 'Şifre',
        ],

        'profile' => [
            'title' => 'Profil',

            'user' => [
                'user_discord' => 'discord',
                'user_from' => 'mevcut konum',
                'user_interests' => 'ilgi alanları',
                'user_msnm' => 'skype',
                'user_occ' => 'meslek',
                'user_twitter' => 'twitter',
                'user_website' => 'web sitesi',
            ],
        ],

        'signature' => [
            'title' => 'İmza',
            'update' => 'güncelle',
        ],
    ],

    'notifications' => [
        'title' => 'Bildirimler',
        'topic_auto_subscribe' => 'bu beatmap için oluşturduğunuz yeni forum konularında bildirimleri otomatik olarak etkinleştirin',
        'beatmapset_discussion_qualified_problem' => '',
    ],

    'oauth' => [
        'authorized_clients' => 'istek yetkilendirildi',
        'own_clients' => '',
        'title' => 'Otomatik bağlantı',
    ],

    'playstyles' => [
        'keyboard' => 'klavye',
        'mouse' => 'fare',
        'tablet' => 'tablet',
        'title' => 'Oynayış Tarzları',
        'touch' => 'dokunmatik',
    ],

    'privacy' => [
        'friends_only' => 'Arkadaş listende olmayan kişilerden gelen mesajları engelle',
        'hide_online' => 'çevrimiçi durumunu gizle',
        'title' => 'Gizlilik',
    ],

    'security' => [
        'current_session' => 'şu anki',
        'end_session' => 'Oturumu sona erdir',
        'end_session_confirmation' => 'Bu oturumunuzu o cihazda hemen sonlandırır. Emin misiniz?',
        'last_active' => 'En son aktivite:',
        'title' => 'Güvenlik',
        'web_sessions' => 'web oturumları',
    ],

    'update_email' => [
        'email_subject' => 'osu! e-posta değişikliği onayı',
        'update' => 'güncelle',
    ],

    'update_password' => [
        'email_subject' => 'osu! şifre değişikliği onayı',
        'update' => 'güncelle',
    ],

    'verification_completed' => [
        'text' => 'Bu pencereyi kapatabilirsiniz',
        'title' => 'Doğrulama tamamlandı',
    ],

    'verification_invalid' => [
        'title' => 'Geçersiz veya süresi dolmuş doğrulama bağlantısı',
    ],
];
