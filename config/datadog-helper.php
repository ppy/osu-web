<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Datadog Tracking Enabled
    |--------------------------------------------------------------------------
    |
    | Set this option to enable or disable the datadog helper.
    |
    */
    'enabled' => env('DATADOG_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Datadog Tracking Prefix
    |--------------------------------------------------------------------------
    |
    | This is the prefix that will be placed in front of all of your metric entries. If you have multiple
    | applications being tracked in Datadog, it is recommended putting the application name somewhere
    | inside of your prefix. A common naming scheme is something like app.<app-name>.
    |
    */
    'prefix' => '',
    'prefix_web' => env('DATADOG_PREFIX', 'osu.web'), // different key to revert to manually prefixed tags
    'api_key' => env('DATADOG_API_KEY'),
    'application_key' => env('DATADOG_APP_KEY'),
    'datadog_host' => env('DATADOG_HOST', 'https://app.datadoghq.com'),
    'statsd_server' => env('DATADOG_STATSD_HOST', 'localhost'),
    'statsd_port' => env('DATADOG_STATSD_PORT', 8125),
    'statsd_socket_path' => env('DATADOG_STATSD_SOCKET'),
    'global_tags' => [],
    'max_buffer_length' => 1,
    'middleware_disable_url_tag' => true,
];
