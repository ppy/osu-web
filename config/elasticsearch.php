<?php

declare(strict_types=1);

use Elasticsearch\ConnectionPool\SimpleConnectionPool;

$defaults = [
    'connectionParams' => [
        'client' => [
            'timeout' => get_float(env('ES_CLIENT_TIMEOUT')) ?? 5,
            'connect_timeout' => get_float(env('ES_CLIENT_CONNECT_TIMEOUT')) ?? 0.5,
        ],
    ],
    'connectionPool' => [SimpleConnectionPool::class],
];

$defaultsSlow = $defaults;
$defaultsSlow['connectionParams']['client']['timeout'] = get_float(env('ES_SLOW_CLIENT_TIMEOUT')) ?? 60;

$parseHosts = fn ($envName) => explode(' ', presence(env($envName)) ?? 'localhost:9200');

return [
    'connections' => [
        'default' => array_merge($defaults, [
            'hosts' => $parseHosts('ES_HOST'),
        ]),
        'solo_scores' => array_merge($defaults, [
            'hosts' => $parseHosts('ES_SOLO_SCORES_HOST'),
        ]),
        'scores_slow' => [
            ...$defaultsSlow,
            'hosts' => $parseHosts('ES_SOLO_SCORES_HOST'),
        ],
    ],
];
