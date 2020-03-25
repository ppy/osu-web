<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
