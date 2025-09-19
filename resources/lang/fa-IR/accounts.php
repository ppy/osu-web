<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'تنظیمات حساب',
        'username' => 'نام',

        'avatar' => [
            'title' => 'اکس پرفایل',
            'reset' => 'بازنشانی',
            'rules' => 'لطفا مطمئن شوید که تصویر نمایه شما به :link پایبند است.<br/>این بدین معنیست که باید <strong>برای تمامی سنین مناسب باشد</strong> یعنی بدون برهنگی ، فحاشی یا محتوای وسوسه انگیز.',
            'rules_link' => 'قانون ها',
        ],

        'email' => [
            'new' => 'ایمیل جدید',
            'new_confirmation' => 'تایید ایمیل',
            'title' => 'ایمیل',
            'locked' => [
                '_' => 'اگر میخواهید ایمیل خود را بروز کنید، لطفا با :accounts صحبت کنید.',
                'accounts' => 'تیم پشتیبانی حساب های کاربری',
            ],
        ],

        'legacy_api' => [
            'api' => 'واسط برنامه‌نویسی نرم‌افزار',
            'irc' => '',
            'title' => 'واسط برنامه‌نویسی نرم‌افزار قدیمی',
        ],

        'password' => [
            'current' => 'پسورد فعلی',
            'new' => 'پسورد جدید',
            'new_confirmation' => 'تایید کلمه عبور',
            'title' => 'پسورد',
        ],

        'profile' => [
            'country' => 'کشور',
            'title' => 'نمایه',

            'country_change' => [
                '_' => "بنظر میرسد که کشور ثبت شده حساب شما با کشور اقامت شما تطابق ندارد. :update_link.",
                'update_link' => 'بروز رسانی به :country',
            ],

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

    'github_user' => [
        'info' => "اگر در مخازن منبع باز osu مشارکت می کنید، با پیوند دادن حساب GitHub خود به اینجا، لاگ تغییرات شما به نمایه osu شما متصل می شود. نمایه حساب‌های GitHub که سابقه مشارکت در osu! ندارند را نمی توان پیوند داد.",
        'link' => 'پیوند دادن حساب GitHub',
        'title' => 'گیت‌هاب',
        'unlink' => 'لغو پیوند حساب GitHub',

        'error' => [
            'already_linked' => 'این حساب گیت‌هاب به نمایه شخص دیگری متصل شده است.',
            'no_contribution' => 'نمی توان حساب گیت‌هابی که سابقه کمک به مخازن osu! نداشته را متصل کرد.',
            'unverified_email' => 'لطفا اول ایمیل گیت‌هاب خود را وریفای کنید، بعد اکانتتان را لینک کنید.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'دریافت اعلانات مشکلات جدید در بیت مپ های واجد شرایط در نوع های زیر',
        'beatmapset_disqualify' => 'دریافت اعلانات برای وقتی که بیت مپ های نوع زیر، رد صلاحیت میشوند',
        'comment_reply' => 'دریافت اعلانات برای پاسخ ها به کامنت شما',
        'title' => 'علامت',
        'topic_auto_subscribe' => 'فعالسازی خودکار اعلانات برای موضوعات جدید انجمن که شما میسازید',

        'options' => [
            '_' => 'تنظیمات ارسال',
            'beatmap_owner_change' => 'درجه سختی میهمان',
            'beatmapset:modding' => 'مودینگ بیت مپ',
            'channel_message' => 'پیام های خصوصی چت',
            'channel_team' => '',
            'comment_new' => 'نظرات جدید',
            'forum_topic_reply' => 'پاسخ موضوع',
            'mail' => 'ایمیل',
            'mapping' => 'سازنده بیت مپ',
            'push' => 'اعلان push',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'کلاینت های تایید هویت شده',
        'own_clients' => 'کلاینت های شما',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'مخفی کردن هشدار ها برای محتوای نامناسب در بیت مپ ها',
        'beatmapset_title_show_original' => 'نمایش متادیتای بیت مپ ها در زبان اصلی',
        'title' => 'گزینه ها',

        'beatmapset_download' => [
            '_' => 'نوع پیشفرض دانلود بیت مپ ها',
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
