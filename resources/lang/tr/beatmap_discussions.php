<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
            'types' => 'Mesaj türü',
            'username' => 'Kullanıcı adı',

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

    'user' => [
        'admin' => 'yönetici',
        'bng' => 'nominatör',
        'owner' => 'mapper',
        'nat' => '',
    ],

    'user_filter' => [
        'everyone' => 'Herkes',
        'label' => 'Kullanıcıya göre filtrele',
    ],
];
