<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'sent' => '一封包含驗證碼的郵件已經發送到 :mail ，請輸入該驗證碼。',
        'title' => '賬戶認證',
        'verifying' => '認證中',
        'issuing' => '正在生成新的驗證碼',

        'info' => [
            'check_spam' => '如果找不到這封郵件，請檢查垃圾箱。',
            'recover' => '無法登錄郵箱或者忘記了所使用的郵箱？:link.',
            'recover_link' => '點擊此處',
            'reissue' => '也可以 :reissue_link 或者 :logout_link.',
            'reissue_link' => '重發驗證碼',
            'logout_link' => '退出',
        ],
    ],

    'email' => [
        'subject' => 'osu! 賬戶認證',
    ],

    'errors' => [
        'expired' => '該驗證碼已經過期，新驗證碼已經重新發送。',
        'incorrect_key' => '驗證碼錯誤。',
        'retries_exceeded' => '驗證碼錯誤次數超過限定次數，新驗證碼已經重新發送。',
        'reissued' => '新驗證碼已經重新發送。',
        'unknown' => '發生了未知的錯誤，新驗證碼已經重新發送。',
    ],
];
