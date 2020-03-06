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
    'edit' => [
        'title_compact' => 'الإعدادات',
        'username' => 'اسم المستخدم',

        'avatar' => [
            'title' => 'الرمزية',
            'rules' => 'نرجو ان تتأكد ان صورتك تلتزم بـ:link<br/>هذا يعني انه يجب ان تكون <strong>ملائمة لكل الأعمار</strong>. كمثال لا تعري, الفاظ نابية او محتوى عنيف.',
            'rules_link' => 'قوانين المجتمع',
        ],

        'email' => [
            'current' => 'البريد الإلكتروني الحالي',
            'new' => 'البريد الإلكتروني الحديث',
            'new_confirmation' => 'تأكيد البريد الإلكتروني',
            'title' => 'البريد الإلكتروني',
        ],

        'password' => [
            'current' => 'كلمة المرور الحالية',
            'new' => 'كلمة المرور الجديدة',
            'new_confirmation' => 'تأكيد كلمة السر',
            'title' => 'كلمة السر',
        ],

        'profile' => [
            'title' => 'ألمِلَف الشخصي',

            'user' => [
                'user_discord' => '',
                'user_from' => 'ألموقع الحالي',
                'user_interests' => 'الاهتمامات',
                'user_msnm' => '',
                'user_occ' => 'المهنة',
                'user_twitter' => '',
                'user_website' => 'الصفحة الشخصية',
            ],
        ],

        'signature' => [
            'title' => 'التوقيع',
            'update' => 'تحديث',
        ],
    ],

    'notifications' => [
        'title' => 'الإشعارات',
        'topic_auto_subscribe' => 'تفعيل الإشعارات تلقائيًا حول مواضيع المنتدى الجديدة التي تنشئها',
        'beatmapset_discussion_qualified_problem' => 'الحصول على اشعارات عند حدوث مشاكل في الأغاني المؤهلة على الأنماط التالية',

        'mail' => [
            '_' => 'تلقي اشعارات البريد الإلكتروني ل',
            'beatmapset:modding' => 'اقتراحات الأغنية',
            'forum_topic_reply' => 'رد الموضوع',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'العملاء الموثوقون',
        'own_clients' => 'امتلك منصات',
        'title' => '0ثقة',
    ],

    'playstyles' => [
        'keyboard' => 'لوحة المفاتيح',
        'mouse' => 'ماوس',
        'tablet' => 'تابليت',
        'title' => 'اساليب اللعب',
        'touch' => 'شاشة لمس',
    ],

    'privacy' => [
        'friends_only' => 'حظر الرسائل الخاصة من الناس الذين ليسو على قائمة الأصدقاء الخاصة بك',
        'hide_online' => 'إخفاء وجودك على الموقع',
        'title' => 'الخصوصية',
    ],

    'security' => [
        'current_session' => 'الحالي',
        'end_session' => 'انهاء الجلسة',
        'end_session_confirmation' => 'سيؤدي هذا إلى إنهاء جلسة العمل الخاصة بك على ذلك الجهاز فورا. هل أنت متأكد؟',
        'last_active' => 'آخر نشاط:',
        'title' => 'الأمان',
        'web_sessions' => 'جلسات الإنترنت',
    ],

    'update_email' => [
        'update' => 'تحديث',
    ],

    'update_password' => [
        'update' => 'تحديث',
    ],

    'verification_completed' => [
        'text' => 'يمكنك الان إغلاق هذه النافذة',
        'title' => 'تم الإنتهاء من التحقق',
    ],

    'verification_invalid' => [
        'title' => 'رابط التثبيت غير صالح أو منتهي الصلاحية',
    ],
];
