<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => 'تم تحديد :attribute خاطئ.',
    'not_negative' => ':attribute لا يمكن ان يكون سلبياََ.',
    'required' => ':attribute مطلوب.',
    'too_long' => ':attribute تجاوز الحد المطلوب - يمكن ان يصل حد :limit حروف فقط.',
    'wrong_confirmation' => 'التأكيد لا يتطابق.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'الطابع الزمني المحدد ولكن الخريطة مفقودة.',
        'beatmapset_no_hype' => "الخريطة لان يمكن ان تُشاد.",
        'hype_requires_null_beatmap' => 'الاِشادة يحب ان تتم في قسم العام (كل الصعوبات).',
        'invalid_beatmap_id' => 'تم تحديد صعوبة غير صالحة.',
        'invalid_beatmapset_id' => 'تم تحديد خريطة غير صالحة.',
        'locked' => 'المناقشة مقفلة.',

        'attributes' => [
            'message_type' => 'نوع الرسالة',
            'timestamp' => 'الطابع الزمني',
        ],

        'hype' => [
            'discussion_locked' => "هذه الخريطة مقفلة حاليا للنقاش ولا يمكن أِضافة نقاط تشجيع لها",
            'guest' => 'يجب أن تسجل دخولك للاِشادة.',
            'hyped' => 'لقد اشدت هذه الخريطة بالفعل.',
            'limit_exceeded' => 'لقد استنفذت كافة اِشاداتك.',
            'not_hypeable' => 'لا يمكن اِشادة هذه الخريطة',
            'owner' => 'لا يمكن اِشادة خرائطك.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'الطابع الزمني المحدد أبعد من طول الخريطة.',
            'negative' => "الطابع الزمني لا يمكن أن يكون سلبيا.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'المناقشة مقفلة.',
        'first_post' => 'لا يمكن حذف منشور البداية.',

        'attributes' => [
            'message' => 'الرسالة',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'الرد على تعليق محذوف غير مسموح.',
        'top_only' => 'تثبيت تعليق الرد غير مسموح به.',

        'attributes' => [
            'message' => 'الرسالة',
        ],
    ],

    'follow' => [
        'invalid' => 'تم تحديد :attribute خاطئ.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'يمكن فقط التصويت لطلب المميزات.',
            'not_enough_feature_votes' => 'اصوات غير كافية.',
        ],

        'poll_vote' => [
            'invalid' => 'خيار غير صالح.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'غير مسموح بحذف منشور موارد الخريطة.',
            'beatmapset_post_no_edit' => 'غير مسموح بتعديل منشور موارد الخريطة.',
            'first_post_no_delete' => 'لا يمكن حذف المنشور الأول',
            'missing_topic' => 'المنشور يفتقد لـ موضوع',
            'only_quote' => 'الرد الخاص بك يحتوي على اقتباس فقط.',

            'attributes' => [
                'post_text' => 'مساحة المنشور',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'اسم الموضوع',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'الخيار المكرر غير مسموح به.',
            'grace_period_expired' => 'لا يمكن تحرير استطلاع للرأي بعد أكثر من :limit ساعة',
            'hiding_results_forever' => 'لا يمكن اخفاء نتائج التصويت الذي لا ينتهي.',
            'invalid_max_options' => 'لا يجوز أن تتجاوز خيارات المستخدم الواحد عدد الخيارات المسموحة.',
            'minimum_one_selection' => 'خاصية واحد لكل مستخدم مطلوبة.',
            'minimum_two_options' => 'تحتاج خاصيتين على الأقل.',
            'too_many_options' => 'تجاوزت الحد الأقصى لعدد الخيارات المسموح بها.',

            'attributes' => [
                'title' => 'عنوان الأستبيان',
            ],
        ],

        'topic_vote' => [
            'required' => 'حدد أحد الخيارات اثناء التصويت.',
            'too_many' => 'اخترت خيارات اكثر من المطلوب.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'تجاوزت الحد الأقصى لعدد الـ0Auth المسموح به.',
            'url' => 'المرجو إدخال عنوان صحيح.',

            'attributes' => [
                'name' => 'اسم التّطبيق',
                'redirect' => 'رابط نقطة معاودة التطبيق',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'كلمة المرور يجب أن لا تحتوي على اسم المستخدم.',
        'email_already_used' => 'البريد الإلكتروني مستخدم مسبقاََ.',
        'email_not_allowed' => 'عنوان البريد الإلكتروني غير مسموح به.',
        'invalid_country' => 'الدولة ليست في قاعدة البيانات.',
        'invalid_discord' => 'اِسم خلاف غير صالح.',
        'invalid_email' => "لا يبدو وكأنه بريد الكتروني صالح.",
        'invalid_twitter' => 'اسم تويتر غير صالح.',
        'too_short' => 'كلمة المرور الجديدة قصيرة جداً.',
        'unknown_duplicate' => 'اسم المستخدم أو عنوان البريد الإلكتروني مستخدمة مسبقاََ.',
        'username_available_in' => 'اسم المستخدم سيكون متوفرا للاِستعمال في :duration.',
        'username_available_soon' => 'اسم المستخدم سيكون متوفرا للاِستعمال في اي دقيقة الان!',
        'username_invalid_characters' => 'يحتوي اسم المستخدم على أحرف غير صالحة.',
        'username_in_use' => 'الاسم مستخدم حاليا!',
        'username_locked' => 'الاسم مستخدم حاليا!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'رجائاََ استخدم الخط السفلي او المسافة, ليس كلاهما!',
        'username_no_spaces' => "اسم المسخدم لا يمكن ان يبدأ او ينتهي مع مسافات!",
        'username_not_allowed' => 'اختيار اسم المستخدم غير مقبول.',
        'username_too_short' => 'اسم المستخدم المطلوب قصير جداََ.',
        'username_too_long' => 'اسم المسيتخدم المطلوب طويل للغاية.',
        'weak' => 'كلمة سر ممنوعة.',
        'wrong_current_password' => 'كلمة السر الحالية غير صحيحة.',
        'wrong_email_confirmation' => 'تأكيد البريد الألكتروني لا يتطابق.',
        'wrong_password_confirmation' => 'تأكيد كلمة المرور لا يتطابق.',
        'too_long' => 'تجاوزت الحد المطلوب - يمكن ان يصل الى :limit حروف فقط.',

        'attributes' => [
            'username' => 'اسم المُستخدم',
            'user_email' => 'عنوان البريد الإلكتروني',
            'password' => 'كلمة المرور',
        ],

        'change_username' => [
            'restricted' => 'لا يمكنك تغيير اسم المستخدم اذا كان حسابك مقيد.',
            'supporter_required' => [
                '_' => 'تحتاج إلى أن تملك :link لتغيير اسمك!',
                'link_text' => 'اِدعم osu!',
            ],
            'username_is_same' => 'هذا هو اسم المستخدم الخاص بك حالياََ ايها السخيف!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => '',
        'reason_not_valid' => ':reason ليس مقبولا لنوع الأبلاغ هذا.',
        'self' => "لا يمكنك الإبلاغ عن نفسك!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'الكمية',
                'cost' => 'التكلفة',
            ],
        ],
    ],
];
