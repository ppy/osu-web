<?php

return [
    'notification_channel' => env('STORE_NOTIFICATION_CHANNEL'),
    'running_cost' => (int) presence(env('OSU_RUNNING_COST'), 3141592), // arbritary default >_>
    'sandbox' => get_bool(env('PAYMENT_SANDBOX')) ?? false,

    'centili' => [
        'api_key' => env('CENTILI_API_KEY'),
        'conversion_rate' => (float) presence(env('CENTILI_CONVERSION_RATE'), 100),
        'enabled' => get_bool(env('CENTILI_ENABLED')) ?? false,
        'secret_key' => env('CENTILI_SECRET_KEY'),
        'widget_url' => env('CENTILI_WIDGET_URL'),
    ],

    'paypal' => [
        'client_id' => env('PAYPAL_CLIENT_ID'),
        'client_secret' => env('PAYPAL_CLIENT_SECRET'),
        'merchant_id' => env('PAYPAL_MERCHANT_ID'),
        'url' => env('PAYPAL_URL'),

        'profiles' => [
            'no_shipping' => env('PAYPAL_NO_SHIPPING_EXPERIENCE_PROFILE_ID'),
        ],
    ],

    'shopify' => [
        'webhook_key' => env('SHOPIFY_WEBHOOK_KEY'),
    ],

    'xsolla' => [
        'api_key' => env('XSOLLA_API_KEY'),
        'merchant_id' => env('XSOLLA_MERCHANT_ID'),
        'project_id' => (int) env('XSOLLA_PROJECT_ID'),
        'secret_key' => env('XSOLLA_SECRET_KEY'),
    ],
];
