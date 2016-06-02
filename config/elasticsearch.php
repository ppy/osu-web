<?php


return [
    'hosts' => [env('ES_HOST', 'localhost:9200')],

    'index' => env('ES_INDEX', 'osu'),
];
