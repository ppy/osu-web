<?php

return [
    'invoice' => [
        'max_copies' => get_int(env('STORE_INVOICE_MAX_COPIES')) ?? 10,
    ],
    'order' => [
        'prefix' => presence(env('STORE_ORDER_PREFIX'), 'store'),
    ],
    'queue' => [
        'notifications' => presence(env('STORE_NOTIFICATIONS_QUEUE'), 'store-notifications'),
    ],
];
