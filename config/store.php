<?php

return [
    'order' => [
        'prefix' => presence(env('STORE_ORDER_PREFIX'), 'store'),
    ],

    // list of specific product ids to link to.
    'product_ids' => [
        'supporter_tag' => (int) env('STORE_SUPPORTER_TAG_ID'),
    ],
];
