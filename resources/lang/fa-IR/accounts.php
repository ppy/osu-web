<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'تنظیمات حساب',
        'username' => 'نام',

        'avatar' => [
            'title' => 'اکس پرفایل',
            'rules' => 'لطفا مطمئن شوید که تصویر نمایه شما به :link پایبند است.<br/>این بدین معنیست که باید <strong>برای تمامی سنین مناسب باشد</strong> یعنی بدون برهنگی ، فحاشی یا محتوای وسوسه انگیز.',
            'rules_link' => 'قانون ها',
        ],

        'email' => [
            'current' => 'ایمیل فعلی',
            'new' => 'ایمیل جدید',
            'new_confirmation' => 'تایید ایمیل',
            'title' => 'ایمیل',
        ],

        'password' => [
            'current' => 'پسورد فعلی',
            'new' => 'پسورد جدید',
            'new_confirmation' => 'تایید رمز عبور',
            'title' => 'پسورد',
        ],

        'profile' => [
            'title' => 'نمایه',

            'user' => [
                'user_discord' => '',
                'user_from' => 'موقعیت فعلی',
                'user_interests' => 'علاقمندی ها',
                'user_occ' => 'شغل',
                'user_twitter' => '',
                'user_website' => 'وب سایت',
            ],
        ],

        'signature' => [
            'title' => 'امضا',
            'update' => 'بروز کردن',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'دریافت اعلانات مشکلات جدید در بیتمپ های واجد شرایط در نوع های زیر',
        'beatmapset_disqualify' => 'دریافت اعلانات برای وقتی که بیتمپ های نوع زیر، رد صلاحیت میشوند',
        'comment_reply' => 'دریافت اعلانات برای پاسخ ها به کامنت شما',
        'title' => 'علامت',
        'topic_auto_subscribe' => 'فعالسازی خودکار اعلانات برای موضوعات جدید انجمن که شما میسازید',

        'options' => [
            '_' => 'تنظیمات ارسال',
            'beatmap_owner_change' => '',
            'beatmapset:modding' => 'مادینگ بیتمپ',
            'channel_message' => 'پیام های خصوصی چت',
            'comment_new' => 'نظرات جدید',
            'forum_topic_reply' => 'پاسخ موضوع',
            'mail' => 'ایمیل',
            'mapping' => 'مپر بیتمپ',
            'push' => '',
            'user_achievement_unlock' => 'مدال کاربر باز شد',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'کلاینت های تایید هویت شده',
        'own_clients' => 'کلاینت های شما',
        'title' => '',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'مخفی کردن هشدار ها برای محتوای نامناسب در بیتمپ ها',
        'beatmapset_title_show_original' => 'نمایش متادیتای بیتمپ ها در زبان اصلی',
        'title' => 'گزینه ها',

        'beatmapset_download' => [
            '_' => 'نوع پیشفرض دانلود بیتمپ ها',
            'all' => 'همراه با ویدیو اگر موجود باشد',
            'direct' => 'با osu!direct باز کن',
            'no_video' => 'بدون فیلم',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'صفحه کلید',
        'mouse' => 'ماوس',
        'tablet' => 'تبلت',
        'title' => 'مد بازی',
        'touch' => 'صفحه لمسی',
    ],

    'privacy' => [
        'friends_only' => 'مسدود کردن پیام های خصوصی از کسانی که در لیست دوستان شما نیستند',
        'hide_online' => 'مخفی کردن وضعیت آنلاین شما',
        'title' => 'حریم خصوصی',
    ],

    'security' => [
        'current_session' => 'نشست فعلی',
        'end_session' => 'پایان نشست',
        'end_session_confirmation' => 'این کار بلافاصله نشست شما را در آن دستگاه پایان می دهد. آیا مطمئنید؟',
        'last_active' => 'آخرین فعالیت:',
        'title' => 'امنیت',
        'web_sessions' => 'نشست های وب',
    ],

    'update_email' => [
        'update' => 'بروزرسانی',
    ],

    'update_password' => [
        'update' => 'بروزرسانی',
    ],

    'verification_completed' => [
        'text' => 'شما میتوانید هم اکنون این پنجره/تب را ببندید',
        'title' => 'تصدیق انجام شد',
    ],

    'verification_invalid' => [
        'title' => 'لینک نادرست یا منقضی شده تصدیق',
    ],
];
