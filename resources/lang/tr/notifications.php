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
    'all_read' => 'Tüm bildirimler okundu!',
    'mark_all_read' => 'Hepsini temizle',
    'message_multi' => '":title" üzerinde:count_delimited yeni güncelleme.|":title üzerinde:count_delimited yeni güncelleme.',

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'Beatmap tartışması',
                'beatmapset_discussion_lock' => 'Beatmap ":title" tartışmak için kilitlendi.',
                'beatmapset_discussion_post_new' => ':username ":title" beatmapinin tartışmasında yeni mesaj attı.',
                'beatmapset_discussion_unlock' => '":title" beatmapinin kilidi tartışmak için açıldı.',
            ],

            'beatmapset_state' => [
                '_' => 'Beatmap durumu değişti',
                'beatmapset_disqualify' => '',
                'beatmapset_love' => '',
                'beatmapset_nominate' => '',
                'beatmapset_qualify' => '',
                'beatmapset_reset_nominations' => '',
            ],
        ],

        'forum_topic' => [
            '_' => 'Forum konusu',

            'forum_topic_reply' => [
                '_' => 'Yeni forum yanıtı',
                'forum_topic_reply' => ':username ":title" konusuna yanıt verdi.',
            ],
        ],

        'legacy_pm' => [
            '_' => '',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited okunmamış mesaj.|:count_delimited okunmamış mesajlar.',
            ],
        ],
    ],
];
