osu!web
--------

the future face of osu!

Requirements
============

[Vagrant 1.5+](http://www.vagrantup.com/downloads.html)

Deploying
=========

1. Clone respository
2. Open shell and point to checkout directory
3. cd vagrant; vagrant up
4. wait patiently
5. Access the site from http://localhost:8080/.

Creating user
=============

    c:\osuweb\vagrant> vagrant ssh
    $ cd /data/osu\!web
    $ hhvm artisan tinker
    >>> App\Models\User::create(["username" => "yourusername", "user_password" => password_hash(md5("yourpassword"), PASSWORD_BCRYPT)]);

Generating assets
=================

Using Laravel's [Elixir](http://laravel.com/docs/5.1/elixir).

    c:\osu-web\vagrant> vagrant ssh
    $ cd /data/osu\!web
    $ hhvm artisan lang:js resources/assets/js/messages.js
    $ ./node_modules/.bin/gulp

Licence
=======
osu!web is licensed under AGPL version 3 or later. Please see [the licence file](LICENCE) for more information.
