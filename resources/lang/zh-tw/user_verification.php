<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => '一封包含驗證碼的電子郵件已經傳送到 :mail ，請輸入該驗證碼。',
        'title' => '帳號驗證',
        'verifying' => '驗證中...',
        'issuing' => '正在產生新的驗證碼',

        'info' => [
            'check_spam' => "如果找不到電子郵件，請檢查垃圾郵件箱。",
            'recover' => "如果您無法登入電子郵件或忘記電子郵件, 請點選 :link。",
            'recover_link' => '由此找回電子郵件',
            'reissue' => '也可以 :reissue_link 或者 :logout_link.',
            'reissue_link' => '重發驗證碼',
            'logout_link' => '登出',
        ],
    ],

    'box_totp' => [
        'heading' => '請輸入您驗證器應用程式中的代碼。',

        'info' => [
            'logout' => [
                '_' => '您也可以 :link 。',
                'link' => '登出',
            ],
            'mail_fallback' => [
                '_' => '如果您無法使用應用程式， :link 。',
                'link' => '您也可以使用電子郵件驗證',
            ],
        ],
    ],

    'errors' => [
        'expired' => '該驗證碼已經過期，新驗證碼已經重新發送。',
        'incorrect_key' => '驗證碼錯誤。',
        'retries_exceeded' => '驗證碼錯誤次數超過限制次數，新驗證碼已經重新發送。',
        'reissued' => '新驗證碼已經重新發送。',
        'totp_used_key' => '驗證代碼已被使用。請等待並使用新的代碼。',
        'totp_gone' => '驗證密鑰已被移除，將使用電子郵件驗證。驗證碼已傳送。',
        'unknown' => '發生了未知的錯誤，新驗證碼已經重新發送。',
    ],
];
