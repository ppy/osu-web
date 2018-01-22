<?php


return [
    'hosts' => (array) env('ES_HOST', 'localhost:9200'),
    'connectionParams' => [
        'client' => [
            'timeout' => get_float(env('ES_SEARCH_TIMEOUT')) ?? 5,
            'connect_timeout' => get_float(env('ES_SEARCH_CONNECT_TIMEOUT')) ?? 0.5,
        ],
    ],
];
