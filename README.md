osu!web
=======

[![Build Status](https://travis-ci.org/ppy/osu-web.svg?branch=master)](https://travis-ci.org/ppy/osu-web)

The future face of osu!.

Requirements
------------

[Vagrant 1.7+](http://www.vagrantup.com/downloads.html) or equivalent development environment.

Deploying
---------

1. Clone repository
2. Open shell and point to checkout directory
3. `cd vagrant; vagrant up`
4. wait patiently
5. Access the site from http://localhost:8080/.

*Note that you can get things running without vagrant. It should be pretty straightforward, but if you run into problems don't hesitate to open an issue asking for help!*

### Creating user

    c:\osuweb\vagrant> vagrant ssh
    $ cd /data/osu\!web
    $ php artisan tinker
    >>> App\Models\User::create(["username" => "yourusername", "user_password" => password_hash(md5("yourpassword"), PASSWORD_BCRYPT)]);

### Generating assets

Using Laravel's [Elixir](http://laravel.com/docs/5.1/elixir).

    c:\osu-web\vagrant> vagrant ssh
    $ cd /data/osu\!web
    $ php artisan lang:js resources/assets/js/messages.js
    $ ./node_modules/.bin/gulp

Contributing
------------

We welcome all contributions, but keep in mind that we already have the full site designed (mock-ups). If you wish to work on a new section, please open a ticket and we will give you what you need to proceed.

If you want to make *changes* to the design, we recommend you open an issue with your intentions before spending too much time, to ensure no effort is wasted.

Contributions can be made via pull requests to this repository. We hope to credit and reward larger contributions via a [bounty system](https://goo.gl/nFdoyI). If you're unsure of what you can help with, check out the [list](https://github.com/ppy/osu-web/issues?utf8=%E2%9C%93&q=is%3Aissue+is%3Aopen+label%3Abounty) of available issues with bounty.

Licence
-------
osu!web is licensed under AGPL version 3 or later. Please see [the licence file](LICENCE) for more information.
