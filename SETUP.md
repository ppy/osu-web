# Setting up your development environment

There are a few different options to get started:

## 1\. Manual setup for experienced developers (i.e. using an existing development environment):

### Install prerequisites

- MySQL 8.0+
- PHP 8.0+ (with curl, gd, intl, json, mbstring, mcrypt, mysql, xml and zip extensions)
- nginx (or other webserver)
- Node.js 16
- elasticsearch 6+
- redis

### Clone the git repository

```
$ git clone https://github.com/ppy/osu-web.git
```

### Configure .env file

```bash
# copy the example file and edit the settings, the important ones are APP_* and DB_*
$ cp .env.example .env
$ vi .env
```

### URL rewriting

```nginx
# for nginx, with root set to the `public` folder of the repo
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

Consult the [laravel documentation](https://laravel.com/docs/6.x/installation#web-server-configuration) for non-nginx

### Initialize database

```bash
# this script assumes you can connect passwordless as root
$ mysql -u root < ./docker/development/db_setup.sql
```

### Install packages and build assets

```bash
# will also install composer and yarn
$ ./build.sh
```

At this point you should be able to access the site via whatever webserver you configured.

## 2\. Using Docker

- First, install [Docker](https://www.docker.com/community-edition) and [Docker Compose](https://docs.docker.com/compose/install/) (on Windows, it's already part of Docker install).
- Install [git](https://git-scm.com).
- Obtain a [GitHub token](https://github.com/settings/tokens/new?scopes=public_repo&description=osu-web) as it's required for several parts of the website.
- If using Windows, make sure it's running at least build 2004 and install Ubuntu (or another Linux distro of choice) from Windows Store. Additionally:
  - Make sure it's running WSL2 (convert it if it's still using WSL1).
  - Open Docker settings, go to Resources → WSL Integration → Enable integration with additional distros (enable for the installed distro).
- Open terminal (or Linux console on Windows).
- Clone this repository.
- Set `GITHUB_TOKEN` environment variable (usually by `export GITHUB_TOKEN=ghs_...`).
  - It'll be recorded to composer and app config so it doesn't need to be set again next time.
- Run `bin/docker_dev.sh`. Make sure the repository folder is owned by the user executing this command (must be non-root).
- Due to the nature of Docker (a container is killed when the command running in it finishes), the Yarn container will be run in watch mode.
- Do note that the supplied Elasticsearch container uses a high (1+ GB) amount of RAM. Ensure that your system (or virtual machine, if running on Windows/macOS) has a necessary amount of memory allocated (at least 2 GB). If you can't (or don't want to), you can comment out the relevant elasticsearch lines in `docker-compose.yml`.
- To run any of the below commands, make sure you are using the docker container: `docker-compose run --rm php`.
  - To run artisan commands, run using `docker-compose run --rm php artisan`.

---
**Notes**

The `elasticsearch` and `db` containers store their data to volumes, the containers will use data on these volumes if they already exist.

### Elasticsearch

Existing Elasticsearch indices will be upgraded to new versions on start. Indices from a newer version cannot be used by older versions and downgrades are not supported.

If you need to use a previous version of elasticsearch, e.g. to run `osu-elastic-indexer`, you can specify a previous version in a `docker-compose.override.yml` file:

    services:
      elasticsearch:
        image: docker.elastic.co/elasticsearch/elasticsearch-oss:6.8.23

Note that older versions of Elasticsearch do not work on ARM-based CPUs.

`osu-elastic-indexer` currently cannot update indices using Elasticsearch 7; existing records can still be queried normally.


### Windows

On Windows, the files inside Linux system can be found in Explorer from `\\wsl$` location.

Default user home directory can be found inside `home` → `<username>`.

Due to difference in file permission and line endings, adjustments on git may be needed. Run these in the repository directory:

```
git config core.eol lf
git config core.filemode false
```

### ARM-based CPUs

Tests that require the use of ChromeDriver (both Karma and Dusk tests) will not work inside Docker when running on ARM-based CPUs (e.g. Macs running Apple Silicon). In this scenario, these tests should be run outside of a container.

Custom configurations to run the tests within the container are currently not supported.

---

### Docker hints

#### Services

There are multiple services involved:

- php: main service for php server. Also serves as entry point for doing other stuff like testing etc
- assets: builds assets. It sometimes behaves weirdly in which case try restarting it
- job: runs queued job
- schedule: runs scheduled job every 5 minutes
- migrator: prepare database and elasticsearch (service should exit with status 0 after finishing its task)
- notification-server: main service for notification websocket server
- notification-server-dusk: notification server to be used by browser test
- db: database server. Can be skipped by commenting it out and setting a different database instance
- redis: cache and session server. Can be skipped just like db service
- elasticsearch: search database. Can be skipped just like db service
- nginx: proxies php and notification-server(-dusk) so they can be accessed under same host

#### Modifying environment (`.env`, `.env.dusk.local`) files

Sometimes a restart of notification-server and notification-server-dusk will be needed when changing those files.

#### Example commands

See if anything has stopped:

```
docker-compose ps
```

Start docker in background:

```
bin/docker_dev.sh -d
# alternatively
# docker-compose up -d
```

Start single docker service:

```
docker-compose start <servicename>
```

Restart single docker service:

```
docker-compose restart <servicename>
```

#### Direct database access

Using own mysql client, connect to port 3306 or `MYSQL_EXTERNAL_PORT` if set when starting up docker.

Alternatively, there's mysql client installed in php service:

```
docker-compose run --rm php mysql
```

#### Updating image

Docker images need to be occasionally updated to make sure they're running latest version of the packages.

```
docker-compose down --rmi all
docker-compose pull
docker-compose build --pull
```

(don't use `build --no-cache` as it'll end up rebuilding `php` image multiple times)

#### Faster php commands

When frequently running commands, doing `docker-compose run` may feel a little bit slow. An alternative is by running the command in existing instance instead. For example to run `artisan tinker`:

```
docker-compose exec php /app/docker/development/entrypoint.sh artisan tinker
```

Add an alias for the docker-compose command so it doesn't need to be specified every time:

```
alias p='docker-compose exec php /app/docker/development/entrypoint.sh'
p artisan tinker
```

(add the `alias` line to shell startup file; usually `~/.profile`, `~/.zshrc`, etc)

# Development

## Creating your initial user

In the repository directory:

```php
$ php artisan tinker
>>> (new App\Libraries\UserRegistration(["username" => "yourusername", "user_email" => "your@email.com", "password" => "yourpassword"]))->save();
```

## Generating assets

Using Laravel's [Mix](https://laravel.com/docs/6.x/mix).

```bash
# build assets (should be done automatically if using docker)
$ yarn run development
```

Note that if you use the bundled docker-compose setup, yarn/webpack will be already run in watch mode.

## Reset the database + seeding sample data

```
$ php artisan migrate:fresh --seed
```

Run the above command to rebuild the database and seed with sample data. In order for the seeder to seed beatmaps, you must enter a valid osu! API key as the value of the `OSU_API_KEY` property in the `.env` configuration file, as the seeder obtains beatmap data from the osu! API. The key can be obtained at [the "osu! API Access" page](https://old.ppy.sh/p/api), which is currently only available on the old site.

## Continuous asset generation while developing

To continuously generate assets as you make changes to files (less, coffeescript) you can run `webpack` in `watch` mode.

```
$ yarn run watch
```

## Email

You can watch emails being sent from `osu-web` by watching the `storage/logs/laravel.log` file. Make sure the `MAIL_DRIVER` is set to `log`.

## Use the API from osu!

To connect from osu!(lazer) via the API offered by osu-web, you need to create a special OAuth password client with:
```
php artisan passport:client --password
```
You can then change the constants in the osu! repository (`./osu.Game/Online/API/APIAccess.cs`).

# Testing

To run test, first copy `.env.testing.example` to `.env.testing` and `.env.dusk.local.example` to `.env.dusk.local`.
Make sure to set `ES_INDEX_PREFIX` and all the databases to something other than production.

Once the env files are set, database for testing will need to be setup:

## Initializing the test database

Tests should be run against an empty database, to initialize an empty database:

```
APP_ENV=testing php artisan migrate:fresh --yes
```

or if using docker:

```
docker-compose run --rm -e APP_ENV=testing php artisan migrate:fresh --yes
```

---
**IMPORTANT**

If there are existing matching databases, they will be dropped!

---

## PHP tests

PHP tests use PHPUnit, to run:

```
bin/phpunit.sh
```

or if using Docker:

```
docker-compose run --rm php test phpunit
```

Regular PHPUnit arguments are accepted, e.g.:

```
bin/phpunit.sh --filter=Route --stop-on-failure
```

## Browser tests

Browser tests are run using Laravel Dusk:

```
bin/run_dusk.sh
```

or if using Docker:

```
docker-compose run --rm php test browser
```

---
**Known Issues**

The Dusk tests currently do not clean up completely, leaving behind test data in the database; the database should be reintialized after running a Dusk test.

---

## Javascript tests

Javascript tests are run with Karma.

Karma is currently configured to to use Headless Chrome by default; this will require Chrome or a standalone Headless Chrome to be already installed. If you are using Docker, Headless Chrome will already be installed in the container.

```
yarn karma start --single-run
```

or if using Docker:

```
docker-compose run --rm php test js
```

# Documentation

```bash
$ php artisan scribe:generate
```

Documentation will be generated in the `docs` folder in both html and markdown formats.
