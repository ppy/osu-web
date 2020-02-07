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
        'none' => 'لا عملاء',

        'revoked' => [
            'false' => 'إبطال الدخول',
            'true' => 'الدخول باطل',
        ],
    ],

    'client' => [
        'id' => 'معرف العميل',
        'name' => 'اسم التّطبيق',
        'redirect' => 'رابط نقطة معاودة التطبيق',
        'secret' => 'سؤال سر العميل',
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
        'new' => 'تطبيق 0Auth جديد',
        'none' => 'لا عملاء',

        'revoked' => [
            'false' => 'حذف',
            'true' => 'محذوف',
        ],
    ],
];
