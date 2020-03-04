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
    'index' => [
        'description' => 'مجموعات خرائط محزومة-مسبقا مبنية على اساس موضوع مشهور.',
        'nav_title' => 'القائمة',
        'title' => 'حُزَم الخرائِط',

        'blurb' => [
            'important' => 'اقرأ هذا قبل التحميل',
            'instruction' => [
                '_' => "التثبيت: عندما يتم تحميل الحزمة, استخرج ملف .rar الى مجلد اغاني osu! الخاص بك.                     كل الأغاني لا تزال مضغوطة و/أو بصيفة osz. داخل الحزمة, لذا osu! سوق تحتاج الى اسخراج الخرائط بذاتها في المرة القادمة عندما تفتح اللعبة.                    :scary استخرج ملفات zip/osz بنفسك,                    او الخرائط سوف تظهر بشكل خاطئ في osu! ولم تقوم بأداء وظيفتها بالشكل المطلوب.",
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
