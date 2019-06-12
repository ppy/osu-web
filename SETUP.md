# Setting up your development environment

There are a few different options to get started:

## 1. Manual setup for experienced developers (i.e. using an existing development environment):
### Install prerequisites
- MySQL 5.7
- PHP 7.1+ (with curl, gd, intl, json, mbstring, mcrypt, mysql, xml and zip extensions)
- nginx (or other webserver)
- Node.js 8 or 9 (and a modern version of npm)
- elasticsearch 5+
- redis (not required, but you may want to use for caching and laravel's job-queue)

### Clone the git repository
    $ git clone https://github.com/ppy/osu-web.git

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

Consult the [laravel documentation](https://laravel.com/docs/5.5/installation#web-server-configuration) for non-nginx

### Initialize database
```bash
# this script assumes you can connect passwordless as root
$ ./bin/db_setup.sh
```

### Install packages and build assets
```bash
# will also install composer and yarn
$ ./build.sh
```

At this point you should be able to access the site via whatever webserver you configured

## 2. Automated setup for Ubuntu

### Create a fresh Ubuntu environment
On your server, a virtual machine, whatever.

### Clone the git repository:
    git clone https://github.com/ppy/osu-web.git


### Run automated configuration
Note these script are intended to be run in a *sandboxed environment*; do not run on a shared development system without first understanding what is being done.
```bash
$ sudo ./bootstrap.sh
$ ./build.sh
```

You can then run the standalone php server from inside the `public` folder:
```
php -S 127.0.0.1:8080
```

## 3. Using Docker

- First, install [Docker](https://www.docker.com/community-edition) and [Docker Compose](https://docs.docker.com/compose/install/).
- Export required environment variable `UID` (`export UID`).
  - Make sure to do this before using any of docker-compose commands.
  - Alternatively add the command to shell initialisation file like `~/.profile` or `~/.zshrc`.
- Run `docker-compose up` in the main directory.
- Due to the nature of Docker (a container is killed when the command running in it finishes), the Yarn container will be run in watch mode.
- Do note that the supplied Elasticsearch container uses a high (1+ GB) amount of RAM. Ensure that your system (or virtual machine, if running on Windows/macOS) has a necessary amount of memory allocated (at least 2 GB). If you can't (or don't want to), you can comment out the relevant elasticsearch lines in `docker-compose.yml`.
- To run any of the below commands, make sure you are in the docker container: `docker-compose exec php sh`.

# Development

## Creating your initial user
In the repository directory:
```php
$ php artisan tinker
>>> (new App\Libraries\UserRegistration(["username" => "yourusername", "user_email" => "your@email.com", "password" => "yourpassword"]))->save();
```

## Generating assets

Using Laravel's [Mix](https://laravel.com/docs/5.5/mix).
```bash
# generate translations for langjs
# and routes for laroute
$ bin/update_locales_and_routes_js
# build assets (should be done automatically if using docker)
$ yarn run development
```

Note that if you use the bundled docker-compose setup, yarn/webpack will be already run in watch mode, and you will only need to run the `lang:js` and `laroute:generate` artisan commands whenever you need to regenerate these helper files.

## Reset the database + seeding sample data

    $ php artisan migrate:fresh --seed

Run the above command to rebuild the database and seed with sample data. In order for the seeder to seed beatmaps, you must enter a valid osu! API key into your `.env` configuration file as it obtains beatmap data from the osu! API.

# Development

## Generating assets while developing

To continuously generate assets as you make changes to files (less, coffeescript) you can run `webpack` in `watch` mode.

    $ yarn run watch
