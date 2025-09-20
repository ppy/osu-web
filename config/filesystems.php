<?php

$appUrl = env('APP_URL', 'http://localhost');

$s3Default = [
    'bucket' => env('S3_BUCKET'),
    'driver' => 's3',
    'endpoint' => env('S3_ENDPOINT'),
    'key' => env('S3_KEY'),
    'region' => env('S3_REGION'),
    'secret' => env('S3_SECRET'),
    'use_path_style_endpoint' => get_bool(env('S3_USE_PATH_STYLE_ENDPOINT')) ?? false,
];

$replays = [];
foreach (['osu', 'taiko', 'fruits', 'mania'] as $mode) {
    $replays["local-legacy-replay-{$mode}"] = [
        'driver' => 'local',
        'root' => public_path("uploads/legacy-replay/{$mode}"),
        'visibility' => 'public',
    ];

    $replays["s3-legacy-replay-{$mode}"] = [
        ...$s3Default,
        'bucket' => "replay-{$mode}",
    ];
}

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. A "local" driver, as well as a variety of cloud
    | based drivers are available for your choosing. Just store away!
    |
    | Supported: "local", "s3", "rackspace"
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => 's3',

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    */

    'disks' => [
        ...$replays,

        'local' => [
            'driver' => 'local',
            'root' => public_path('uploads/default'),
            'base_url' => "{$appUrl}/uploads/default",
            'visibility' => 'public',
        ],

        'local-avatar' => [
            'driver' => 'local',
            'root' => public_path('uploads/avatar'),
            'base_url' => "{$appUrl}/uploads/avatar",
            'visibility' => 'public',
        ],

        'local-central' => [
            'driver' => 'local',
            'root' => public_path('/uploads/central'),
            'base_url' => "{$appUrl}/uploads/central",
        ],

        'local-solo-replay' => [
            'driver' => 'local',
            'root' => public_path('uploads/solo-replay'),
            'base_url' => "{$appUrl}/uploads/solo-replay",
            'visibility' => 'public',
        ],

        's3' => [
            ...$s3Default,
            'base_url' => env('S3_BASE_URL'),
            'mini_url' => env('S3_MINI_URL') ?? env('S3_BASE_URL'),
        ],

        's3-avatar' => [
            ...$s3Default,
            'base_url' => env('S3_AVATAR_BASE_URL'),
            'bucket' => env('S3_AVATAR_BUCKET'),
            'key' => env('S3_AVATAR_KEY'),
            'region' => env('S3_AVATAR_REGION'),
            'secret' => env('S3_AVATAR_SECRET'),
        ],

        's3-central' => [
            ...$s3Default,
            'bucket' => env('S3_CENTRAL_BUCKET_NAME'),
            'region' => env('S3_CENTRAL_BUCKET_REGION'),
        ],

        's3-solo-replay' => [
            ...$s3Default,
            'bucket' => presence(env('S3_SOLO_REPLAY_BUCKET')) ?? 'solo-scores-replays',
        ],
    ],

];
