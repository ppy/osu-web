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
    'all_read' => 'Alle meldingen gelezen!',
    'mark_all_read' => 'Alles wissen',
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
                '_' => 'Beatmap discussies',
                'beatmapset_discussion_lock' => 'Beatmap ":title" is vergrendeld voor discussie.',
                'beatmapset_discussion_lock_compact' => 'Discussie is vergrendeld',
                'beatmapset_discussion_post_new' => ':username plaatste een nieuw bericht in ":title" beatmap discussie.',
                'beatmapset_discussion_post_new_empty' => 'Nieuw bericht op ":title" door :username',
                'beatmapset_discussion_post_new_compact' => 'Nieuw bericht door :username',
                'beatmapset_discussion_post_new_compact_empty' => 'Nieuw bericht door :username',
                'beatmapset_discussion_unlock' => 'Beatmap ":title" is ontgrendeld voor discussie.',
                'beatmapset_discussion_unlock_compact' => 'Discussie is ontgrendeld',
            ],

            'beatmapset_problem' => [
                '_' => 'Gekwalificeerde Beatmap probleem',
                'beatmapset_discussion_qualified_problem' => 'Gerapporteerd door :username op ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Gerapporteerd door :username op ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Gerapporteerd door :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Gerapporteerd door :username',
            ],

            'beatmapset_state' => [
                '_' => 'Beatmap status gewijzigd',
                'beatmapset_disqualify' => 'Beatmap ":title" is gediskwalificeerd door :username.',
                'beatmapset_disqualify_compact' => 'Beatmap was gediskwalificeerd',
                'beatmapset_love' => 'Beatmap ":title" is gepromoveerd tot loved door :username.',
                'beatmapset_love_compact' => 'Beatmap werd gepromoveerd voor loved',
                'beatmapset_nominate' => 'Beatmap ":title" is genomineerd door :username.',
                'beatmapset_nominate_compact' => 'Beatmap is genomineerd',
                'beatmapset_qualify' => 'Beatmap ":title" heeft genoeg nominaties en is dus in de rij gezet voor de ranked sectie.',
                'beatmapset_qualify_compact' => 'Beatmap staat in de ranked wachtlijst',
                'beatmapset_rank' => '":title" is geranked',
                'beatmapset_rank_compact' => 'Beatmap was geranked',
                'beatmapset_reset_nominations' => 'Probleem geplaatst door :username reset nominatie van beatmap ":title" ',
                'beatmapset_reset_nominations_compact' => 'Nominatie is gereset',
            ],

            'comment' => [
                '_' => 'Nieuwe opmerking',

                'comment_new' => ':username gaf commentaar op ":content" op ":title"',
                'comment_new_compact' => ':username gaf commentaar op ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Chat',

            'channel' => [
                '_' => 'Nieuw bericht',
                'pm' => [
                    'channel_message' => ':username zegt ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'van :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Changelog',

            'comment' => [
                '_' => 'Nieuwe reactie',

                'comment_new' => ':username gaf commentaar ":content" op ":title"',
                'comment_new_compact' => ':username gaf commentaar op ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Nieuws',

            'comment' => [
                '_' => 'Nieuwe reactie',

                'comment_new' => ':username gaf commentaar ":content" op ":title"',
                'comment_new_compact' => ':username gaf commentaar op ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Forum onderwerp',

            'forum_topic_reply' => [
                '_' => 'Nieuw forum antwoord',
                'forum_topic_reply' => ':username antwoordde op forumonderwerp ":title".',
                'forum_topic_reply_compact' => ':username antwoordde',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Ouder Forum PM',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited ongelezen bericht.|:count_delimited berichten.',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medailles',

            'user_achievement_unlock' => [
                '_' => 'Nieuwe medaille',
                'user_achievement_unlock' => '":title" ontgrendeld!',
                'user_achievement_unlock_compact' => '',
            ],
        ],
    ],
];
