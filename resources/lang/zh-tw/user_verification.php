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
    'box' => [
        'sent' => '電子郵件已發送到: 該電子郵件包含驗證碼。請輸入驗證碼。',
        'title' => '帳號驗證',
        'verifying' => '驗證中...',
        'issuing' => '正在產生新的驗證碼',

        'info' => [
            'check_spam' => "如果找不到電子郵件，請檢查垃圾郵件箱。",
            'recover' => "如果您無法登入電子郵件或忘記電子郵件, 請點選: 連結。",
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
