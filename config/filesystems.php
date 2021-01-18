<?php

foreach (['osu', 'taiko', 'fruits', 'mania'] as $mode) {
    $replays[$mode] = [
        'local' => [
            'driver' => 'local',
            'root' => public_path().'/uploads-replay/'.$mode,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('S3_KEY'),
            'secret' => env('S3_SECRET'),
            'region' => env('S3_REGION'),
            'bucket' => "replay-{$mode}",
        ],
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
        'replays' => $replays,

        'local' => [
            'driver' => 'local',
            'root' => public_path().'/uploads',
            'base_url' => env('APP_URL', 'http://localhost').'/uploads',
        ],

        'local-avatar' => [
            'driver' => 'local',
            'root' => public_path().'/uploads-avatar',
            'base_url' => env('APP_URL', 'http://localhost').'/uploads-avatar',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('S3_KEY'),
            'secret' => env('S3_SECRET'),
            'region' => env('S3_REGION'),
            'bucket' => env('S3_BUCKET'),
            'base_url' => env('S3_BASE_URL'),
            'mini_url' => env('S3_MINI_URL') ?? env('S3_BASE_URL'),
        ],

        's3-avatar' => [
            'driver' => 's3',
            'key' => env('S3_AVATAR_KEY'),
            'secret' => env('S3_AVATAR_SECRET'),
            'region' => env('S3_AVATAR_REGION'),
            'bucket' => env('S3_AVATAR_BUCKET'),
            'base_url' => env('S3_AVATAR_BASE_URL'),
        ],
    ],

];
