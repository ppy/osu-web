<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'فشل تحديث التصويت',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'السماح بـ كودوسو',
        'beatmap_information' => 'صفحة الخريطة',
        'delete' => 'حذف',
        'deleted' => 'تم الحذف بواسطة :editor:delete_time.',
        'deny_kudosu' => 'رفض كودوسو',
        'edit' => 'تعديل',
        'edited' => 'التعديل الأخير تم بواسطة :editor:update_time.',
        'guest' => '',
        'kudosu_denied' => 'ممنوع من جمع كودوسو.',
        'message_placeholder_deleted_beatmap' => 'تم حذف هذه الصعوبة لذا لا يمكن مناقشتها بعد الان.',
        'message_placeholder_locked' => 'المناقشة لحزمة المراحل تم ايقافها.',
        'message_placeholder_silenced' => "لا يمكن نشر مناقشه عندما تكون صامتاََ.",
        'message_type_select' => 'تحديد نوع التعليق',
        'reply_notice' => 'اضغط على ادخال للرد.',
        'reply_placeholder' => 'أدخل ردك هنا',
        'require-login' => 'يرجى تسجيل الدخول للرد او النشر',
        'resolved' => 'تم حله',
        'restore' => 'استعادة',
        'show_deleted' => 'عرض المحذوف',
        'title' => 'مناقشات',

        'collapse' => [
            'all-collapse' => 'طوي الكل',
            'all-expand' => 'توسيع الكل',
        ],

        'empty' => [
            'empty' => 'لم يتم العثور على أي مناقشات!',
            'hidden' => 'لا مناقشات تطابق المرشحات المطلوبة.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'إغلاق المناقشة',
                'unlock' => 'فتح المناقشة',
            ],

            'prompt' => [
                'lock' => 'سبب القفل',
                'unlock' => 'هل أنت متأكد من فتح القفل؟',
            ],
        ],

        'message_hint' => [
            'in_general' => 'سوف يذهب هذا المنشور إلى المناقشة العامة للخريطة. لأقتراح تعديل هذه الخريطة، ابدا رسالة مع طابع زمني (مثلاً 00:12:345).',
            'in_timeline' => 'لأقتراح تعديلات لأكثر من طابع زمني, انشر عدة مرات ( منشور واحد لكل طابع زمني).',
        ],

        'message_placeholder' => [
            'general' => 'اكتب هنا للنشر في العام (:version)',
            'generalAll' => 'اكتب هنا للنشر في العام (جميع الصعوبات)',
            'review' => 'اكتب هنا لنشر مراجعة',
            'timeline' => 'اكتب هنا للنشر في الخط الزمني (:version)',
        ],

        'message_type' => [
            'disqualify' => 'رفض التأهيل',
            'hype' => 'تشجيع!',
            'mapper_note' => 'ملاحظة',
            'nomination_reset' => 'رفض الترشيح',
            'praise' => 'مدح',
            'problem' => 'مشكلة',
            'review' => 'مراجعة',
            'suggestion' => 'اقتراح',
        ],

        'mode' => [
            'events' => 'السجل',
            'general' => 'عام :scope',
            'reviews' => 'المراجعات',
            'timeline' => 'الجدول الزمني',
            'scopes' => [
                'general' => 'هذه الصعوبة',
                'generalAll' => 'جميع الصعوبات',
            ],
        ],

        'new' => [
            'pin' => 'ثبّت',
            'timestamp' => 'الطابع الزمني',
            'timestamp_missing' => 'ctrl-c في وضع التعديل والصق الرسالة هنا لأدخال طابع زمني!',
            'title' => 'مناقشة جديدة',
            'unpin' => 'إزالة التثبيت',
        ],

        'review' => [
            'new' => 'مراجعة جديدة',
            'embed' => [
                'delete' => 'حذف',
                'missing' => '[المناقشة محذوفة]',
                'unlink' => 'إلغاء الربط',
                'unsaved' => 'غير محفوظة',
                'timestamp' => [
                    'all-diff' => 'المشاركات على "كل الصعوبات" لا يمكن أن تكون مميزة زمنياً.',
                    'diff' => 'إذا بدأ :type مع علامة زمنية، فسيتم عرضه تحت الخط الزمني.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'إدراج فقرة',
                'praise' => 'ادراج تشجيع',
                'problem' => 'إدراج مشكلة',
                'suggestion' => 'إدراج اقتراح',
            ],
        ],

        'show' => [
            'title' => ':title عينت بواسطة :mapper',
        ],

        'sort' => [
            'created_at' => 'وقت الإنشاء',
            'timeline' => 'الجدول الزمني',
            'updated_at' => 'التحديث الآخير',
        ],

        'stats' => [
            'deleted' => 'محذوف',
            'mapper_notes' => 'الملاحظات',
            'mine' => 'لي',
            'pending' => 'معلقة',
            'praises' => 'الإشادات',
            'resolved' => 'تم حلها',
            'total' => 'الكل',
        ],

        'status-messages' => [
            'approved' => 'تم قبول هذه الخريطة في :date!',
            'graveyard' => "لم يتم تحديث هذه الخريطة منذ :date وعلى الأغلب تم ايقاف العمل عليها من قبل المنشئ...",
            'loved' => 'تم اضافة هذه الخريطة الى الخرائط المحبوبة في :date!',
            'ranked' => 'هذه الخريطة في اصفافها في :date!',
            'wip' => 'ملاحظة: هذه الخريطة معلمة كـ قيد العمل بواسطة المنشئ.',
        ],

        'votes' => [
            'none' => [
                'down' => 'لا اصوات سلبية حتى الان',
                'up' => 'لا اصوات حتى الأن',
            ],
            'latest' => [
                'down' => 'الأصوات السلبية',
                'up' => 'الأصوات الأيجابية',
            ],
        ],
    ],

    'hype' => [
        'button' => 'إشادة الخريطة!',
        'button_done' => 'مُشادة بالفعل!',
        'confirm' => "هل انت متأكد؟ سوف يستخدم هذا احد إشاداتك الـ :n ولا يمكن التراجع عن ذلك.",
        'explanation' => 'قم بإشادة هذه الخريطة لجعلها اكثر وضوحاََ للمُرشِحين والإصفاف!',
        'explanation_guest' => 'قم بتسجيل الدخول واشِد هذه الخريطة لجعلها اكثر جذابية لدى المُرشِحين والاِصفاف!',
        'new_time' => "سوف تحصل على إشادة جديدة في :new_time.",
        'remaining' => 'لديك :remaining إشادات متبقية.',
        'required_text' => 'إشادة :current/:required',
        'section_title' => 'قطار الإشادة',
        'title' => 'اِشادة',
    ],

    'feedback' => [
        'button' => 'ترك تعليق',
    ],

    'nominations' => [
        'delete' => 'حذف',
        'delete_own_confirm' => 'هل انت متأكد؟ سوف تمسح الخريطة وسيتم ارجاعك الى ملفك الشخصي.',
        'delete_other_confirm' => 'هل انت متأكد؟ سوف تمسح الخريطة وسيتم ارجاعك الى ملف المستخدم الشخصي.',
        'disqualification_prompt' => 'سبب رفض التأهيل؟',
        'disqualified_at' => 'رفض تأهيلها في :time_ago (:reason).',
        'disqualified_no_reason' => 'لم يتم كتابة سبب معين',
        'disqualify' => 'رفض التأهيل',
        'incorrect_state' => 'خطأ في تنفيذ هذا الإجراء، حاول تحديث الصفحة.',
        'love' => 'حُب',
        'love_confirm' => 'حُب هذه الخريطة؟',
        'nominate' => 'ترشيح',
        'nominate_confirm' => 'ترشيح هذه الخريطة؟',
        'nominated_by' => 'تم ترشيحها بواسطة :users',
        'not_enough_hype' => "لا يوجد تشجيع كافي.",
        'remove_from_loved' => 'إزالة من خانة "المحبوبة"',
        'remove_from_loved_prompt' => 'سبب الإزالة من خانة "المحبوبة":',
        'required_text' => 'الترشيحات: :current/:required',
        'reset_message_deleted' => 'حُذفت',
        'title' => 'حالة الترشيح',
        'unresolved_issues' => 'لا تزال هناك اخطاء يجب الاِشارة اليها في البداية.',

        'rank_estimate' => [
            '_' => 'هذه الخريطة مقدرة بأن تصبح مصفوفة في :date إذا لم يتم العثور على أي مشاكل. انها#:position في :queue.',
            'queue' => 'قائمة انتظار الترتيب',
            'soon' => 'قريبًا',
        ],

        'reset_at' => [
            'nomination_reset' => 'اعادة تعيين حالة الترشيح بواسطة :user في :time_ago مع مشكلة جديدة :discussion (:message).',
            'disqualify' => 'رفض تأهيلها بواسطة :user في :time_ago مع مشكلة جديدة :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'هل انت متأكد؟ نشر مشكلة جديدة سوف يعيد تعيين حالة الترشيح.',
            'disqualify' => 'هل انت متأكد؟ هذا سوف يمسح الخريطة من التأهيل ويعيد تعيين حالة ترشيحها.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'اكتب الكلمات المفتاحية...',
            'login_required' => 'سجل الدخول للبحث.',
            'options' => 'خيارات بحث اكثر',
            'supporter_filter' => 'التصفية بحسب :filters تحتاج الى شارة osu!supporter فعالة',
            'not-found' => 'لا نتائج',
            'not-found-quote' => '... لا, لا يوجد شيء.',
            'filters' => [
                'extra' => 'اخرى',
                'general' => 'عام',
                'genre' => 'النوع',
                'language' => 'اللغة',
                'mode' => 'الوضع',
                'nsfw' => 'خرائط ذو محتوى حساس',
                'played' => 'لُعبت',
                'rank' => 'المرتبة الحاصل عليها',
                'status' => 'الفئات',
            ],
            'sorting' => [
                'title' => 'العنوان',
                'artist' => 'الفنان',
                'difficulty' => 'الصعوبه',
                'favourites' => 'المفضلة',
                'updated' => 'حُدثت',
                'ranked' => 'مصفوفة',
                'rating' => 'التقييم',
                'plays' => 'مرات اللعب',
                'relevance' => 'الأهمية',
                'nominations' => 'الترشيحات',
            ],
            'supporter_filter_quote' => [
                '_' => 'تصفية بحسب :filters تحتاج الى تفعيل :link',
                'link_text' => 'شارة osu!supporter',
            ],
        ],
    ],
    'general' => [
        'converts' => 'ادخال الخرائط المتحولة',
        'follows' => 'ألمنشئين المشتركين',
        'recommended' => 'الصعوبة الموصاة',
    ],
    'mode' => [
        'all' => 'الكل',
        'any' => 'الكل',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'الكل',
        'approved' => 'مقبولة',
        'favourites' => 'المفضلات',
        'graveyard' => 'مقبورة',
        'leaderboard' => 'تحتوي قائمة متصدرين',
        'loved' => 'محبوبة',
        'mine' => 'المراحل الخاصة بي',
        'pending' => 'معلقة وتحت العمل',
        'qualified' => 'مؤهلة',
        'ranked' => 'مقيّمة',
    ],
    'genre' => [
        'any' => 'الكل',
        'unspecified' => 'غير محدد',
        'video-game' => 'ألعاب الفيديو',
        'anime' => 'أنمي',
        'rock' => 'روك',
        'pop' => 'بوب',
        'other' => 'أخرى',
        'novelty' => 'الابداع',
        'hip-hop' => 'هيب هوب',
        'electronic' => 'إلكتروني',
        'metal' => 'ميتال',
        'classical' => 'كلاسيكي',
        'folk' => 'شعبي',
        'jazz' => 'جاز',
    ],
    'mods' => [
        '4K' => '',
        '5K' => '',
        '6K' => '',
        '7K' => '',
        '8K' => '',
        '9K' => '',
        'AP' => '',
        'DT' => '',
        'EZ' => '',
        'FI' => '',
        'FL' => '',
        'HD' => '',
        'HR' => '',
        'HT' => '',
        'MR' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'RX' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
        'V2' => 'نَمَط V2',
    ],
    'language' => [
        'any' => 'الكل',
        'english' => 'إنكليزية',
        'chinese' => 'صينية',
        'french' => 'فرنسية',
        'german' => 'المانية',
        'italian' => 'ايطالية',
        'japanese' => 'يابانية',
        'korean' => 'كورية',
        'spanish' => 'إسبانية',
        'swedish' => 'سويدية',
        'russian' => 'روسية',
        'polish' => 'بولندي',
        'instrumental' => 'آلة موسيقية',
        'other' => 'أخرى',
        'unspecified' => 'غير محدد',
    ],

    'nsfw' => [
        'exclude' => 'إخفاء',
        'include' => 'إظهار',
    ],

    'played' => [
        'any' => 'الكل',
        'played' => 'لُعبت',
        'unplayed' => 'لم تُلعب',
    ],
    'extra' => [
        'video' => 'تحوي فديو',
        'storyboard' => 'لوحة لوحة قصصية',
    ],
    'rank' => [
        'any' => 'الكل',
        'XH' => 'SS فضي',
        'X' => '',
        'SH' => 'S فضي',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'مرات اللعب: :count',
        'favourites' => 'التفضيلات: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'الكل',
        ],
    ],
];
