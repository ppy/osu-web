<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'beatmapset_update_notice' => [
        'new' => '只是讓您知道自從您上次訪問以來，圖譜「:title」中有了新的更新。',
        'subject' => '圖譜“:title”有更新',
        'unwatch' => '如果您不想再關注這張圖譜的話，可以點擊 “取消關注” 鏈接在頁面的下方，或者在摸圖關注頁面中：',
        'visit' => '訪問這裡的討論頁面：',
    ],

    'common' => [
        'closing' => '祝順，',
        'hello' => '嗨 :user,',
        'report' => '如果您沒有進行此項操作，請「立刻」回覆此信件!',
    ],

    'donation_thanks' => [
        'benefit_more' => '將來還會有更多贊助者獨享的功能!',
        'feedback' => "如果您有任何問題或建議，請直接回覆這封郵件。我會盡快回復的！",
        'keep_free' => '多虧了像您這樣的人，讓 osu! 能夠在沒有任何廣告或強制付費的情況下保持遊戲和社群的順利運行。',
        'keep_running' => '您的支持可讓 osu! 持續運行大概 :minutes！雖然看起來沒有太多，但有大家的支持會更長久 :)。',
        'subject' => '非常感謝，osu! 愛你哦~',
        'translation' => '以下為社群提供的翻譯，僅供參考:',

        'benefit' => [
            'gift' => '您的收禮者現在可以使用 osu!direct 和許多其他支持者獨享的福利。',
            'self' => '您可以在接下來的 :duration 內享受 osu!direct 和其他 osu! 支持者享有的特權。',
        ],

        'support' => [
            '_' => '感謝您向 osu! 捐贈的 :support !',
            'first' => '支援',
            'repeat' => '持續支持',
        ],
    ],

    'forum_new_reply' => [
        'new' => '只是讓您知道自從您上次訪問以來，「:title」中有了新的更新。',
        'subject' => '[osu!] 主題 ":title" 有新回覆',
        'unwatch' => '',
        'visit' => '使用以下連結跳到最新回覆：',
    ],

    'password_reset' => [
        'code' => '您的驗證碼是:',
        'requested' => '您或者其他冒充您的人要求重設您的osu!帳號的密碼。',
        'subject' => 'osu! 帳戶恢復',
    ],

    'store_payment_completed' => [
        'prepare_shipping' => '我們已經收到了您的付款，並且正在為訂單出貨。根據訂單的數量，我們可能需要幾天時間，您可以在這裡追蹤您的訂單進度包括配送細節：',
        'processing' => '我們已收到您的付款，並正在處理您的訂單，您可以在這裡追蹤您的訂單進度:',
        'questions' => "如果您有任何問題，不要猶豫，請直接回覆這封郵件。",
        'shipping' => '配送',
        'subject' => '我們已收到您的 osu!商店 訂單！',
        'thank_you' => '感謝您在osu!store的購買',
        'total' => '合計',
    ],

    'supporter_gift' => [
        'anonymous_gift' => '贈送您贊助者標籤的人想要保持匿名，所以在這則通知中並沒有提到他(們)。',
        'anonymous_gift_maybe_not' => '但您可能已經知道它是誰 ; )。',
        'duration' => '因為他們，您可以在接下來的 :duration 內享受 osu!direct 和其他 osu! 支持者享有的特權。',
        'features' => '您可以在此處找到這些功能的更多資訊：',
        'gifted' => '有人剛剛送給你了一份osu!贊助者標籤!',
        'subject' => '您已獲贈 osu!supporter 標籤！',
    ],

    'user_email_updated' => [
        'changed_to' => '提醒您，您的osu!電子信箱已被更改為:email',
        'check' => '為了防止將來無法取存取您的osu!帳戶，請確保您已在新的電子信箱收到本電子郵件。',
        'sent' => '為了確保帳號安全，我們已將此郵件發送至您的原信箱和修改後的信箱',
        'subject' => 'osu! 帳號電子郵件變更',
    ],

    'user_force_reactivation' => [
        'main' => '由於近期您的帳號有可疑的行爲或者使用了太弱的密碼，已被暫時停用。因此我們需要您設定一個新的密碼。請確保使用足夠強的密碼。',
        'perform_reset' => '您可以點擊此連結來重設密碼:url',
        'reason' => '原因:',
        'subject' => '您需要重新驗證您的 osu! 帳戶',
    ],

    'user_notification_digest' => [
        'new' => '只是想提醒您，您追蹤的項目有新的更新',
        'settings' => '更改電子郵件通知設定：',
        'subject' => '新的 osu! 通知',
    ],

    'user_password_updated' => [
        'confirmation' => '提醒您，您的osu!密碼已被修改',
        'subject' => 'osu! 帳號密碼變更',
    ],

    'user_verification' => [
        'code' => '您的驗證碼是:',
        'code_hint' => '你可以帶或不帶空格地輸入該驗證碼',
        'link' => '或者，你也可以點擊下列連結以完成認證:',
        'report' => '如果您並沒有進行此項操作，請「立刻」回覆此信件，您的帳戶可能有危險。',
        'subject' => 'osu! 帳號驗證',

        'action_from' => [
            '_' => '有一項來自 :country 對您的帳戶所執行的操作需要認證',
            'unknown_country' => '未知國家',
        ],
    ],
];
