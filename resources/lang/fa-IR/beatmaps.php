<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_ruleset' => '',

    'change_owner' => [
        'too_many' => 'مپرهای مهمان بیش‌از حد زیادند.',
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'شکست در بروز کردن رای',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'مجاز کردن kudosu',
        'beatmap_information' => 'صفحه بیت مپ',
        'delete' => 'حذف',
        'deleted' => 'حذف شده توسط :editor در :delete_time.',
        'deny_kudosu' => 'غیرمجاز کردن kudosu',
        'edit' => 'ویرایش',
        'edited' => 'آخرین بار ویرایش شده توسط :editor در :update_time.',
        'guest' => 'درجه سختی میهمان توسط :user',
        'kudosu_denied' => 'منع شده از دریافت kudosu.',
        'message_placeholder_deleted_beatmap' => 'این درجه سختی پاک شده است و دیگر در مورد آن گفتگویی نمی شود.',
        'message_placeholder_locked' => 'گفتگو در مورد این بیت مپ غیرفعال شده است.',
        'message_placeholder_silenced' => "نمی توانید در حالتی که ساکت شده اید رای بدهید.",
        'message_type_select' => 'انتخاب حالت نظر',
        'reply_notice' => 'برای پاسخ اینتر بزنید.',
        'reply_resolve_notice' => 'برای ریپلای اینتر بزنید. برای ریپلای و بستن، کنترل+اینتر بزنید.',
        'reply_placeholder' => 'پاسخ خود را اینجا تایپ کنید',
        'require-login' => 'برای پست کردن یا پاسخ دادن وارد شوید',
        'resolved' => 'حل شده',
        'restore' => 'بازگردانی',
        'show_deleted' => 'نمایش پاک شده ها',
        'title' => 'گفتگو ها',
        'unresolved_count' => '',

        'collapse' => [
            'all-collapse' => 'جمع کردن همه',
            'all-expand' => 'باز کردن همه',
        ],

        'empty' => [
            'empty' => 'هیچ گفتگویی نیست هنوز!',
            'hidden' => 'هیچ گفتگویی با فیلتر انتخاب شده یافت نشد.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'قفل کردن گفتگو',
                'unlock' => 'باز کردن گفتگو',
            ],

            'prompt' => [
                'lock' => 'علت قفل کردن',
                'unlock' => 'آیا مطمئنید که میخواهید گفتگو را باز کنید؟',
            ],
        ],

        'message_hint' => [
            'in_general' => 'این پست به قسمت گفتگوی کلی بیت مپ ها میرود. برای ماد کردن این درجه ساختی، پیام را با مهرزمان آغاز کنید (مثلا 00:12:345).',
            'in_timeline' => '',
        ],

        'message_placeholder' => [
            'general' => '',
            'generalAll' => '',
            'review' => 'نظرتان را اینجا بنویسید',
            'timeline' => '',
        ],

        'message_type' => [
            'disqualify' => 'رد صلاحیت',
            'hype' => 'هایپ کردن!',
            'mapper_note' => 'یادداشت',
            'nomination_reset' => 'بازگردانی نامزدی',
            'praise' => 'تمجید',
            'problem' => 'مشکل',
            'problem_warning' => 'گزارش مشکل',
            'review' => 'بررسی',
            'suggestion' => 'پیشنهاد',
        ],

        'message_type_title' => [
            'disqualify' => 'ارسال دیسکوالیفای',
            'hype' => 'ارسال هایپ!',
            'mapper_note' => 'ارسال یادداشت',
            'nomination_reset' => 'حذف همهٔ قبولی‌ها',
            'praise' => 'ارسال تعریف',
            'problem' => 'ارسال مشکل',
            'problem_warning' => 'ارسال مشکل',
            'review' => 'ارسال نقد و بررسی',
            'suggestion' => 'ارسال پیشنهاد',
        ],

        'mode' => [
            'events' => 'تاریخچه',
            'general' => '',
            'reviews' => 'نقد و بررسی‌ها',
            'timeline' => 'تایم‌لاین',
            'scopes' => [
                'general' => 'این دیفیکالتی',
                'generalAll' => 'همهٔ دیفیکالتی‌ها',
            ],
        ],

        'new' => [
            'pin' => 'پین',
            'timestamp' => 'نشانگر تایم',
            'timestamp_missing' => 'برای نشون‌دادن تایم، موقع ادیت بیت‌مپ، کنترل C بزنید و اینجا پیست کنید!',
            'title' => 'مباحثهٔ جدید',
            'unpin' => 'آن‌پین',
        ],

        'review' => [
            'new' => 'نقد و بررسی جدید',
            'embed' => [
                'delete' => 'حذف',
                'missing' => '[مباحثه حذف شد]',
                'unlink' => 'آن‌لینک',
                'unsaved' => 'سیونشده',
                'timestamp' => [
                    'all-diff' => 'پست‌هایی که روی کل دیفیکالتی‌ها گذاشته میشن، نمی‌تونن نشانگر تایم داشته باشن.',
                    'diff' => 'اگه این پست با نشانگر تایم شروع بشه، زیر تایم‌لاین نمایش داده میشه.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'گذاشتن پاراگراف',
                'praise' => 'گذاشتن تعریف',
                'problem' => 'گذاشتن مشکل',
                'suggestion' => 'گذاشتن پیشنهاد',
            ],
        ],

        'show' => [
            'title' => '',
        ],

        'sort' => [
            'created_at' => 'زمان ایجاد',
            'timeline' => 'تایم‌لاین',
            'updated_at' => 'آخرین آپدیت',
        ],

        'stats' => [
            'deleted' => 'حذف شده',
            'mapper_notes' => 'یادداشت‌ها',
            'mine' => 'مال من',
            'pending' => 'منتظر تأیید',
            'praises' => 'تعریف‌ها',
            'resolved' => 'حل شده',
            'total' => '',
        ],

        'status-messages' => [
            'approved' => '',
            'graveyard' => "",
            'loved' => '',
            'ranked' => '',
            'wip' => '',
        ],

        'votes' => [
            'none' => [
                'down' => '',
                'up' => '',
            ],
            'latest' => [
                'down' => '',
                'up' => '',
            ],
        ],
    ],

    'hype' => [
        'button' => '',
        'button_done' => '',
        'confirm' => "",
        'explanation' => '',
        'explanation_guest' => '',
        'new_time' => "",
        'remaining' => '',
        'required_text' => '',
        'section_title' => '',
        'title' => '',
    ],

    'feedback' => [
        'button' => '',
    ],

    'nominations' => [
        'already_nominated' => '',
        'cannot_nominate' => '',
        'delete' => '',
        'delete_own_confirm' => '',
        'delete_other_confirm' => '',
        'disqualification_prompt' => '',
        'disqualified_at' => '',
        'disqualified_no_reason' => '',
        'disqualify' => '',
        'incorrect_state' => '',
        'love' => '',
        'love_choose' => '',
        'love_confirm' => '',
        'nominate' => '',
        'nominate_confirm' => '',
        'nominated_by' => '',
        'not_enough_hype' => "هایپ کافی نیست.",
        'remove_from_loved' => 'حذف‌کردن از Loved',
        'remove_from_loved_prompt' => 'دلیل حذف‌کردن از Loved:',
        'required_text' => 'تأییدها: :current/:required',
        'reset_message_deleted' => 'حذف شده',
        'title' => 'وضعیت تأیید',
        'unresolved_issues' => 'هنوز مشکلات حل‌نشده ای هستند که اول باید به آنها رسیدگی شود.',

        'rank_estimate' => [
            '_' => 'اگه مشکلی پیدا نشه، این مپ تقریبا در تاریخ :date رنکد میشه. شمارهٔ #:position در :queue.',
            'unresolved_problems' => 'این مپ نمی‌تونه از حالت کوالیفای خارج شه، تا وقتی :problems حل بشن.',
            'problems' => 'این مشکلات',
            'on' => 'در روز :date',
            'queue' => 'صف رنکد شدن',
            'soon' => 'بزودی',
        ],

        'reset_at' => [
            'nomination_reset' => 'با مشکل جدید :discussion، پروسهٔ تأیید :time_ago توسط :user ریست شد. (:message).',
            'disqualify' => 'با مشکل جدید :discussion، توسط :user در :time_ago دیس‌کوالیفای شد. (:message). ',
        ],

        'reset_confirm' => [
            'disqualify' => 'مطمئنی؟ این کار باعث حذف بیت‌مپ از کوالیفای، و ریست‌شدن پروسهٔ تأیید میشه.',
            'nomination_reset' => 'مطمئنی؟ گذاشتن مشکل جدید باعث ریست‌شدن پروسهٔ تأیید میشه.',
            'problem_warning' => 'آیا مطمئنید که میخواهید یک ایراد در بیت مپ را گزارش کنید؟ این برای نامزد کننده های بیت مپ یک هشدار ارسال می کند.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'جستجو...',
            'login_required' => 'برای سرچ‌کردن، لاگین کنید.',
            'options' => 'تنظیمات بیشتر',
            'rank_filter_note' => '',
            'supporter_filter' => 'صافی‌کردن با :filters نیازمند تگ osu!supporter فعال است',
            'not-found' => 'نتیجه ای یافت نشد',
            'not-found-quote' => '... نچ. هیچی پیدا نکردم.',
            'filters' => [
                'extra' => 'دیگر',
                'general' => 'کلیات',
                'genre' => 'ژانر',
                'language' => 'زبان',
                'mode' => 'مود',
                'nsfw' => 'محتوای نامناسب',
                'played' => 'قبلاً بازی کردم',
                'rank' => 'رنک کسب‌شده',
                'status' => 'دسته‌بندی‌ها',
            ],
            'sorting' => [
                'title' => 'عنوان',
                'artist' => 'آرتیست',
                'difficulty' => 'دیفیکالتی',
                'favourites' => 'علاقه‌مندی‌ها',
                'updated' => 'آپدیت‌شده',
                'ranked' => 'رنکد شده',
                'rating' => 'ارزیابی',
                'plays' => 'تعداد پلی',
                'relevance' => 'مرتبط بودن',
                'nominations' => 'تأییدها',
            ],
            'supporter_filter_quote' => [
                '_' => 'صافی کردن با :filters نیازمند :link فعال است',
                'link_text' => 'تگ osu!supporter',
            ],
        ],
    ],
    'general' => [
        'converts' => 'بیت‌مپ‌های تبدیل‌شده',
        'featured_artists' => 'آرتیست‌های ویژه',
        'follows' => 'مپ‌سازهای دنبال‌شده',
        'recommended' => 'دیفیکالتی پیشنهادی',
        'spotlights' => 'بیت‌مپ‌های Spotlight',
    ],
    'mode' => [
        'all' => 'همه',
        'any' => '',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
        'undefined' => '',
    ],
    'status' => [
        'any' => '',
        'approved' => '',
        'favourites' => '',
        'graveyard' => '',
        'leaderboard' => '',
        'loved' => '',
        'mine' => '',
        'pending' => '',
        'wip' => 'در حال کار',
        'qualified' => '',
        'ranked' => '',
    ],
    'genre' => [
        'any' => '',
        'unspecified' => '',
        'video-game' => '',
        'anime' => '',
        'rock' => '',
        'pop' => '',
        'other' => '',
        'novelty' => '',
        'hip-hop' => '',
        'electronic' => '',
        'metal' => '',
        'classical' => '',
        'folk' => '',
        'jazz' => '',
    ],
    'language' => [
        'any' => '',
        'english' => '',
        'chinese' => '',
        'french' => '',
        'german' => '',
        'italian' => '',
        'japanese' => '',
        'korean' => '',
        'spanish' => '',
        'swedish' => '',
        'russian' => '',
        'polish' => '',
        'instrumental' => '',
        'other' => '',
        'unspecified' => '',
    ],

    'nsfw' => [
        'exclude' => '',
        'include' => '',
    ],

    'played' => [
        'any' => '',
        'played' => '',
        'unplayed' => '',
    ],
    'extra' => [
        'video' => '',
        'storyboard' => '',
    ],
    'rank' => [
        'any' => '',
        'XH' => '',
        'X' => '',
        'SH' => 'Silver S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'تعداد پلی: :count',
        'favourites' => 'پسندیدن‌ها: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'همه',
        ],
    ],
];
