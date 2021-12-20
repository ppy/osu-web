<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'כל ההתראות נקראו!',
    'delete' => 'מחק :type',
    'loading' => 'טוען התראות שלא נקראו...',
    'mark_read' => 'נקה :type',
    'none' => 'אין התראות',
    'see_all' => 'ראה את כל ההתראות',
    'see_channel' => 'לך לצ\'אט',
    'verifying' => '',

    'filters' => [
        '_' => 'הכל',
        'user' => 'פרופיל',
        'beatmapset' => 'מפות',
        'forum_topic' => 'פורום',
        'news_post' => 'חדשות',
        'build' => 'בניות',
        'channel' => 'צ\'אטים',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'מפה',

            'beatmap_owner_change' => [
                '_' => '',
                'beatmap_owner_change' => '',
                'beatmap_owner_change_compact' => '',
            ],

            'beatmapset_discussion' => [
                '_' => 'דיוני מפות',
                'beatmapset_discussion_lock' => 'מפה ":title" ננעלה לדיון.',
                'beatmapset_discussion_lock_compact' => 'הדיון ננעל',
                'beatmapset_discussion_post_new' => ':username פרסם הודעה חדשה בדיון מפה ":title".',
                'beatmapset_discussion_post_new_empty' => 'פוסט חדש ב":title" על ידי :username',
                'beatmapset_discussion_post_new_compact' => 'פוסט חדש על ידי :username ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'פוסט חדש על ידי :username',
                'beatmapset_discussion_review_new' => 'ביקורת חדשה ב":title" על ידי :username מכילה בעיות: :problems, המלצות: :suggestions, שבחים: :praises',
                'beatmapset_discussion_review_new_compact' => 'ביקורת חדשה מאת :username כוללת את הבעיות: :problems, המלצות: :suggestions, שבחים: :praises',
                'beatmapset_discussion_unlock' => 'מפה ":title" נפתחה לדיון.',
                'beatmapset_discussion_unlock_compact' => 'הדיון נפתח',
            ],

            'beatmapset_problem' => [
                '_' => 'הבעיה של המפה המעומדת',
                'beatmapset_discussion_qualified_problem' => 'דווח על ידי :username ב":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'דווח על ידי :username ב":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'דווח על ידי :username ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'דווח על ידי :username',
            ],

            'beatmapset_state' => [
                '_' => 'סטטוס מפה השתנה',
                'beatmapset_disqualify' => 'מפה ":title" נפסלה על ידי :username.',
                'beatmapset_disqualify_compact' => 'המפה נפסלה',
                'beatmapset_love' => 'מפה ":title" קודמה כאהובה על ידי :username.',
                'beatmapset_love_compact' => 'המפה קודמה להיות אהובה',
                'beatmapset_nominate' => 'מפה ":title" מונתה על ידי :username.',
                'beatmapset_nominate_compact' => 'המפה דורגה',
                'beatmapset_qualify' => 'מפה ":title" קיבלה מספיק מינויים ולכן היא בתור לדירוג.',
                'beatmapset_qualify_compact' => 'המפה נכנסה לתור הדירוג',
                'beatmapset_rank' => '":title" דורגה',
                'beatmapset_rank_compact' => 'מפה דורגה',
                'beatmapset_remove_from_loved' => '":title" הוסרה מנאהב',
                'beatmapset_remove_from_loved_compact' => 'מפה הוסרה מנאהב',
                'beatmapset_reset_nominations' => 'בעיה שפורסמה על י די :username איפסה את מינויה של מפה ":title" ',
                'beatmapset_reset_nominations_compact' => 'דירוג אופס',
            ],

            'comment' => [
                '_' => 'תגובה חדשה',

                'comment_new' => ':username הגיב ":content" ב":title"',
                'comment_new_compact' => ':username הגיב ":content"',
                'comment_reply' => ':username הגיב ":content" ב":title"',
                'comment_reply_compact' => ':username הגיב ":content"',
            ],
        ],

        'channel' => [
            '_' => 'צ\'אט',

            'channel' => [
                '_' => 'הודעה חדשה',
                'pm' => [
                    'channel_message' => ':username אומר ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'מ:username',
                ],
            ],
        ],

        'build' => [
            '_' => 'יומן שינויים',

            'comment' => [
                '_' => 'תגובה חדשה',

                'comment_new' => ':username הגיב ":content" ב":title"',
                'comment_new_compact' => ':username הגיב ":content"',
                'comment_reply' => ':username הגיב ":content" ב":title"',
                'comment_reply_compact' => ':username הגיב ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'חדשות',

            'comment' => [
                '_' => 'תגובה חדשה',

                'comment_new' => ':username הגיב ":content" ב":title"',
                'comment_new_compact' => ':username הגיב ":content"',
                'comment_reply' => ':username הגיב ":content" ב"::title"',
                'comment_reply_compact' => ':username הגיב ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'נושא פורום',

            'forum_topic_reply' => [
                '_' => 'תגובת פורום חדשה',
                'forum_topic_reply' => ':username הגיב לנושא פורום ":title".',
                'forum_topic_reply_compact' => ':username הגיב',
            ],
        ],

        'legacy_pm' => [
            '_' => 'הודעה פרטית ישנה',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited הודעה שלא נקראה.|:count_delimited הודעות שלא נקראו.',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'מפה חדשה',

                'user_beatmapset_new' => 'מפה חדשה ":title" מאת :username',
                'user_beatmapset_new_compact' => 'מפה חדשה ":title"',
                'user_beatmapset_new_group' => 'מפות חדשות מאת :username',

                'user_beatmapset_revive' => '',
                'user_beatmapset_revive_compact' => '',
            ],
        ],

        'user_achievement' => [
            '_' => 'מדליות',

            'user_achievement_unlock' => [
                '_' => 'מדליה חדשה',
                'user_achievement_unlock' => 'נפתח ":title"!',
                'user_achievement_unlock_compact' => 'נפתח ":title"!',
                'user_achievement_unlock_group' => 'מדליות נפתחו!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => '',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'הדיון על ":title" ננעל',
                'beatmapset_discussion_post_new' => 'לדיון על ":title" יש עדכונים חדשים',
                'beatmapset_discussion_unlock' => 'הדיון על ":title" נפתח',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'בעיה חדשה דווחה ב":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" נפסלה',
                'beatmapset_love' => '":title" קודמה להיות נאהבת',
                'beatmapset_nominate' => '":title" דורגה',
                'beatmapset_qualify' => '":title" קיבלה מספיק הצבעות ונכנסה לתור הדירוג',
                'beatmapset_rank' => '":title" דורגה',
                'beatmapset_remove_from_loved' => '":title" הוסרה מנאהב',
                'beatmapset_reset_nominations' => 'ההצבעה של ":title" אופסה',
            ],

            'comment' => [
                'comment_new' => 'למפה ":title" יש תגובות חדשות',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => 'קיבלת הודעה חדשה מאת :username',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'רשימת שינויים ":title" יש תגובות חדשות',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'חדשות ":title" יש תגובות חדשות',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'יש תגובות חדשות ב":title"',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username פתח מדליה חדשה, ":title"!',
                'user_achievement_unlock_self' => 'פתחת מדליה חדשה, ":title"!',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username יצר מפות חדשות',
            ],
        ],
    ],
];
