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
    'authorizations' => [
        'update' => [
            'null_user' => 'يجب أن يتم تسجيل دخولك للتعديل.',
            'system_generated' => 'المنشورات المتكونة تلقائيا لا يمكن تعديلها.',
            'wrong_user' => 'يجب أن تكون صاحب المنشور للتعديل.',
        ],
    ],

    'events' => [
        'empty' => 'لم يحدث أي شيء... حتى الآن.',
    ],

    'index' => [
        'deleted_beatmap' => 'حُذفت',
        'title' => 'مناقشات الخريطة',

        'form' => [
            '_' => 'البحث',
            'deleted' => 'شمل المناقشات المحذوفة',
            'only_unresolved' => 'اظهار المناقشات التي لم تحل فقط',
            'types' => 'أنواع الرسائل',
            'username' => 'اسم المستخدم',

            'beatmapset_status' => [
                '_' => 'حالة الخريطة',
                'all' => 'الكل',
                'disqualified' => 'رفض تأهيلها',
                'never_qualified' => 'لم تؤهل ابداََ',
                'qualified' => 'تأهلت',
                'ranked' => 'مصفوفة',
            ],

            'user' => [
                'label' => 'المستخدم',
                'overview' => 'نظرة عامة على الأنشطة',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'تاريخ الإرسال',
        'deleted_at' => 'تاريخ الحذف',
        'message_type' => 'النوع',
        'permalink' => 'الرابط الدائم',
    ],

    'nearby_posts' => [
        'confirm' => 'لا يشمل اي من هذه المنشورات حالتي',
        'notice' => 'هناك منشورات حول :timestamp (:existing_timestamps). رجائا تحقق منهم قبل النشر.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'سجل الدخول للرد',
            'user' => 'رد',
        ],
    ],

    'review' => [
        'go_to_parent' => 'مشاهدة منشور المراجعة',
        'go_to_child' => 'مشاهدة المناقشة',
        'validation' => [
            'invalid_block_type' => '',
            'invalid_document' => '',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'علمت كـ مُصلحة بواسطة :user',
            'false' => 'تم اعادة فتحها بواسطة :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'عام',
        'general_all' => 'عام (الكل)',
    ],

    'user_filter' => [
        'everyone' => 'الجميع',
        'label' => 'الفرز حسب المستخدم',
    ],
];
