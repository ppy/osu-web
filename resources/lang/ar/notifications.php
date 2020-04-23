<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'تم قراءة جميع الإشعارات!',
    'mark_read' => 'مَحو :type',
    'none' => 'لا إشعارات',
    'see_all' => 'أِظهار جميع الإشعارات',

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
                'beatmapset_reset_nominations' => 'تم اعادة تعيين ترشيحات ":title"',
                'beatmapset_reset_nominations_compact' => 'تم اعادة ضبط الترشيح',
            ],

            'comment' => [
                '_' => 'تعليق جديد',

                'comment_new' => 'علق :username ":content" على ":title"',
                'comment_new_compact' => 'علق :username ":content"',
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
            ],
        ],

        'news_post' => [
            '_' => 'الأخبار',

            'comment' => [
                '_' => 'تعليق جديد',

                'comment_new' => 'علق :username ":content" في ":title"',
                'comment_new_compact' => 'علق :username ":content"',
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
            ],
        ],
    ],
];
