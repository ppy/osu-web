<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        'none_found' => 'لم تم العثور على أي مناقشات تطابق معايير البحث.',
        'title' => 'مناقشات الخريطة',

        'form' => [
            '_' => 'البحث',
            'deleted' => 'شمل المناقشات المحذوفة',
            'mode' => 'نمط الخريطة',
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
        'unsaved' => ':count في هذه المراجعة',
    ],

    'reply' => [
        'open' => [
            'guest' => 'سجل الدخول للرد',
            'user' => 'رد',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max كتل مستخدمة',
        'go_to_parent' => 'مشاهدة منشور المراجعة',
        'go_to_child' => 'مشاهدة المناقشة',
        'validation' => [
            'block_too_large' => 'كل كتلة قد تحتوي فقط على ما يصل إلى :limit أحرف',
            'external_references' => 'المراجعة تحتوي إشارات إلى مشاكل لا تنتمي إلى هذه المراجعة',
            'invalid_block_type' => 'نوع كتلة غير صالح',
            'invalid_document' => 'مراجعة غير صالحة',
            'minimum_issues' => 'ألمراجعة يجب ان تحوي :count مشكلة على الأقل|المراجعة يجب ان تحوي :count مشاكل على الأقل',
            'missing_text' => 'الكتلة تفتقد للنص',
            'too_many_blocks' => 'المراجعة يمكن ان تحتوي :count فقرة\مشكلة فقط| المراجعة يمكن ان تحتوي على اكثر من :count فقرات\مشاكل',
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
