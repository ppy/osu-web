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
    'all_read' => 'Toutes les notifications lues !',
    'mark_all_read' => 'Tout effacer',
    'none' => '',
    'see_all' => '',

    'filters' => [
        '_' => '',
        'user' => '',
        'beatmapset' => '',
        'forum_topic' => '',
        'news_post' => '',
        'build' => '',
        'channel' => '',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'Discussion de la beatmap',
                'beatmapset_discussion_lock' => 'Beatmap ":title" a été verrouillée pour la discussion.',
                'beatmapset_discussion_lock_compact' => 'La discussion a été verrouillée',
                'beatmapset_discussion_post_new' => ':username a publié un nouveau message dans la discussion de beatmap ":title".',
                'beatmapset_discussion_post_new_empty' => 'Nouveau message sur ":title" par :username',
                'beatmapset_discussion_post_new_compact' => 'Nouveau message par :username',
                'beatmapset_discussion_post_new_compact_empty' => 'Nouveau message par :username',
                'beatmapset_discussion_unlock' => 'Beatmap ":title" a été déverrouillée pour la discussion.',
                'beatmapset_discussion_unlock_compact' => 'La discussion a été débloquée',
            ],

            'beatmapset_problem' => [
                '_' => 'Problème de beatmap qualifiée',
                'beatmapset_discussion_qualified_problem' => 'Signalé par :username sur ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Signalé par :username sur ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Signalé par :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Signalé par :username',
            ],

            'beatmapset_state' => [
                '_' => 'Statut de la Beatmap modifié',
                'beatmapset_disqualify' => 'Beatmap ":title" a été disqualifiée par :username.',
                'beatmapset_disqualify_compact' => 'La Beatmap a été disqualifiée',
                'beatmapset_love' => 'Beatmap ":title" a été promu comme aimée par :username.',
                'beatmapset_love_compact' => 'La beatmap a été promue comme aimée',
                'beatmapset_nominate' => 'Beatmap ":title" a été nominée par :username.',
                'beatmapset_nominate_compact' => 'La Beatmap a été nominée',
                'beatmapset_qualify' => 'Beatmap ":title" a reçu assez de nominations et est donc en attente de classement.',
                'beatmapset_qualify_compact' => 'La Beatmap est entrée dans la file d’attente de classement',
                'beatmapset_rank' => '":title" a été classé',
                'beatmapset_rank_compact' => 'La Beatmap a été classée',
                'beatmapset_reset_nominations' => 'Problème posté par :username reset nomination de beatmap ":title" ',
                'beatmapset_reset_nominations_compact' => 'La nomination a été réinitialisée',
            ],

            'comment' => [
                '_' => 'Nouveau commentaire',

                'comment_new' => ':username a commenté ":content" sur ":title"',
                'comment_new_compact' => ':username a commenté ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Chat',

            'channel' => [
                '_' => 'Nouveau message',
                'pm' => [
                    'channel_message' => ':username dit ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'de :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Notes de MàJ',

            'comment' => [
                '_' => 'Nouveau commentaire',

                'comment_new' => ':username a commenté ":content" sur ":title"',
                'comment_new_compact' => ':username a commenté ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Nouvelles',

            'comment' => [
                '_' => 'Nouveau commentaire',

                'comment_new' => ':username a commenté ":content" sur ":title"',
                'comment_new_compact' => ':username a commenté ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Sujet du forum',

            'forum_topic_reply' => [
                '_' => 'Nouvelle réponse du forum',
                'forum_topic_reply' => ':username a répondu au sujet du forum ":title".',
                'forum_topic_reply_compact' => ':username a répondu',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Ancienne page forum des messages privés',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited message non lu.|:count_delimited messages non lus.',
            ],
        ],

        'user_achievement' => [
            '_' => 'Médailles',

            'user_achievement_unlock' => [
                '_' => 'Nouvelle médaille',
                'user_achievement_unlock' => 'Débloqué ":title" !',
                'user_achievement_unlock_compact' => '',
            ],
        ],
    ],
];
