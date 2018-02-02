<?php

return [
    'order' => [
        'prefix' => presence(env('STORE_ORDER_PREFIX'), 'store'),
    ],
    'queue' => [
        'notifications' => presence(env('STORE_NOTIFICATIONS_QUEUE'), 'store-notifications'),
    ],
];
