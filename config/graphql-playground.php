<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Route configuration
    |--------------------------------------------------------------------------
    |
    | Set the URI at which the GraphQL Playground can be viewed
    | and any additional configuration for the route.
    |
    */

    'route' => [
        'uri' => '/graphql-playground',
        'name' => 'graphql-playground',
        // 'middleware' => ['web']
        // 'prefix' => '',
        // 'domain' => 'graphql.' . env('APP_DOMAIN', 'localhost'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Default GraphQL endpoint
    |--------------------------------------------------------------------------
    |
    | The default endpoint that the Playground UI is set to.
    | It assumes you are running GraphQL on the same domain
    | as GraphQL Playground, but can be set to any URL.
    |
    */

    'endpoint' => '/graphql',

    /*
    |--------------------------------------------------------------------------
    | Subscription endpoint
    |--------------------------------------------------------------------------
    |
    | The default subscription endpoint Playground UI uses to connect to.
    | Tries to connect to the `endpoint` value if `null` as ws://{{endpoint}}
    |
    | Example: `ws://your-endpoint` or `wss://your-endpoint`
    |
    */

    'subscriptionEndpoint' => env('GRAPHQL_PLAYGROUND_SUBSCRIPTION_ENDPOINT', null),

    /*
    |--------------------------------------------------------------------------
    | Control Playground availability
    |--------------------------------------------------------------------------
    |
    | Control if the playground is accessible at all.
    | This allows you to disable it in certain environments,
    | for example you might not want it active in production.
    |
    */

    'enabled' => env('GRAPHQL_PLAYGROUND_ENABLED', true),
];
