<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    */

    'name' => 'osu!web',

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services your application utilizes. Set this in your ".env" file.
    |
    */
    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    // Please check other uses of APP_URL when updating this.
    'url' => rtrim(env('APP_URL', 'http://localhost'), '/'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
     * Make sure to check locale name mapping for other components.
     * carbon is in Http\Middleware\SetLocale (no helper... yet?).
     * html, momentjs, and laravel are in LocaleMeta.
     * php (IntlDateFormatter etc) isn't mapped at the moment.
     * Check respective packages for supported list of languages.
     *
     * carbon: list in vendor/nesbot/carbon/src/Carbon/Lang/
     * html: lang attribute in html tag. Mainly for uppercasing country code if used.
     * laravel: list in vendor/laravel/framework/src/Illuminate/Translation/MessageSelector.php
     * momentjs: list in node_modules/moment/locale/
     */
    'available_locales' => [
        // separate the default
        'en',

        // sort by name
        'ar',
        'be',
        'bg',
        'ca',
        'cs',
        'da',
        'de',
        'el',
        'es',
        'fi',
        'fil',
        'fr',
        'he',
        'hu',
        'id',
        'it',
        'ja',
        'ko',
        'lt',
        'nl',
        'no',
        'pl',
        'pt',
        'pt-br',
        'ro',
        'ru',
        'sk',
        'sl',
        'sr',
        'sv',
        'th',
        'tr',
        'uk',
        'vi',
        'zh',
        'zh-tw',
    ],

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY', 'base64:q7U5qyAkedR1F6UhN0SQlUxBpAMDyfHy3NNFkqmiMqA='),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => ServiceProvider::defaultProviders()->except([
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\MigrationServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
    ])->merge([
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // Override default migrate:fresh
        App\Providers\MigrationServiceProvider::class,
        App\Providers\PassportServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        // Override the session id naming (for redis key namespacing)
        App\Providers\SessionServiceProvider::class,
        // After DB transaction commit support
        App\Providers\TransactionStateServiceProvider::class,

        Mariuzzo\LaravelJsLocalization\LaravelJsLocalizationServiceProvider::class,
    ])->toArray(),

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => Facade::defaultAliases()->merge([
        // renamed to avoid conflict with PhpRedis
        'LaravelRedis' => Illuminate\Support\Facades\Redis::class,

        'GitHub' => GrahamCampbell\GitHub\Facades\GitHub::class,

        'Datadog' => ChaseConey\LaravelDatadogHelper\Datadog::class,
    ])->toArray(),

];
