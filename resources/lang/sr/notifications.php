<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Све нотификације су прочитане!',
    'delete' => 'Избриши :type',
    'loading' => 'Учитавање непрочитаних обавештења...',
    'mark_read' => 'Очисти :type',
    'none' => 'Нема обавештења',
    'see_all' => 'погледајте сва обавештења',
    'see_channel' => 'уђите у чет',
    'verifying' => 'Молимо вас да верификујете сесију да би сте видели нотификације',

    'action_type' => [
        '_' => 'све',
        'beatmapset' => 'мапе',
        'build' => 'верзије',
        'channel' => 'ћаскање',
        'forum_topic' => 'форум',
        'news_post' => 'новости',
        'user' => 'профил',
    ],

    'filters' => [
        '_' => 'све',
        'user' => 'профил',
        'beatmapset' => 'мапе',
        'forum_topic' => 'форум',
        'news_post' => 'новости',
        'build' => 'верзије',
        'channel' => 'чет',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Мапа',

            'beatmap_owner_change' => [
                '_' => 'Гостова тежина',
                'beatmap_owner_change' => 'Постали сте власник тежине ":beatmap" за мапу ":title"',
                'beatmap_owner_change_compact' => 'Постали сте власник тежине ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Дискусија за мапу',
                'beatmapset_discussion_lock' => 'Дискусија за ":title" је закључана',
                'beatmapset_discussion_lock_compact' => 'Дискусија је закључана',
                'beatmapset_discussion_post_new' => 'Нова објава на ":title" од стране корисника :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'Нова објава на ":title" од стране корисника :username',
                'beatmapset_discussion_post_new_compact' => 'Нова објава од стране корисника :username: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Нова објава од стране корисника :username',
                'beatmapset_discussion_review_new' => 'Нова рецензија у ":title" од корисника :username садржи проблеме: :problems, сугестије: :suggestions, похвале: :praises',
                'beatmapset_discussion_review_new_compact' => 'Нова рецензија од корисника :username садржи проблеме: :problems, сугестије: :suggestions, похвале: :praises',
                'beatmapset_discussion_unlock' => 'Дискусија за ":title" је откључана',
                'beatmapset_discussion_unlock_compact' => 'Дискусија је откључана',
            ],

            'beatmapset_problem' => [
                '_' => 'Проблем са квалификованом мапом',
                'beatmapset_discussion_qualified_problem' => 'Пријављено од стране корисника :username у ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Пријављено од стране корисника :username у ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Пријављено од стране корисника :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Пријављено од стране корисника :username',
            ],

            'beatmapset_state' => [
                '_' => 'Статус мапе је промењен',
                'beatmapset_disqualify' => '":title" је дисквалификован',
                'beatmapset_disqualify_compact' => 'Мапа је дисквалификована',
                'beatmapset_love' => '":title" је унапређен у loved',
                'beatmapset_love_compact' => 'Мапа је унапређена у loved',
                'beatmapset_nominate' => '":title" је номиниран',
                'beatmapset_nominate_compact' => 'Мапа је номинирана',
                'beatmapset_qualify' => '":title" је добила довољно номинација и ушла је у ред за рангирање',
                'beatmapset_qualify_compact' => 'Мапа је ушла у ред за рангирање',
                'beatmapset_rank' => '":title" је рангирана',
                'beatmapset_rank_compact' => 'Мапа је рангирана',
                'beatmapset_remove_from_loved' => '":title" је уклоњена из Loved',
                'beatmapset_remove_from_loved_compact' => 'Мапа је уклоњена из Loved',
                'beatmapset_reset_nominations' => 'Номинација за ":title" је ресетована',
                'beatmapset_reset_nominations_compact' => 'Номинација је ресетована',
            ],

            'comment' => [
                '_' => 'Нови коментар',

                'comment_new' => ':username је коментарисао/ла ":content" у ":title"',
                'comment_new_compact' => ':username је коментарисао/ла ":content"',
                'comment_reply' => ':username је одговорио/ла ":content" у ":title"',
                'comment_reply_compact' => ':username је одговорио/ла ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Чет',

            'announcement' => [
                '_' => 'Ново обавештење',

                'announce' => [
                    'channel_announcement' => ':username каже ":title"',
                    'channel_announcement_compact' => ':title',
                    'channel_announcement_group' => 'Обавештење од корисника :username',
                ],
            ],

            'channel' => [
                '_' => 'Нова порука',

                'pm' => [
                    'channel_message' => ':username каже ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'од корисника :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Списак измена',

            'comment' => [
                '_' => 'Нови коментар',

                'comment_new' => ':username је коментарисао/ла ":content" на ":title"',
                'comment_new_compact' => ':username је коментарисао/ла ":content"',
                'comment_reply' => ':username је одговорио/ла ":content" на ":title"',
                'comment_reply_compact' => ':username је одговорио/ла ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Новости',

            'comment' => [
                '_' => 'Нови коментар',

                'comment_new' => ':username је коментарисао/ла ":content" на ":title"',
                'comment_new_compact' => ':username је коментарисао/ла ":content"',
                'comment_reply' => ':username је одговорио/ла ":content" на ":title"',
                'comment_reply_compact' => ':username је одговорио/ла ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Тема форума',

            'forum_topic_reply' => [
                '_' => 'Нови одговор на форуму',
                'forum_topic_reply' => ':username је одговорио/ла ":title"',
                'forum_topic_reply_compact' => ':username је одговорио/ла',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Директна порука на старом форуму',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited непрочитана порука|:count_delimited непрочитане поруке',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Нова мапа',

                'user_beatmapset_new' => 'Нова мапа ":title" од корисника :username',
                'user_beatmapset_new_compact' => 'Нова мапа ":title"',
                'user_beatmapset_new_group' => 'Нове мапе од стране корисника :username',

                'user_beatmapset_revive' => 'Мапа ":title" је оживљена од стране корисника :username',
                'user_beatmapset_revive_compact' => 'Мапа ":title" оживљена',
            ],
        ],

        'user_achievement' => [
            '_' => 'Медаље',

            'user_achievement_unlock' => [
                '_' => 'Нова медаља',
                'user_achievement_unlock' => 'Откључао/ла ":title"!',
                'user_achievement_unlock_compact' => 'Откључао/ла ":title"!',
                'user_achievement_unlock_group' => 'Медаље откључане!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Постали сте гост мапе ":title"',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'Дискусија на ":title" је закључана',
                'beatmapset_discussion_post_new' => 'Дискусија на ":title" има нових ажурирана',
                'beatmapset_discussion_unlock' => 'Дискусија за ":title" је откључана',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Нови проблем је пријављен на ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" је дисквалификован',
                'beatmapset_love' => '":title" је унапређен у loved',
                'beatmapset_nominate' => '":title" је номиниран',
                'beatmapset_qualify' => '":title" је добила довољно номинација и ушла је у ред за рангирање',
                'beatmapset_rank' => '":title" је рангирана',
                'beatmapset_remove_from_loved' => '":title" је уклоњена из Loved',
                'beatmapset_reset_nominations' => 'Номинација ":title" је ресетована',
            ],

            'comment' => [
                'comment_new' => 'Мапа ":title" има нове коментаре',
            ],
        ],

        'channel' => [
            'announcement' => [
                'announce' => 'Постоји нова најава у ":name"',
            ],

            'channel' => [
                'pm' => 'Примили сте нову поруку од корисника :username',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'Списак измена ":title" има нове коментаре',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Вести ":title" има нове коментаре',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Има нових одговора у ":title"',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username је откључао/ла нову медаљу, ":title"!',
                'user_achievement_unlock_self' => 'Откључали сте нову медаљу, ":title"!',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username је направио/ла нове мапе',
                'user_beatmapset_revive' => ':username је оживео мапе',
            ],
        ],
    ],
];
