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
    'header' => [
        'small' => 'تنافس بطرق أكثر من مجرد النقر فوق الدوائر.',
        'large' => 'مسابقات المجتمع',
    ],

    'index' => [
        'nav_title' => 'الجدولة',
    ],

    'voting' => [
        'over' => 'لقد انتهى التصويت لهذه المسابقة',
        'login_required' => 'يرجى تسجيل الدخول للتصويت.',

        'best_of' => [
            'none_played' => "لا يبدو وكأنه قد لعبت اي خرائط تؤهلك لهذه المسابقة!",
        ],

        'button' => [
            'add' => 'تصويت',
            'remove' => 'إزالة التصويت',
            'used_up' => 'لقد استنفذت كافة اصواتك',
        ],
    ],
    'entry' => [
        '_' => 'مشاركة',
        'login_required' => 'الرجاء تسجيل الدخول للمشاركة في المسابقة.',
        'silenced_or_restricted' => 'لا يمكنك دخول المسابقات بينما تكون مقيد أو صامت.',
        'preparation' => 'نحن نقوم حاليا بإعداد هذه المسابقة. الرجاء الانتظار بصبر!',
        'over' => 'شكرا لكم على مشاركاتكم! تم اغلاق المشاركات المستقبلية لهذه المسابقة والتصويت سيفتح قريبا.',
        'limit_reached' => 'لقد تجاوزت حد المشاركات المسموح لهذه المسابقة',
        'drop_here' => 'ضع مشاركتك هنا',
        'download' => 'تحميل .osz',
        'wrong_type' => [
            'art' => 'تُقبل ملفات.jpg و.png فقط لهذه المسابقة.',
            'beatmap' => 'تُقبل ملفات .osu فقط لهذه المسابقة.',
            'music' => 'تُقبل ملفات .mp3 فقط لهذه المسابقة.',
        ],
        'too_big' => 'مشاركات هذه المسابقة يمكن ان تصل الى :limit.',
    ],
    'beatmaps' => [
        'download' => 'تحميل المشاركة',
    ],
    'vote' => [
        'list' => 'الأصوات',
        'count' => ':count_delimited تصويت|:count_delimited الاصوات',
        'points' => ':count_delimited نقطة|:count_delimited نقاط',
    ],
    'dates' => [
        'ended' => 'انتهت :date',

        'starts' => [
            '_' => 'يبدأ :date',
            'soon' => 'قريبا™',
        ],
    ],
    'states' => [
        'entry' => 'المشاركة مفتوحة',
        'voting' => 'بدأ التصويت',
        'results' => 'النتائج خرجت',
    ],
];
