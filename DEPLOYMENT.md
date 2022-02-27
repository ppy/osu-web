# Deployment with docker

There's only one image to be built:

    docker build -f Dockerfile.deployment --tag <repository>:<tag> --build-arg <buildarg1> --build-arg <buildarg2> .

There are several build arguments required:

- `APP_URL`
- `DOCS_URL`
- `PAYMENT_SANDBOX`
- `SHOPIFY_DOMAIN`
- `SHOPIFY_STOREFRONT_TOKEN`
- `GIT_SHA` (build version. Something like `"$(date "+%Y%m%d-%H%M%S")-$(git rev-parse HEAD | cut -c1-7)"` should work)

## Updating image

Run build with `--pull --no-cache` parameters to ensure latest image and packages are used.

## Configuration files

There are three main configuration files which should be mounted to the container:

- `/app/.env`: environment file. Can also be done by passing them as environment variables
- `/app/storage/oauth-private.key`: OAuth private key. Required
- `/app/storage/oauth-public.key`: OAuth public key for the private key above. Required

Note that as the actual process is run as non-root user, the files must be world-readable.

## Services

The image built serves multiple purposes, each can be run by passing the parameter when starting docker (or as command if using orchestration tools like docker-compose).

There are three main commands:

- php: starts php-fpm on port 9000
- assets: starts nginx on port 8000. Used to serve static assets
- artisan: starts artisan command. This should be followed by correct options

### php-fpm

Command: `php`

Connect to it at port 9000 through a reverse proxy like `nginx`. Root directory for it is `/app/public`.

Technically the proxy should only be accessing `/index.php` as there's no other public accessible php scripts.
Use something like `SCRIPT_FILENAME /app/public/index.php` when using nginx.

php (or more accurately, php-fpm) config can be overridden by mounting the file to `/app/docker/deployment/php-fpm.conf`. See the included default file for reference. User/group settings aren't actually used as it's already run using non-root user but it needs a valid username.

### static assets

Command: `assets`

This serves static files using nginx at port 8000. Similar to php-fpm, nginx config file can be overridden through `/app/docker/deployment/nginx-assets.conf`.

### job runner

Command: `artisan queue:work --queue=<queuename> <additional options...>`

There are multiple queues used:

- `beatmap_default`
- `beatmap_high`
- `default`
- `notification`
- `store-notifications`

The names should be relatively self explained. Multiple queues can be handled by single runner by specifying them all separated by comma (ex: `default,notification,store-notifications`).

Additional options can be checked [in this page](https://laravel.com/docs/6.x/queues).

### scheduled tasks

Command: `artisan schedule:run`

This should be run at least every 10 minutes. It doesn't run permanently.

## Migration

No migration is run by default. Run the container with command `artisan migrate` to run the migration.
