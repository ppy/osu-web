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
    'availability' => [
        'disabled' => 'هذه الخريطة غير متوفرة للتحميل حاليا.',
        'parts-removed' => 'تم حذف اجزاء من هذه الخريطة نظراََ لطلب من مالك او جهة ثالثة للأغنية.',
        'more-info' => 'تحقق من هنا للمزيد من المعلومات.',
    ],

    'index' => [
        'title' => 'قائمة الخرائط',
        'guest_title' => 'الخرائط',
    ],

    'show' => [
        'discussion' => 'مناقشة',

        'details' => [
            'favourite' => 'الاِعجاب بالخريطة',
            'logged-out' => 'يتجوب عليك تسجيل الدخول قبل تحميل اي خريطة!',
            'mapped_by' => 'عينت بواسطة :mapper',
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

        'favourites' => [
            'limit_reached' => 'لديك عدد كبير جداََ من الخرائط المحبوبة! رجائاََ قم بألغاء بعضها قبل المحاولة مجدداََ.',
        ],

        'hype' => [
            'action' => 'اَشِد هذه الخريطة ان احببت لعبها لمساعدتها لاِحتلال حالة <strong>التصفيف</strong>.',

            'current' => [
                '_' => 'هذه الخريطة حاليا :status.',

                'status' => [
                    'pending' => 'معلقة',
                    'qualified' => 'مؤهلة',
                    'wip' => 'قيد العمل',
                ],
            ],

            'disqualify' => [
                '_' => 'اذا وجدت مشكلة مع الأغنية, ارجوك قم بأِلغاء تأهيلها :link.',
                'button_title' => 'أَلغِ تأهيل اغنية مؤهلة.',
            ],

            'report' => [
                '_' => 'اذا كانت لديك مشكلة مع الخريطة رجائا ابلغ عنها :link لتنبيه فريق الدعم.',
                'button' => 'الإبلاغ عن مشكلة',
                'button_title' => 'ابلغ عن مشكلة على خريطة مؤهلة.',
                'link' => 'هنا',
            ],
        ],

        'info' => [
            'description' => 'الوصف',
            'genre' => 'النوع',
            'language' => 'اللغة',
            'no_scores' => 'البيانات لا تزال تُحسب...',
            'points-of-failure' => 'نقاط الفشل',
            'source' => 'المصدر',
            'success-rate' => 'معدل النجاح',
            'tags' => 'الوسوم',
            'unranked' => 'خريطة غير مصفوفة',
        ],

        'scoreboard' => [
            'achieved' => 'احتُلت عند :when',
            'country' => 'ترتيب الدولة',
            'friend' => 'ترتيب الأصدقاء',
            'global' => 'الترتيب العالمي',
            'supporter-link' => 'اضغط <a href=":link">هنا</a> لمشاهدة كل الميزات الرائعة التي تحصل عليها!',
            'supporter-only' => 'تحتاج الى ان تكون مؤيد!osu للوصول الى ترتيب الدولة والأصدقاء!',
            'title' => 'لوح النتائج',

            'headers' => [
                'accuracy' => 'الدقة',
                'combo' => 'اعلى سرد',
                'miss' => 'اِخفاق',
                'mods' => 'التعديلات',
                'player' => 'اللاعب',
                'pp' => '',
                'rank' => 'الترتيب',
                'score_total' => 'مجموع النقاط',
                'score' => 'المجموع',
            ],

            'no_scores' => [
                'country' => 'لا احد من دولتك حصل على نتيجة بهذه الخريطة بعد!',
                'friend' => 'لا احد من اصدقائك حصل على نتيجة بهذه الخريطة بعد!',
                'global' => 'لا نتيجة بعد. ربما عليك الحصول على واحدة؟',
                'loading' => 'جارِ تحميل النتائج...',
                'unranked' => 'خريطة غير مصفوفة.',
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
