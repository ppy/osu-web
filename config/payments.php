<?php

return [
    'centili' => [
        'api_key' => env('CENTILI_API_KEY'),
        'secret_key' => env('CENTILI_SECRET_KEY'),
        'conversion_rate' => (float) presence(env('CENTILI_CONVERSION_RATE'), 100),
        'widget_url' => env('CENTILI_WIDGET_URL'),
    ],
    'paypal' => [
        'client_id' => env('PAYPAL_CLIENT_ID'),
        'client_secret' => env('PAYPAL_CLIENT_SECRET'),
        'url' => env('PAYPAL_URL'),
        'merchant_id' => env('PAYPAL_MERCHANT_ID'),
    ],
    'xsolla' => [
        'api_key' => env('XSOLLA_API_KEY'),
        'merchant_id' => env('XSOLLA_MERCHANT_ID'),
        'project_id' => (int) env('XSOLLA_PROJECT_ID'),
        'secret_key' => env('XSOLLA_SECRET_KEY'),
    ],

    'sandbox' => presence(env('PAYMENT_SANDBOX'), false),
    'running_cost' => (int) presence(env('OSU_RUNNING_COST'), 3141592), // arbritary default >_>
];
