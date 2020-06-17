<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'لا يمكن إرسال رسالة فارغة.',
            'limit_exceeded' => 'انت تقوم بإرسال الرسائل بسرعة كبيرة, الرجاء الانتظار قليلاً قبل المحاولة مرة أخرى.',
            'too_long' => 'أنت تحاول إرسال رسالة طويلة جداً.',
        ],
    ],

    'scopes' => [
        'identify' => 'يمكن له ان يتعرف عليك وان يقرأ ملفك الشخصي العام.',

        'friends' => [
            'read' => 'رؤية الأشخاص الذين تتابعهم.',
        ],

        'public' => 'يقرأ البيانات العامة نيابة عنك.',
    ],
];
