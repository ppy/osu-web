<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Düzenlemek için giriş yapılmış olmalı.',
            'system_generated' => 'Sistem tarafından oluşturulmuş gönderiler düzenlenemez.',
            'wrong_user' => 'Düzenlemek için gönderinin sahibi olmalısınız.',
        ],
    ],

    'events' => [
        'empty' => 'Hiçbir şey olmadı... henüz.',
    ],

    'index' => [
        'deleted_beatmap' => 'silindi',
        'title' => 'Beatmap Tartışmaları',

        'form' => [
            '_' => 'Ara',
            'deleted' => 'Silinmiş tartışmaları içer',
            'only_unresolved' => '',
            'types' => 'Mesaj türü',
            'username' => 'Kullanıcı adı',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

            'user' => [
                'label' => 'Kullanıcı',
                'overview' => 'Etkinliğe genel bakış',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Gönderim tarihi',
        'deleted_at' => 'Silinme tarihi',
        'message_type' => 'Tür',
        'permalink' => 'Kalıcı bağlantı',
    ],

    'nearby_posts' => [
        'confirm' => 'Bu gönderilerin hiçbiri sorunumla ilgili değil',
        'notice' => ':timestamp (:existing_timestamp) civarında gönderilmiş mesajlar var. Göndermeden önce lütfen onlara bir göz atın.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Yanıtlamak için Giriş yapın',
            'user' => 'Yanıtla',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => ':user tarafından çözüldü olarak işaretlendi',
            'false' => ':user tarafından yeniden açıldı',
        ],
    ],

    'user_filter' => [
        'everyone' => 'Herkes',
        'label' => 'Kullanıcıya göre filtrele',
    ],
];
