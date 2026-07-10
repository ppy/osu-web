<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'جميع الإشعارات مقروءة!',
    'delete' => 'حذف :type',
    'loading' => 'جاري تحميل الإشعارات غير المقروءة...',
    'mark_read' => 'مَحو :type',
    'none' => 'لا توجد إشعارات',
    'see_all' => 'عرض جميع الإشعارات',
    'see_channel' => 'انتقل للمُحادثة',
    'verifying' => 'الرجاء التحقق من الجلسة لعرض الإشعارات',

    'action_type' => [
        '_' => 'الكل',
        'beatmapset' => 'الخرائط',
        'build' => 'النُسَخ',
        'channel' => 'المحادثة',
        'forum_topic' => 'منتدى',
        'news_post' => 'الأخبار',
        'team' => 'الفريق',
        'user' => 'الملف الشخصي',
    ],

    'filters' => [
        '_' => 'الكل',
        'beatmapset' => 'الخرائط',
        'build' => 'النُسَخ',
        'channel' => 'محادثة',
        'forum_topic' => 'المنتدى',
        'news_post' => 'الأخبار',
        'team' => 'الفريق',
        'user' => 'الملف الشخصي',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'المقطوعة',

            'beatmap_owner_change' => [
                '_' => 'صعوبة الضيف',
                'beatmap_owner_change' => 'أنت الآن مالك صعوبة ":beatmap" على الخريطة ":title"',
                'beatmap_owner_change_compact' => 'أنت الآن مالك صعوبة ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'مناقشة الخريطة',
                'beatmapset_discussion_lock' => 'تم إغلاق المناقشة حول ”:title“',
                'beatmapset_discussion_lock_compact' => 'المناقشة مقفلة',
                'beatmapset_discussion_post_new' => 'منشور جديد على ":title" من قبل :username',
                'beatmapset_discussion_post_new_empty' => 'منشور جديد على ":title" من قبل :username',
                'beatmapset_discussion_post_new_compact' => 'منشور جديد بواسطة :username',
                'beatmapset_discussion_post_new_compact_empty' => 'منشور جديد بواسطة :username',
                'beatmapset_discussion_review_new' => 'مراجعة جديدة على ":title" من قبل :username تحتوي على مشاكل: :problems, اقتراحات: :suggestions, تشجيع: :praises',
                'beatmapset_discussion_review_new_compact' => 'مراجعة جديدة من قبل :username تحتوي على مشاكل: :problems, اقتراحات: :suggestions, تشجيع: :praises',
                'beatmapset_discussion_unlock' => 'تم فتح قفل المناقشة على ":title"',
                'beatmapset_discussion_unlock_compact' => 'تم الغاء قفل المناقشة',

                'review_count' => [
                    'praises' => ':count_delimited إشادة|:count_delimited إشادات',
                    'problems' => ':count_delimited مشكلة|:count_delimited مشاكل',
                    'suggestions' => ':count_delimited إقتراح|:count_delimited مقترحات',
                ],
            ],

            'beatmapset_problem' => [
                '_' => 'مشكلة في خريطة مؤهلة',
                'beatmapset_discussion_qualified_problem' => 'ابلغ عنه بواسطة :username على ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'ابلغ عنه بواسطة :username على ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'تم الإبلاغ بواسطة :username: ":content"
',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'ابلغ عنه بواسطة :username',
            ],

            'beatmapset_state' => [
                '_' => 'تم تغيير حالة الخريطة',
                'beatmapset_disqualify' => 'حرُِمت ":title" من التأهل',
                'beatmapset_disqualify_compact' => 'تم استبعاد الخريطة',
                'beatmapset_love' => 'أرتقت ":title" لـ خريطة Loved',
                'beatmapset_love_compact' => 'أرتقت الخريطة لتصبح Loved',
                'beatmapset_nominate' => 'تم ترشيح ":title"',
                'beatmapset_nominate_compact' => 'تم ترشيح الخريطة',
                'beatmapset_qualify' => '":title" حصلت على ترشيحات كافية ودخلت حالة التصنيف',
                'beatmapset_qualify_compact' => 'دخلت الخريطة قائمة التصنيف',
                'beatmapset_rank' => '":title" اصبحت الأن Ranked',
                'beatmapset_rank_compact' => ' كانت هذه الخريطة Ranked',
                'beatmapset_remove_from_loved' => '":title" تمت ازالتها من "خرائط Loved"',
                'beatmapset_remove_from_loved_compact' => 'أُزيلت الخريطة من "خرائط Loved"',
                'beatmapset_reset_nominations' => 'تم اعادة تعيين ترشيحات ":title"',
                'beatmapset_reset_nominations_compact' => 'تم اعادة ضبط الترشيح',
            ],

            'comment' => [
                '_' => 'تعليق جديد',

                'comment_new' => ':username علق ":content" على ":title"',
                'comment_new_compact' => ':username علق ":content"',
                'comment_reply' => ':username رد ":content" على ":title"',
                'comment_reply_compact' => ':username رد ":content"',
            ],
        ],

        'channel' => [
            '_' => 'دردشة',

            'announcement' => [
                '_' => 'إعلان جديد',

                'announce' => [
                    'channel_announcement' => ':username يقول ":title"',
                    'channel_announcement_compact' => ':title',
                    'channel_announcement_group' => 'إعلان من :username',
                ],
            ],

            'channel' => [
                '_' => 'رسالة جديدة',

                'pm' => [
                    'channel_message' => ':title يقول :username',
                    'channel_message_compact' => 'العنوان:',
                    'channel_message_group' => 'من :username',
                ],
            ],

            'channel_mention' => [
                '_' => 'ذكر في الدردشة',

                'public' => [
                    'channel_mention' => 'قام :username بذكرك في :name ":title"',
                    'channel_mention_compact' => ':username ":title"',
                    'channel_mention_group' => 'تم ذكرك في :name',
                ],
            ],

            'channel_team' => [
                '_' => 'رسالة فريق جديدة',

                'team' => [
                    'channel_team' => ':username يقول: ":title"',
                    'channel_team_compact' => ':username يقول: ":title"',
                    'channel_team_group' => ':username يقول: ":title"',
                ],
            ],
        ],

        'build' => [
            '_' => 'سِجل التغييرات',

            'comment' => [
                '_' => 'تعليق جديد',

                'comment_new' => ':username علق ":content" على ":title"',
                'comment_new_compact' => ':username علق ":content"',
                'comment_reply' => ':username رد ":content" على ":title"',
                'comment_reply_compact' => ':username رد ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'الأخبار',

            'comment' => [
                '_' => 'تعليق جديد',

                'comment_new' => ':username علق":content" على ":title"',
                'comment_new_compact' => ':username علق ":content"',
                'comment_reply' => ':username رد ":content" على ":title"',
                'comment_reply_compact' => ':username رد ":content"',
            ],

            'news_post' => [
                '_' => 'الأخبار (:series)',

                'news_post_new' => ':title',
                'news_post_new_compact' => ':title',
            ],
        ],

        'forum_topic' => [
            '_' => 'موضوع المنتدى',

            'forum_topic_reply' => [
                '_' => ' رد منتدى جديد',
                'forum_topic_reply' => ':username رد على ":title"',
                'forum_topic_reply_compact' => ':username قام بالرد',
            ],
        ],

        'team' => [
            'team_application' => [
                '_' => 'طلب الانضمام للفريق',

                'team_application_accept' => "لقد أصبحت الآن عضواً في فريق :title",
                'team_application_accept_compact' => "لقد أصبحت الآن عضواً في فريق :title",

                'team_application_group' => 'تحديثات طلب الانضمام إلى الفريق',

                'team_application_reject' => 'تم رفض طلبك للانضمام إلى الفريق :title',
                'team_application_reject_compact' => 'تم رفض طلبك للانضمام إلى الفريق :title',
                'team_application_store' => ':title طلب الانضمام إلى فريقك',
                'team_application_store_compact' => ':title طلب الانضمام إلى فريقك',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'خريطة جديدة',

                'user_beatmapset_new' => 'خريطة جديدة ":title" بواسطة :username',
                'user_beatmapset_new_compact' => 'خريطة جديدة ":title"',
                'user_beatmapset_new_group' => 'خرائِط جديدة بواسطة :username',

                'user_beatmapset_revive' => 'الخريطة ":title" تم إحياؤها بواسطة :username',
                'user_beatmapset_revive_compact' => 'تم إحياء الخريطة ":title"',
            ],
        ],

        'user_achievement' => [
            '_' => 'الأوسِمة',

            'user_achievement_unlock' => [
                '_' => 'ميدالية جديدة',
                'user_achievement_unlock' => 'قمت بفتح ":title"!',
                'user_achievement_unlock_compact' => 'قمت بفتح ":title"!',
                'user_achievement_unlock_group' => 'قمت بفتح الأوسِمة!',
            ],
        ],
    ],

    'mail' => [
        'news' => 'الأخبار',

        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'أنت الآن ضيف خريطة ":title"',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'تم قفل المناقشة على ":title"',
                'beatmapset_discussion_post_new' => 'المناقشة حول ":title" تحتوي على تحديثات جديدة',
                'beatmapset_discussion_unlock' => 'تم فتح قفل المناقشة على ":title"',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'تم الإبلاغ عن مشكلة جديدة على ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => 'حُرِمَت ":title" من التأهُل',
                'beatmapset_love' => '":title" اصبخت الأن Loved',
                'beatmapset_nominate' => 'اصبحت ":title" مرشحة',
                'beatmapset_qualify' => '":title" حصلت على ترشيحات كافية ودخلت حالة التصنيف',
                'beatmapset_rank' => '":title" اصبحت الأن Ranked',
                'beatmapset_remove_from_loved' => '":title" أُزيلَت مِن "خرائط Loved"',
                'beatmapset_reset_nominations' => 'تم اعادة تعيين ترشيحات ":title"',
            ],

            'comment' => [
                'comment_new' => ' الخريطة ":title" تحتوي على تعليقات جديدة',
            ],
        ],

        'channel' => [
            'announcement' => [
                'channel_announcement' => 'هناك إعلان جديد في ":name"',
            ],
            'channel' => [
                'channel_message' => 'لقد تلقيت رسالة جديدة من :username',
            ],
            'channel_mention' => [
                'channel_mention' => 'قام :username بذكرك في :name ":title"',
            ],

            'channel_team' => [
                'channel_team' => 'هناك رسالة جديدة في فريق ":name"',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'سجل التحديثات ":title" يحتوي على تعليقات جديدة',
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

        'team' => [
            'team_application' => [
                'team_application_accept' => "لقد أصبحت الآن عضواً في فريق :title",
                'team_application_reject' => 'تم رفض طلبك للانضمام إلى فريق :title',
                'team_application_store' => 'طلب :title الانضمام إلى فريقك',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                'user_beatmapset_new' => 'قام :username بإنشاء خرائط جديدة',
                'user_beatmapset_revive' => ':username قام بإحياء الخرائط',
            ],
        ],
    ],
];
