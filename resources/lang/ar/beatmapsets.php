<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'هذه الأغنية غير متوفرة للتحميل حاليا.',
        'parts-removed' => 'تم حذف بعض اجزاء هذه الخريطة نظراََ لطلب من مالك او جهة خارجية.',
        'more-info' => 'تحقق هنا للمزيد من المعلومات.',
        'rule_violation' => 'تمت ازالة بعض المحتويات من هذه الخريطة بعد معرفة انها غير ملائِمة لـosu!.',
    ],

    'download' => [
        'limit_exceeded' => 'تَمهل, أِلعب أكثر.',
    ],

    'index' => [
        'title' => 'قائمة الخرائط',
        'guest_title' => 'الخرائط',
    ],

    'panel' => [
        'empty' => 'لا توجد خرائط',

        'download' => [
            'all' => 'تحميل',
            'video' => 'تحميل مع الفيديو',
            'no_video' => 'تحميل بدون الفيديو',
            'direct' => 'فتح في osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'تحتاج الخرائط الهجينة الى تحديد وضع تشغيل واحد على الأقل لِتَرشيحِها.',
        'incorrect_mode' => 'ليس لديك الصلاحيّات للترشيح للوضع: :mode',
        'full_bn_required' => 'يجب أن تكون "مرشِحًا كاملاً" لأداء هذا الترشيح المُؤَهِل.',
        'too_many' => 'تم بالفعل استيفاء شروط الترشيح.',

        'dialog' => [
            'confirmation' => 'هل أنت متأكد من أنك تريد ترشيح هذه الخريطة ؟',
            'header' => 'ترشيح الخريطة',
            'hybrid_warning' => 'ملاحظة: يمكنك أن ترشح مرة واحدة فقط، لذا يرجى التأكد من أنك ترشح لجميع أنماط اللعبة التي تنويها',
            'which_modes' => 'ترشيح لـ أي وضع؟',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'حَساس',
    ],

    'show' => [
        'discussion' => 'مناقشة',

        'details' => [
            'by_artist' => '',
            'favourite' => 'الاِعجاب بالخريطة',
            'favourite_login' => '',
            'logged-out' => 'يتجوب عليك تسجيل الدخول قبل تحميل اي خريطة!',
            'mapped_by' => 'نشأت بواسطة :mapper',
            'unfavourite' => 'الغاء الاِعجاب بالخريطة',
            'updated_timeago' => 'التحديث الأخير :timeago',

            'download' => [
                '_' => 'تحميل',
                'direct' => '',
                'no-video' => 'دون الفيديو',
                'video' => 'مع الفيديو',
            ],

            'login_required' => [
                'bottom' => 'للحصول على المزيد من الميزات',
                'top' => 'تسجيل الدخول',
            ],
        ],

        'details_date' => [
            'approved' => 'مقبولة :timeago',
            'loved' => 'محبوب timeago:',
            'qualified' => 'مؤهل timeago:',
            'ranked' => 'مصفوفة :timeago',
            'submitted' => 'مُقدَمَة :timeago',
            'updated' => 'آخر تحديث :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'لديك عدد كبير جداََ من الخرائط المحبوبة! رجائاََ قم بألغاء بعضها قبل المحاولة مجدداََ.',
        ],

        'hype' => [
            'action' => 'اَشِد هذه الخريطة ان احببت لعبها لمساعدتها لاِحتلال حالة <strong>التصفيف</strong>.',

            'current' => [
                '_' => 'هذه الخريطة حاليا :status.',

                'status' => [
                    'pending' => 'مُعلَقة',
                    'qualified' => 'مؤهلة',
                    'wip' => 'قيد العمل',
                ],
            ],

            'disqualify' => [
                '_' => 'اذا وجدت مشكلة مع الأغنية, ارجوك قم بأِلغاء تأهيلها :link.',
            ],

            'report' => [
                '_' => 'اذا كانت لديك مشكلة مع الخريطة رجائا ابلغ عنها :link لتنبيه فريق الدعم.',
                'button' => 'الإبلاغ عن مشكلة',
                'link' => 'هنا',
            ],
        ],

        'info' => [
            'description' => 'الوصف',
            'genre' => 'النوع',
            'language' => 'اللغة',
            'no_scores' => 'البيانات لا تزال تُحسب...',
            'nsfw' => 'محتوى حَساس',
            'points-of-failure' => 'نقاط الفشل',
            'source' => 'المصدر',
            'storyboard' => 'هذه الخريطة تحتوي على لوحة قصصية',
            'success-rate' => 'معدل النجاح',
            'tags' => 'ألعلامات',
            'video' => '',
        ],

        'nsfw_warning' => [
            'details' => 'تحتوي هذه الخريطة على محتوى حساس أو مسيء أو مزعج. هل ترغب في عرضها على أي حال؟',
            'title' => 'محتوى حَساس',

            'buttons' => [
                'disable' => 'تعطيل التحذيرات',
                'listing' => 'قائمة الخرائط',
                'show' => 'عرض',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'احتُلت عند :when',
            'country' => 'ترتيب الدولة',
            'friend' => 'ترتيب الأصدقاء',
            'global' => 'الترتيب العالمي',
            'supporter-link' => 'اضغط <a href=":link">هنا</a> لمشاهدة كل الميزات الرائعة التي تحصل عليها!',
            'supporter-only' => 'تحتاج ان تكون osu!supporter للوصول الى ترتيب الدولة والأصدقاء!',
            'title' => 'لوح النتائج',

            'headers' => [
                'accuracy' => 'الدقة',
                'combo' => 'اقصى مجموع',
                'miss' => 'اِخفاق',
                'mods' => 'المودات',
                'player' => 'اللاعب',
                'pp' => '',
                'rank' => 'المرتبه',
                'score_total' => 'مجموع النقاط',
                'score' => 'المجموع',
                'time' => 'الوقت',
            ],

            'no_scores' => [
                'country' => 'لا احد من دولتك حصل على نتيجة بهذه الخريطة بعد!',
                'friend' => 'لا احد من اصدقائك حصل على نتيجة بهذه الخريطة بعد!',
                'global' => 'لا نتيجة بعد. ربما عليك الحصول على واحدة؟',
                'loading' => 'جارِ تحميل النتائج...',
                'unranked' => 'خريطة غير مصنفة.',
            ],
            'score' => [
                'first' => 'في المقدمة',
                'own' => 'أفضل ما لديك',
            ],
        ],

        'stats' => [
            'cs' => 'حجم الدائرة',
            'cs-mania' => 'عدد المفاتيح',
            'drain' => 'استنزاف HP',
            'accuracy' => 'الدقة',
            'ar' => 'معدل الوصول',
            'stars' => 'نجوم الصعوبة',
            'total_length' => 'الطول',
            'bpm' => 'نبضات في الدقيقة',
            'count_circles' => 'عدد الدوائر',
            'count_sliders' => 'عدد المنزلقات',
            'user-rating' => 'تصنيف المستخدم',
            'rating-spread' => 'انتشار التصنيف',
            'nominations' => 'الترشيحات',
            'playcount' => 'مرات اللعب',
        ],

        'status' => [
            'ranked' => 'مقيّمة',
            'approved' => 'مقبولة',
            'loved' => 'محبوبة',
            'qualified' => 'مؤهلة',
            'wip' => 'جارية',
            'pending' => 'معلقة',
            'graveyard' => 'مقبورة',
        ],
    ],
];
