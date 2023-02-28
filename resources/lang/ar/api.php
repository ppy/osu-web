<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'لا يمكن إرسال رسالة فارغة.',
            'limit_exceeded' => 'انت تقوم بإرسال الرسائل بسرعة كبيرة، الرجاء الانتظار قليلاً قبل المحاولة مرة أخرى.',
            'too_long' => 'الرسالة التي تحاول إرسالها طويلة جداً.',
        ],
    ],

    'scopes' => [
        'bot' => 'مثل كبوت دردشة.',
        'identify' => 'يتعرف عليك ويقرأ ملفك الشخصي العام.',

        'chat' => [
            'write' => 'إرسال رسائل نيابة عنك.',
        ],

        'forum' => [
            'write' => 'إنشاء وتعديل مواضيع المنتدى والمشاركات نيابة عنك.',
        ],

        'friends' => [
            'read' => 'معرفة من تتابع.',
        ],

        'public' => 'قراءة البيانات العامة نيابة عنك.',
    ],
];
