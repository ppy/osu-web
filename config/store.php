<?php

return [
    'invoice' => [
        'max_copies' => get_int(env('STORE_INVOICE_MAX_COPIES')) ?? 10,
    ],
    'mail' => [
        'donation_thanks' => [
            'sender_address' => env('STORE_THANKS_SENDER_ADDRESS', 'osu@ppy.sh'),
            'sender_name' => env('STORE_THANKS_SENDER_NAME', 'osu!'),
        ],
    ],
    'order' => [
        'prefix' => presence(env('STORE_ORDER_PREFIX'), 'store'),
        'stale_days' => get_int(env('STORE_STALE_DAYS')) ?? 14,
    ],
    'queue' => [
        'notifications' => presence(env('STORE_NOTIFICATIONS_QUEUE'), 'store-notifications'),
    ],
];
