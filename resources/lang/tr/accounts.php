<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'ayarlar',
        'username' => 'kullanıcı adı',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Lütfen avatarınızın :link\'e göre uygun olduğundan emin olunuz.<br/>Bu, onun <strong>her yaştan kişiye uygun olmasını</strong> yani çıplaklık, küfür veya müsthecen içeriğe yer vermemelidir.',
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
        'beatmapset_discussion_qualified_problem' => 'Doğrulanmış beatmapler\'in belirtilen modlardaki yeni sorunlarının bildirimlerini al',

        'mail' => [
            '_' => 'Bunun için bildirim al',
            'beatmapset:modding' => 'beatmap modding',
            'forum_topic_reply' => 'Konuya cevap ver',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'istek yetkilendirildi',
        'own_clients' => 'size ait istemciler',
        'title' => 'OAuth',
    ],

    'options' => [
        'title' => 'Ayarlar',

        'beatmapset_download' => [
            '_' => 'varsayılan beatmap indirme tipi',
            'all' => 'eğer varsa video ile beraber',
            'no_video' => 'video olmadan',
            'direct' => 'osu!direkt\'de aç',
        ],
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
        'update' => 'güncelle',
    ],

    'update_password' => [
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
