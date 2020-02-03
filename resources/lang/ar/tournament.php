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
        'none_running' => 'ليس هناك بطولات قيد التشغيل في الوقت الحالي، الرجاء التحقق في وقت لاحق!',
        'registration_period' => 'التسجيل: :start الى :end',

        'header' => [
            'title' => 'بطولات المجتمع',
        ],

        'item' => [
            'registered' => 'الاعبون المُسجلون',
        ],

        'state' => [
            'current' => 'البطولات الحالية',
            'previous' => 'البطولات السابقة',
        ],
    ],

    'show' => [
        'banner' => 'ادعم فريقك',
        'entered' => 'انت مسجل لهذه البطولة.<br><br>رجائاََ اعرف ان هذا <b>لا</b> يعني انه تم تسجيلك لأحد الفرق.<br><br>سوف نرسل تعليمات الأستكمال عبر البريد عند قرب وقت البطولة, لذا ارجوك تأكد ان بريد osu! الخاص بك موثق!',
        'info_page' => 'صفحة المعلومات',
        'login_to_register' => 'رجائاََ قم بـ :login لعرض معلومات التسجيل!',
        'not_yet_entered' => 'انت غير مسجل لهذه البطولة.',
        'rank_too_low' => 'أنت لا تستوفي متطلبات التسجيل لهذه البطولة!',
        'registration_ends' => 'التسجيل يغلق في:date',

        'button' => [
            'cancel' => 'الغاء التسجيل',
            'register' => 'سجلني!',
        ],

        'period' => [
            'end' => 'نهاية',
            'start' => 'البداية',
        ],

        'state' => [
            'before_registration' => 'لم يتم فتح التسجيل لهذه البطولة حتى الآن.',
            'ended' => 'لقد اختُتِمَت البطولة. تحقق من صفحة المعلومات من اجل النتائج.',
            'registration_closed' => 'تم إغلاق التسجيل لهذه البطولة. تحقق من صفحة المعلومات للحصول على أحدث التحديثات.',
            'running' => 'هذه البطولة قيد التقدم حاليا. تحقق من صفحة المعلومات للحصول على مزيد من التفاصيل.',
        ],
    ],
    'tournament_period' => ':start الى :end',
];
