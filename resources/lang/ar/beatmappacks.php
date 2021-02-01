<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'مجموعات خرائط محزومة-مسبقا مبنية على اساس موضوع مشهور.',
        'nav_title' => 'القائمة',
        'title' => 'حُزَم الخرائِط',

        'blurb' => [
            'important' => 'اقرأ هذا قبل التحميل',
            'instruction' => [
                '_' => "التثبيت: عندما يتم تحميل الحزمة, استخرج ملف .rar الى مجلد اغاني osu! الخاص بك.
                    كل الأغاني لا تزال مضغوطة و/أو بصيفة osz. داخل الحزمة, لذا osu! سوق تحتاج الى اسخراج الخرائط بذاتها في المرة القادمة عندما تفتح اللعبة.
                    :scary استخرج ملفات zip/osz بنفسك,
                    او الخرائط سوف تظهر بشكل خاطئ في osu! ولم تقوم بأداء وظيفتها بالشكل المطلوب.",
                'scary' => 'لا تقم',
            ],
            'note' => [
                '_' => 'خذ بعين الاعتبار انه من الموصى للغاية ان :scary, بحيث ان الخرائط القديمة ذات جودة اقل بكثير من الخرائط الجديدة.',
                'scary' => 'قم بتحميل الحزم من الأحدث الى الأقدم',
            ],
        ],
    ],

    'show' => [
        'download' => 'تحميل',
        'item' => [
            'cleared' => 'ممحو',
            'not_cleared' => 'غير ممحو',
        ],
        'no_diff_reduction' => [
            '_' => ':link قد لا يستخدم لأتمام هذه الحزمة.',
            'link' => 'مودات تقليل الصعوبة',
        ],
    ],

    'mode' => [
        'artist' => 'ألبوم/الفنان',
        'chart' => 'تسليط الأضواء',
        'standard' => 'أساسي',
        'theme' => 'مظهر',
    ],

    'require_login' => [
        '_' => 'يجب ان تكون :link للتحميل',
        'link_text' => 'مُسَجَل',
    ],
];
