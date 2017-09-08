<?php

return [
    'centili' => [
        'api_key' => env('CENTILI_API_KEY'),
        'secret_key' => env('CENTILI_SECRET_KEY'),
        'conversion_rate' => (float) (presence(env('CENTILI_CONVERSION_RATE')) ?? 100),
        'widget_url' => env('CENTILI_WIDGET_URL'),
    ],
    'paypal' => [
        'url' => env('PAYPAL_URL'),
        'merchant_id' => env('PAYPAL_MERCHANT_ID'),
    ],
    'xsolla' => [
        'api_key' => env('XSOLLA_API_KEY'),
        'merchant_id' => env('XSOLLA_MERCHANT_ID'),
        'project_id' => (int) env('XSOLLA_PROJECT_ID'),
        'secret_key' => env('XSOLLA_SECRET_KEY'),
    ],

    'running_cost' => (int) (presence(env('OSU_RUNNING_COST')) ?? 3141592), // arbritary default >_>
];
