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
    'box' => [
        'sent' => 'تم ارسال بريد الكتروني الى :mail مع رمز التحقق. ادخل الرمز.',
        'title' => 'التحقق من الحساب',
        'verifying' => 'جار التحقق...',
        'issuing' => 'إصدار رمز جديد...',

        'info' => [
            'check_spam' => "تأكد من التحقق من مجلد البريد المزعج الخاص بك إذا تعذر العثور على عنوان البريد الإلكتروني.",
            'recover' => "اذا لم يكن لديك وصول الى بريدك الألكتروني او نسيت ماذا استخدمت, رجائاََ اتبع الـ :link.",
            'recover_link' => 'عملية استرداد البريد الإلكتروني هنا',
            'reissue' => 'يمكنك أيضا :reissue_link أو :logout_link.',
            'reissue_link' => 'طلب رمز آخر',
            'logout_link' => 'تسجيل الخروج',
        ],
    ],

    'errors' => [
        'expired' => 'رمز التحقق منتهي الصلاحية، تم ارسال بريد تحقق جديد.',
        'incorrect_key' => 'رمز التحقق غير صحيح.',
        'retries_exceeded' => 'رمز التحقق غير صحيح. تجاوزت حد إعادة المحاولة، تم ارسال بريد تحقق جديد.',
        'reissued' => 'تم اصدار رمز جديد، تم ارسال بريد تحقق جديد.',
        'unknown' => 'حدثت مشكلة غير معروفة، تم ارسال بريد تحقق جديد.',
    ],
];
