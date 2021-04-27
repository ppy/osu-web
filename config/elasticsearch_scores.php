<?php

return [
    'hosts' => (array) env('ES_SCORES_HOST', 'localhost:9200'),
    'connectionParams' => [
        'client' => [
            'timeout' => get_float(env('ES_CLIENT_TIMEOUT')) ?? 5,
            'connect_timeout' => get_float(env('ES_CLIENT_CONNECT_TIMEOUT')) ?? 0.5,
        ],
    ],
    'connectionPool' => ['\Elasticsearch\ConnectionPool\SimpleConnectionPool'],
];
