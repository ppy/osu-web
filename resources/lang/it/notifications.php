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
    'all_read' => 'Tutte le notifiche sono state lette!',
    'mark_all_read' => 'Cancella tutto',

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'Discussione beatmap',
                'beatmapset_discussion_lock' => 'La discussione su ":title" è stata bloccata',
                'beatmapset_discussion_lock_compact' => 'La discussione è stata bloccata',
                'beatmapset_discussion_post_new' => 'Nuovo post su ":title" da :username',
                'beatmapset_discussion_post_new_compact' => 'Nuovo post da :username',
                'beatmapset_discussion_unlock' => 'La discussione su ":title" è stata sbloccata',
                'beatmapset_discussion_unlock_compact' => 'La discussione è stata sbloccata',
            ],

            'beatmapset_state' => [
                '_' => 'Lo stato della beatmap è stato modificato',
                'beatmapset_disqualify' => '":title" è stato rimosso',
                'beatmapset_disqualify_compact' => 'La beatmap è stata rimossa',
                'beatmapset_love' => '":title" è stato promosso ad amato',
                'beatmapset_love_compact' => 'La beatmap è stato promossa ad amato',
                'beatmapset_nominate' => '":title" è stato nominato',
                'beatmapset_nominate_compact' => 'La beatmap è stata nominata',
                'beatmapset_qualify' => '":title" ha ottenuto abbastanza nomine ed è stato inserito nella coda di classificazione',
                'beatmapset_qualify_compact' => 'La beatmap è stata inserita nella coda di classificazione',
                'beatmapset_rank' => '":title" è stato classificato',
                'beatmapset_rank_compact' => 'La beatmap è stata classificata',
                'beatmapset_reset_nominations' => 'La nomina di ":title" è stata reimpostata',
                'beatmapset_reset_nominations_compact' => 'Nomina reimpostata',
            ],

            'comment' => [
                '_' => 'Nuovo commento',

                'comment_new' => ':username ha commentato ":content" su ":title"',
                'comment_new_compact' => ':username ha commentato ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Chat',

            'channel' => [
                '_' => 'Nuovo messaggio',
                'pm' => [
                    'channel_message' => ':username dice ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'da :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Note di rilascio',

            'comment' => [
                '_' => 'Nuovo commento',

                'comment_new' => ':username ha commentato ":content" su ":title"',
                'comment_new_compact' => ':username ha commentato ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Notizie',

            'comment' => [
                '_' => 'Nuovo commento',

                'comment_new' => ':username ha commentato ":content" su ":title"',
                'comment_new_compact' => ':username ha commentato ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Argomento del forum',

            'forum_topic_reply' => [
                '_' => 'Nuova risposta sul forum',
                'forum_topic_reply' => ':username ha risposto a ":title"',
                'forum_topic_reply_compact' => ':username ha risposto',
            ],
        ],

        'legacy_pm' => [
            '_' => 'PM forum legacy',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited messaggio non letto|:count_delimited messaggi non letti',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medaglie',

            'user_achievement_unlock' => [
                '_' => 'Nuova medaglia',
                'user_achievement_unlock' => 'Sbloccato ":title"!',
            ],
        ],
    ],
];
