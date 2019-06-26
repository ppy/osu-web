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
    'all_read' => 'Semua notifikasi telah dibaca!',
    'mark_all_read' => 'Hapus semua',
    'message_multi' => ':count_delimited update baru pada ":title".',

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'Laman diskusi beatmap',
                'beatmapset_discussion_lock' => 'Diskusi untuk beatmap ":title" telah ditutup.',
                'beatmapset_discussion_post_new' => ':username menulis pesan baru pada laman diskusi beatmap ":title".',
                'beatmapset_discussion_unlock' => 'Diskusi untuk beatmap ":title" telah dibuka kembali.',
            ],

            'beatmapset_state' => [
                '_' => 'Status beatmap diganti',
                'beatmapset_disqualify' => 'Beatmap ":title" telah didiskualifikasi oleh :username.',
                'beatmapset_love' => 'Beatmap ":title" telah diberikan status loved oleh :username.',
                'beatmapset_nominate' => 'Beatmap ":title" telah dinominasikan oleh :username.',
                'beatmapset_qualify' => 'Beatmap ":title" telah memperoleh jumlah nominasi yang diperlukan untuk proses ranking.',
                'beatmapset_reset_nominations' => 'Masalah yang dikemukakan oleh :username menganulir nominasi sebelumnya pada beatmap ":title" ',
            ],
        ],

        'forum_topic' => [
            '_' => 'Topik forum',

            'forum_topic_reply' => [
                '_' => 'Balasan baru pada thread forum',
                'forum_topic_reply' => ':username memberikan balasan pada thread forum ":title".',
            ],
        ],

        'legacy_pm' => [
            '_' => 'PM Forum Lawas',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited pesan yang belum dibaca.',
            ],
        ],
    ],
];
