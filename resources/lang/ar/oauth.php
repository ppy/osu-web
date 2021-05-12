<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'إلغاء',

    'authorise' => [
        'request' => 'يطلب الإذن بالوصول إلى حسابك.',
        'scopes_title' => 'هذا التطبيق سوف يكون قادر على:',
        'title' => 'طلب الأذن',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'هل انت متأكد من سحب أذونات هذا العميل؟',
        'scopes_title' => 'يمكن لهذا التطبيق ان:',
        'owned_by' => 'يمتلكها :user',
        'none' => 'لا يوجد عملاء',

        'revoked' => [
            'false' => 'إبطال الدخول',
            'true' => 'الدخول باطل',
        ],
    ],

    'client' => [
        'id' => 'معرف العميل',
        'name' => 'اسم التّطبيق',
        'redirect' => 'رابط نقطة معاودة التطبيق',
        'reset' => 'تغيير Client Secret',
        'reset_failed' => 'فشل في إعادة تعيين Client Secret',
        'secret' => 'سؤال سر العميل',

        'secret_visible' => [
            'false' => 'اظهار Client Secret',
            'true' => 'إخفاء Client Secret',
        ],
    ],

    'new_client' => [
        'header' => 'تسجيل تطبيق 0Auth جديد',
        'register' => 'تسجيل تطبيق',
        'terms_of_use' => [
            '_' => 'بأستخدام الـAPI انت تقر بموافقتك على :link.',
            'link' => 'شروط الاستخدام',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'هل أنت متأكد أنك تريد حذف هذا العميل؟',
        'confirm_reset' => 'هل أنت متأكد من أنك تريد إعادة تعيين Client Secret؟ سيؤدي هذا إلى إلغاء جميع الرموز الموجودة.',
        'new' => 'تطبيق 0Auth جديد',
        'none' => 'لا عملاء',

        'revoked' => [
            'false' => 'حذف',
            'true' => 'محذوف',
        ],
    ],
];
