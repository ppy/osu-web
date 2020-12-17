<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'تم قراءة جميع الإشعارات!',
    'delete' => '',
    'mark_read' => 'مَحو :type',
    'none' => 'لا إشعارات',
    'see_all' => 'أِظهار جميع الإشعارات',
    'see_channel' => '',

    'filters' => [
        '_' => 'الكل',
        'user' => 'الملف الشخصي',
        'beatmapset' => 'الخرائط',
        'forum_topic' => 'المنتدى',
        'news_post' => 'الأخبار',
        'build' => 'النُسَخ',
        'channel' => 'محادثة',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'المقطوعة',

            'beatmapset_discussion' => [
                '_' => 'منشاقشة المقطوعة',
                'beatmapset_discussion_lock' => 'تم اقفال مناقشة على ":title"',
                'beatmapset_discussion_lock_compact' => 'المناقشة مقفلة',
                'beatmapset_discussion_post_new' => 'منشور جديد على ":title" من قبل :username',
                'beatmapset_discussion_post_new_empty' => 'منشور جديد على ":title" من قبل :username',
                'beatmapset_discussion_post_new_compact' => 'منشور جديد بواسطة :username',
                'beatmapset_discussion_post_new_compact_empty' => 'منشور جديد بواسطة :username',
                'beatmapset_discussion_review_new' => 'مراجعة جديدة على ":title" من قبل :username تحتوي على مشاكل: :problems, اقتراحات: :suggestions, تشجيع: :praises',
                'beatmapset_discussion_review_new_compact' => 'مراجعة جديدة من قبل :username تحتوي على مشاكل: :problems, اقتراحات: :suggestions, تشجيع: :praises',
                'beatmapset_discussion_unlock' => 'تم فتح قفل مناقشة على ":title"',
                'beatmapset_discussion_unlock_compact' => 'تم الغاء قفل المناقشة',
            ],

            'beatmapset_problem' => [
                '_' => 'مشكلة في خريطة مؤهلة',
                'beatmapset_discussion_qualified_problem' => 'ابلغ عنه بواسطة :username على ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'ابلغ عنه بواسطة :username على ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'ابلغ عنه بواسطة :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'ابلغ عنه بواسطة :username',
            ],

            'beatmapset_state' => [
                '_' => 'تم تغيير حالة الخريطة',
                'beatmapset_disqualify' => 'حرم ":title" من التأهل',
                'beatmapset_disqualify_compact' => 'تم استبعاد الخريطة',
                'beatmapset_love' => 'اصبح ":title" محبوب',
                'beatmapset_love_compact' => 'اصبحت المقطوعة محبوبة',
                'beatmapset_nominate' => 'اصبح ":title" مرشح',
                'beatmapset_nominate_compact' => 'تم ترشيح الخريطة',
                'beatmapset_qualify' => '":title" حصل على ترشيحات كافية ودخل حالة التصنيف',
                'beatmapset_qualify_compact' => 'دخلت الخريطة قائمة التصنيف',
                'beatmapset_rank' => 'اصبحت ":title" مصنفة',
                'beatmapset_rank_compact' => 'تم تصنيف الخريطة',
                'beatmapset_remove_from_loved' => '',
                'beatmapset_remove_from_loved_compact' => '',
                'beatmapset_reset_nominations' => 'تم اعادة تعيين ترشيحات ":title"',
                'beatmapset_reset_nominations_compact' => 'تم اعادة ضبط الترشيح',
            ],

            'comment' => [
                '_' => 'تعليق جديد',

                'comment_new' => 'علق :username ":content" على ":title"',
                'comment_new_compact' => 'علق :username ":content"',
                'comment_reply' => ':username رد ":content" على ":title"',
                'comment_reply_compact' => ':username رد ":content"',
            ],
        ],

        'channel' => [
            '_' => 'دردشة',

            'channel' => [
                '_' => 'رسالة جديدة',
                'pm' => [
                    'channel_message' => ':title يقول :username',
                    'channel_message_compact' => 'العنوان:',
                    'channel_message_group' => 'من :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'سِجل التغييرات',

            'comment' => [
                '_' => 'تعليق جديد',

                'comment_new' => 'علق :username ":content" في ":title"',
                'comment_new_compact' => 'علق:username ":content"',
                'comment_reply' => ':username رد ":content" على ":title"',
                'comment_reply_compact' => ':username رد ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'الأخبار',

            'comment' => [
                '_' => 'تعليق جديد',

                'comment_new' => 'علق :username ":content" في ":title"',
                'comment_new_compact' => 'علق :username ":content"',
                'comment_reply' => ':username رد ":content" على ":title"',
                'comment_reply_compact' => ':username رد ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'موضوع المنتدى',

            'forum_topic_reply' => [
                '_' => ' رد منتدى جديد',
                'forum_topic_reply' => 'رد :username إلى ":title"',
                'forum_topic_reply_compact' => 'رد :username',
            ],
        ],

        'legacy_pm' => [
            '_' => 'نظام الرسائل القديم',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count رسالة غير مقروءة|:count رسالتان غير مقروءتان|:count رسائل غير مقروءة|:count رسالة غير مقروءة',
            ],
        ],

        'user_achievement' => [
            '_' => 'ميدالية',

            'user_achievement_unlock' => [
                '_' => 'ميدالية جديدة',
                'user_achievement_unlock' => 'تم فتح !:title',
                'user_achievement_unlock_compact' => 'تم فتح ":title"!',
                'user_achievement_unlock_group' => '',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'تم اقفال المناقشة على ":title"',
                'beatmapset_discussion_post_new' => 'المناقشة حول ":title" تحتوي على تحديثات جديدة',
                'beatmapset_discussion_unlock' => 'تم فتح قفل المناقشة على ":title"',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'تم الإبلاغ عن مشكلة جديدة على ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => 'حُرِمَت ":title" من التأهُل',
                'beatmapset_love' => 'اصبحت ":title" محبوبة',
                'beatmapset_nominate' => 'اصبحت ":title" مرشحة',
                'beatmapset_qualify' => '":title" حصلت على ترشيحات كافية ودخلت حالة التصنيف',
                'beatmapset_rank' => 'اصبحت ":title" مصنفة',
                'beatmapset_remove_from_loved' => '',
                'beatmapset_reset_nominations' => 'تم اعادة تعيين ترشيحات ":title"',
            ],

            'comment' => [
                'comment_new' => ' الخريطة ":title" تحتوي على تعليقات جديدة',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => 'لقد تلقيت رسالة جديدة من :username',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'سجل ":title" يحتوي على تعليقات جديدة',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'الأخبار ":title" تحتوي على تعليقات جديدة',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'هناك ردود جديدة في ":title"',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username فتح ميدالية جديدة، ":title"!',
                'user_achievement_unlock_self' => 'لقد فتحت ميدالية جديدة، ":title"!',
            ],
        ],
    ],
];
