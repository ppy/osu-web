<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
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
        'beatmapset_discussion_qualified_problem' => 'belirtilen modlardaki nitelikli maplerin yeni sorunlarında bildirim al ',
        'beatmapset_disqualify' => 'belirtilen modlardaki beatmapler diskalifiye olduğunda bildirim al',
        'comment_reply' => 'yorumlarınıza yapılan yanıtlar için bildirim al',
        'title' => 'Bildirimler',
        'topic_auto_subscribe' => 'oluşturduğunuz yeni forum başlıklarında bildirimleri otomatik olarak etkinleştir',

        'options' => [
            '_' => 'bildirim seçenekleri',
            'beatmapset:modding' => 'beatmap modlama',
            'channel_message' => 'özel sohbet mesajları',
            'comment_new' => 'yeni yorumlar',
            'forum_topic_reply' => 'konu yanıtı',
            'mail' => 'posta',
            'push' => 'anlık',
            'user_achievement_unlock' => 'kullanıcı madalyası açıldı',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'izin verilen istemciler',
        'own_clients' => 'size ait istemciler',
        'title' => 'OAuth',
    ],

    'options' => [
        'title' => 'Ayarlar',

        'beatmapset_download' => [
            '_' => 'varsayılan beatmap indirme tipi',
            'all' => 'eğer varsa video ile beraber',
            'no_video' => 'video olmadan',
            'direct' => 'osu!direct\'de aç',
        ],

        'beatmapset_title_show_original' => 'beatmap metaverisini orijinal dilinde göster',
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
        'end_session' => 'Oturumu Sonlandır',
        'end_session_confirmation' => 'Bu oturumunuzu o cihazda hemen sonlandırır. Emin misiniz?',
        'last_active' => 'Son etkinlik:',
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
        'text' => 'Şimdi bu sekmeyi/pencereyi kapatabilirsiniz',
        'title' => 'Doğrulama tamamlandı',
    ],

    'verification_invalid' => [
        'title' => 'Geçersiz veya süresi dolmuş doğrulama bağlantısı',
    ],
];
