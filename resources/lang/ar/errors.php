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
    'codes' => [
        'http-401' => 'الرجاء تسجيل الدخول للمضي قدما.',
        'http-403' => 'الوصول مرفوض.',
        'http-404' => 'غير موجود.',
        'http-429' => 'تم إجراء عدد كبير من المحاولات. أعد المحاولة لاحقًا.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'حدث خطأ. حاول تحديث الصفحة.',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => 'معطى خاطئ.',
        'standard_converts_only' => 'لا توجد نتائج موجودة للوضع المطلوب على هذه الصعوبة.',
    ],
    'checkout' => [
        'generic' => 'حدث خطأ أثناء اعداد طلبك.',
    ],
    'search' => [
        'default' => 'لم نمتكن من جلب اي نتائج, حاول مجددا لاحقا.',
        'operation_timeout_exception' => 'حاليا البحث مشغول اكثر من العادة, حاول مجددا لاحقا.',
    ],

    'logged_out' => 'تم تسجيل خروجك. الرجاء تسجيل الدخول وإعادة المحاولة.',
    'supporter_only' => 'يجب أن تكون مؤيد!osu لاستخدام هذه الميزة.',
    'no_restricted_access' => 'أنت لست قادراً على تنفيذ هذا الإجراء عندما يكون حسابك في حالة مقيدة.',
    'unknown' => 'حدث خطأ غير معروف.',
];
