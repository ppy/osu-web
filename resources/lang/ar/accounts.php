<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'الإعدادات',
        'username' => 'اسم المستخدم',

        'avatar' => [
            'title' => 'الصورة الشخصية',
            'rules' => 'يرجى التأكد من ان صورتك تلتزم بـ:link<br/>هذا يعني انه يجب ان تكون <strong>مناسبة لجميع الأعمار</strong>. أي بلا تعري أو الفاظ نابية أو محتوى عنيف.',
            'rules_link' => 'قوانين المجتمع',
        ],

        'email' => [
            'current' => 'البريد الإلكتروني الحالي',
            'new' => 'بريد إلكتروني جديد',
            'new_confirmation' => 'تأكيد البريد الإلكتروني',
            'title' => 'البريد الإلكتروني',
        ],

        'password' => [
            'current' => 'كلمة المرور الحالية',
            'new' => 'كلمة المرور الجديدة',
            'new_confirmation' => 'تأكيد كلمة المرور',
            'title' => 'كلمة المرور',
        ],

        'profile' => [
            'title' => 'الملف الشخصي',

            'user' => [
                'user_discord' => '',
                'user_from' => 'الموقع الحالي',
                'user_interests' => 'الاهتمامات',
                'user_occ' => 'المهنة',
                'user_twitter' => '',
                'user_website' => 'موقع الشخصي',
            ],
        ],

        'signature' => [
            'title' => 'التوقيع',
            'update' => 'تحديث',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'تلقي إشعارات عن مشاكل جديدة في الخرائط المؤهلة على الأنماط التالية',
        'beatmapset_disqualify' => 'تلقي إشعارات عندما تكون الخرائط للأنماط التالية غير مؤهلة',
        'comment_reply' => 'تلقي إشعارات للردود على تعليقاتك',
        'title' => 'الإشعارات',
        'topic_auto_subscribe' => 'تمكين الإشعارات تلقائياً حول مواضيع المنتدى الجديدة التي تنشئها',

        'options' => [
            '_' => 'خيارات التوصيل',
            'beatmapset:modding' => 'اقتراحات الخريطة',
            'channel_message' => 'الرسائل الخاصة',
            'comment_new' => 'تعليقات جديدة',
            'forum_topic_reply' => 'رد الموضوع',
            'mail' => 'البريد',
            'mapping' => 'مُنشئ خرائط',
            'push' => 'دفع',
            'user_achievement_unlock' => 'فتح ميدالية للمستخدم',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'العملاء المصرح لهم',
        'own_clients' => 'العملاء الخاصين بك',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'إخفاء تحذيرات للمحتوى الحساس في الخرائط',
        'beatmapset_title_show_original' => 'إظهار بيانات تعريف الخرائط باللغة الأصلية',
        'title' => 'الخيارات',

        'beatmapset_download' => [
            '_' => 'نوع تحميل الخريطة الافتراضي',
            'all' => 'مع الفيديو إذا كان متاحا',
            'direct' => 'فتح في osu!direct',
            'no_video' => 'دون الفيديو',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'لوحة المفاتيح',
        'mouse' => 'الفأرة',
        'tablet' => 'لوحة وقلم رقمي',
        'title' => 'أساليب اللعب',
        'touch' => 'شاشة لمس',
    ],

    'privacy' => [
        'friends_only' => 'حظر الرسائل الخاصة من الأشخاص غير المدرجين في قائمة اصدقائك',
        'hide_online' => 'إخفاء وجودك على الموقع',
        'title' => 'الخصوصية',
    ],

    'security' => [
        'current_session' => 'الحالي',
        'end_session' => 'إنهاء الجلسة',
        'end_session_confirmation' => 'سيؤدي هذا إلى إنهاء جلستك فورا على ذلك الجهاز. هل أنت متأكد؟',
        'last_active' => 'آخر نشاط:',
        'title' => 'الأمان',
        'web_sessions' => 'جلسات الإنترنت',
    ],

    'update_email' => [
        'update' => 'تحديث',
    ],

    'update_password' => [
        'update' => 'تحديث',
    ],

    'verification_completed' => [
        'text' => 'يمكنك الآن إغلاق هذه النافذة',
        'title' => 'تم الانتهاء من التحقق',
    ],

    'verification_invalid' => [
        'title' => 'رابط التحقق غير صالح أو منتهي الصلاحية',
    ],
];
