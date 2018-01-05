<?php


return [
    'hosts' => (array) env('ES_HOST', 'localhost:9200'),
    'index' => [
        'beatmaps' => App\Models\Beatmapset::esIndexName(),
        'posts' => App\Models\Forum\Post::esIndexName(),
        'users' => App\Models\User::esIndexName(),
        'wiki_pages' => 'osu:wiki_pages_20171130'
    ]
];
