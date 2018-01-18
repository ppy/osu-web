<?php


return [
    'hosts' => (array) env('ES_HOST', 'localhost:9200'),

    'search_timeout' => get_int(env('ES_SEARCH_TIMEOUT')) ?? 5,
    'search_connect_timeout' => get_int(env('ES_SEARCH_CONNECT_TIMEOUT')) ?? 1,
];
