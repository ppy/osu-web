<?php

/**
 * All the automated casting in model requires mysqlnd.
 * This function check is inspired by
 * https://stackoverflow.com/a/22499259 .
 */

if (!function_exists('mysqli_get_client_stats')) {
    exit('Required mysqlnd driver is missing.');
}

$mysqlDefaults = [
    'driver' => 'mysql',
    'host' => env('DB_HOST', 'localhost'),
    'username' => env('DB_USERNAME', 'osuweb'),
    'password' => env('DB_PASSWORD', ''),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_0900_ai_ci',
    'prefix' => '',
    /*
     * This should match latest sane default[1].
     * It's set manually here because ProxySQL only supports protocol version 5.x[2] and
     * Laravel sends obsolete SQL mode[3] if set to strict mode and detect older server version.
     * [1] https://dev.mysql.com/doc/refman/8.0/en/sql-mode.html
     * [2] https://github.com/sysown/proxysql/issues/2021
     * [3] https://github.com/laravel/framework/blob/36fdbd4c6a35d689384eebd4c33477a6b444d883/src/Illuminate/Database/Connectors/MySqlConnector.php#L183
     */
    'modes' => [
        'ONLY_FULL_GROUP_BY',
        'STRICT_TRANS_TABLES',
        'NO_ZERO_IN_DATE',
        'NO_ZERO_DATE',
        'ERROR_FOR_DIVISION_BY_ZERO',
        'NO_ENGINE_SUBSTITUTION',
    ],
    'options' => [
        PDO::ATTR_PERSISTENT => true,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone = '+00:00'",
    ],
];

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => 'mysql',

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [
        'mysql' => array_merge($mysqlDefaults, [
            'database' => env('DB_DATABASE', 'osu'),
        ]),

        'mysql-mp' => array_merge($mysqlDefaults, [
            'database' => env('DB_DATABASE_MP', 'osu_mp'),
        ]),

        'mysql-charts' => array_merge($mysqlDefaults, [
            'database' => env('DB_DATABASE_CHARTS', 'osu_charts'),
        ]),

        'mysql-chat' => array_merge($mysqlDefaults, [
            'database' => env('DB_DATABASE_CHAT', 'osu_chat'),
        ]),

        'mysql-store' => array_merge($mysqlDefaults, [
            'database' => env('DB_DATABASE_STORE', 'osu_store'),
        ]),

        'mysql-updates' => array_merge($mysqlDefaults, [
            'database' => env('DB_DATABASE_UPDATES', 'osu_updates'),
        ]),
    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => 'phpredis',

        'cluster' => false,

        'cache' => [
            'host' => presence(env('CACHE_REDIS_HOST')) ?? presence(env('REDIS_HOST')) ?? '127.0.0.1',
            'port' => get_int(env('CACHE_REDIS_PORT')) ?? get_int(env('REDIS_PORT')) ?? 6379,
            'database' => get_int(env('CACHE_REDIS_DB')) ?? 0,
            'persistent' => true,
        ],

        'default' => [
            'host' => presence(env('REDIS_HOST')) ?? '127.0.0.1',
            'port' => get_int(env('REDIS_PORT')) ?? 6379,
            'database' => get_int(env('REDIS_DB')) ?? 0,
            'persistent' => true,
        ],

        'notification' => [
            'host' => presence(env('NOTIFICATION_REDIS_HOST')) ?? '127.0.0.1',
            'port' => get_int(env('NOTIFICATION_REDIS_PORT')) ?? 6379,
            'database' => get_int(env('NOTIFICATION_REDIS_DB')) ?? 0,
            'persistent' => true,
        ],

    ],

];
