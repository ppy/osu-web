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
    'discussion-posts' => [
        'store' => [
            'error' => 'فشل في حفظ المنشور',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'فشل تحديث التصويت',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'السماح بـ كودوسو',
        'beatmap_information' => 'صفحة الخريطة',
        'delete' => 'حذف',
        'deleted' => 'حذف بواسطة :editor:delete_time.',
        'deny_kudosu' => 'رفض كودوسو',
        'edit' => 'تعديل',
        'edited' => 'التعديل الأخير تم بواسطة :editor:update_time.',
        'kudosu_denied' => 'ممنوع من جمع كودوسو.',
        'message_placeholder_deleted_beatmap' => 'تم حذف هذه الصعوبة لذا لا يمكن مناقشتها بعد الان.',
        'message_placeholder_locked' => 'المناقشة لحزمة المراحل تم ايقافها.',
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
        'delete_own_confirm' => 'هل انت متأكد؟ سوف تمسح الخريطة وسوف يتم ارجاعك الى ملفك الشخصي.',
        'delete_other_confirm' => 'هل انت متأكد؟ سوف تمسح الخريطة وسوف يتم ارجاعك الى ملف المستخدم الشخصي.',
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
        'qualified' => 'متوقع ان يتم تصفيفها في :date, اذا لم يتم اكتشاف اي اخطاء.',
        'qualified_soon' => 'متوقع ان يتم تصفيفها قريبا, اذا لم يتم اكتشاف اي اخطاء.',
        'required_text' => 'الترشيحات: :current/:required',
        'reset_message_deleted' => 'حُذفت',
        'title' => 'حالة الترشيح',
        'unresolved_issues' => 'لا تزال هناك اخطاء يجب الاِشارة اليها في البداية.',

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
            'supporter_filter' => 'تصفية بحسب :filters تحتاج الى إشارة مؤيد!osu فعالة',
            'not-found' => 'لا نتائج',
            'not-found-quote' => '... لا, لا يوجد شيء.',
            'filters' => [
                'general' => 'عام',
                'mode' => 'الوضع',
                'status' => 'الفئات',
                'genre' => 'النوع',
                'language' => 'اللغة',
                'extra' => 'اخرى',
                'rank' => 'المرتبة الحاصل عليها',
                'played' => 'لُعبت',
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
                'link_text' => 'اشارة مؤيد!osu',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'الصعوبة الموصاة',
        'converts' => 'ادخال الخرائط المتحولة',
    ],
    'mode' => [
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
        'MR' => 'مُباشر',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'Relax' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
    ],
    'language' => [
        'any' => '',
        'english' => 'إنكليزية',
        'chinese' => 'صينية',
        'french' => 'فرنسية',
        'german' => 'المانية',
        'italian' => 'ايطالية',
        'japanese' => 'يابانية',
        'korean' => 'كورية',
        'spanish' => 'إسبانية',
        'swedish' => 'سويدية',
        'instrumental' => 'آلة موسيقية',
        'other' => 'أخرى',
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
];
