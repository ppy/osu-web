<?php


return [
    'hosts' => (array) env('ES_HOST', 'localhost:9200'),
    'index' => [
        'beatmaps' => 'beatmaps',
        'posts' => 'posts',
        'users' => 'users',
        'wiki_pages' => 'osu:wiki_pages_20171130'
    ]
];
