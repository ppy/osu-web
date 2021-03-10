<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => '電子郵件已發送到: 該電子郵件包含驗證碼。請輸入驗證碼。',
        'title' => '帳號驗證',
        'verifying' => '驗證中...',
        'issuing' => '正在產生新的驗證碼',

        'info' => [
            'check_spam' => "如果找不到電子郵件，請檢查垃圾郵件箱。",
            'recover' => "如果您無法登入電子郵件或忘記電子郵件, 請點選 :link。",
            'recover_link' => '電子郵件復原點擊此處',
            'reissue' => '也可以 :reissue_link 或者 :logout_link.',
            'reissue_link' => '重發驗證碼',
            'logout_link' => '登出',
        ],
    ],

    'errors' => [
        'expired' => '該驗證碼已經過期，新驗證碼已經重新發送。',
        'incorrect_key' => '驗證碼錯誤。',
        'retries_exceeded' => '驗證碼連續輸入錯誤超過次數，新驗證碼已經重新發送。',
        'reissued' => '新驗證碼已經重新發送。',
        'unknown' => '發生了未知的錯誤，新驗證碼已經重新發送。',
    ],
];
