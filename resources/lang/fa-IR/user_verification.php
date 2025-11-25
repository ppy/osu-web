<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'یک ایمیل به :mail همراه کد تصدیق ارسال شد. آن کد را وارد کنید.',
        'title' => 'تایید حساب',
        'verifying' => 'در حال تایید...',
        'issuing' => 'در حال ارسال دوباره کد...',

        'info' => [
            'check_spam' => "اگر نمیتوانید ایمیل را پیدا کنید، پوشه ی هرزنامه های خود را هم برای اطمینان بررسی کنید.",
            'recover' => "اگر به ایمیل خود دسترسی ندارید یا نمیدانید از کدام استفاده کرده اید لطفا :link را دنبال کنید.",
            'recover_link' => 'روند بازیبابی ایمیل در اینجا',
            'reissue' => 'شما همچنین میتوانید :reissue_link یا :logout_link.',
            'reissue_link' => 'درخواست یک کد دیگر بدهید',
            'logout_link' => 'خارج شوید',
        ],
    ],

    'box_totp' => [
        'heading' => '',

        'info' => [
            'logout' => [
                '_' => '',
                'link' => '',
            ],
            'mail_fallback' => [
                '_' => '',
                'link' => '',
            ],
        ],
    ],

    'errors' => [
        'expired' => 'کد تصدیق منقضی شده است. ایمیل جدید ارسال شد.',
        'incorrect_key' => 'کد تایید نادرست است.',
        'retries_exceeded' => 'کد تایید نادرست است. به سقف بررسی مجدد رسیدید. ایمیل جدید ارسال شد.',
        'reissued' => 'کد تصدیق درخواست شده است. ایمیل جدید ارسال شد.',
        'totp_used_key' => '',
        'totp_gone' => '',
        'unknown' => 'خطای نامشخصی رخ داد. ایمیل دوباره ارسال شد.',
    ],
];
