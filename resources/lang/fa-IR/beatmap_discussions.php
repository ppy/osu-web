<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'برای ویرایش باید وارد شده باشید.',
            'system_generated' => 'پست هایی که توسط سیستم ساخته شده اند قابل ویرایش نیستند.',
            'wrong_user' => 'برای ویرایش پست باید صاحب آن باشید.',
        ],
    ],

    'events' => [
        'empty' => 'هنوز چیزی رخ نداده است.',
    ],

    'index' => [
        'deleted_beatmap' => 'حذف شده',
        'none_found' => 'هیچ گفتگویی منطبق با جستجوی شما یافت نشد.',
        'title' => 'گفتگو در مورد بیت مپ',

        'form' => [
            '_' => 'جستجو',
            'deleted' => 'شامل شدن گفتگو های پاک شده',
            'mode' => 'حالت بیت مپ',
            'only_unresolved' => 'فقط نمایش گفتگو های حل نشده',
            'types' => 'نوع پیام',
            'username' => 'نام کاربری',

            'beatmapset_status' => [
                '_' => 'وضعیت بیت مپ',
                'all' => 'همه',
                'disqualified' => 'رد صلاحیت',
                'never_qualified' => 'هیچوقت واجد شرایط نشده',
                'qualified' => 'واجد شرايط',
                'ranked' => 'رنک شده',
            ],

            'user' => [
                'label' => 'کاربر',
                'overview' => 'مرور فعالیت ها',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'تاریخ مطلب',
        'deleted_at' => 'تاریخ حذف',
        'message_type' => 'نوع',
        'permalink' => 'پیوند ثابت',
    ],

    'nearby_posts' => [
        'confirm' => 'هیچکدام از این مطالب مشکل من را حل نکرد',
        'notice' => 'پست هایی (:existing_timestamps ) حوالی :timestamp وجود دارند. لطفا قبل از پست کردن آنها را بررسی کنید.',
        'unsaved' => ':count در این بازدید',
    ],

    'owner_editor' => [
        'button' => 'صاحب درجه سختی',
        'reset_confirm' => 'بازنشانی صاحب این درجه سختی؟',
        'user' => 'صاحب',
        'version' => 'درجه سختی',
    ],

    'reply' => [
        'open' => [
            'guest' => 'برای پاسخ دادن وارد شوید',
            'user' => 'پاسخ',
        ],
    ],

    'review' => [
        'block_count' => ':used از :max بلاک استفاده شده',
        'go_to_parent' => 'نمایش پست بررسی',
        'go_to_child' => 'نمایش بخش گفتگو',
        'validation' => [
            'block_too_large' => 'هر قسمت میتواند تا :limit کلمه را شامل شود',
            'external_references' => 'بررسی شامل ارجاعاتی است که به این پست تعلق ندارند',
            'invalid_block_type' => 'نوع قسمت نامعتبر',
            'invalid_document' => 'بررسی نامعتبر',
            'invalid_discussion_type' => 'نوع گفتگو نامعتبر',
            'minimum_issues' => 'بررسی باید حداقل شامل :count مشکل شود|بررسی باید حداقل شامل :count مشکل شود',
            'missing_text' => 'این قسمت متنی ندارد',
            'too_many_blocks' => 'مرور ها باید :count پاراگراف یا مسئله داشته باشند|مرور ها باید حداکثر :count پاراگراف / مسئله داشته باشند',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'توسط :user حل شده در نظر گرفته شد',
            'false' => 'پاسخ داده شده توسط :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'عمومی',
        'general_all' => 'عمومی (همه)',
    ],

    'user_filter' => [
        'everyone' => 'همه',
        'label' => 'فیلتر بر اساس کاربر',
    ],
];
