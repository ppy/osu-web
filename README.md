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
    
Developing
---------

### Generating assets while developing

To continuously generate assets as you make changes to files (less, coffeescript) you can run `gulp` in `watch` mode.

    $ ./node_modules/.bin/gulp watch

### Use of React vs Laravel Blade templates

For the time being, using React is generally preferred for pages which involve interaction beyond simple hyperlinks (ie. when state is present that can be modified by the user) or when real-time changes are presented to the user (ie. the state is volatile depending on back-end updates).

### Use of BEM for CSS naming

Much of the CSS present abides to [BEM](http://getbem.com/) conventions but there is also a fair deal that doesn't. We haven't come to a unanimous decision about how to proceed going forward, so please use your own discretion or continue the discussion in the relevant [issue](https://github.com/ppy/osu-web/issues/53).

Contributing
------------

We welcome all contributions, but keep in mind that we already have the full site designed (mock-ups). If you wish to work on a new section, please open a ticket and we will give you what you need from a design perspective to proceed. If you want to make *changes* to the design, we recommend you open an issue with your intentions before spending too much time, to ensure no effort is wasted.

Contributions can be made via pull requests to this repository. We hope to credit and reward larger contributions via a [bounty system](https://goo.gl/nFdoyI). If you're unsure of what you can help with, check out the [list](https://github.com/ppy/osu-web/issues?utf8=%E2%9C%93&q=is%3Aissue+is%3Aopen+label%3Abounty) of available issues with bounty.

Note that while we already have certain standards in place, nothing is set in stone. If you have an issue with the way code is structured; with any libraries we are using; with any processes involved with contributing, *please* bring it up. I welcome all feedback so we can make contributing to this project as easy as possible.

Seeking Help
------------

If you need help with anything, you have two options:

#### Create an Issue

If you have something you want to discuss in detail, or have hit an issue which you believe others will also have in deployment or development on the system, [opening an issue](https://github.com/ppy/osu-web/issues) is the best way to get help. It creates a permanent resource for others wishing to contribute to conversation. Please **make sure to search first** in case someone else has already addressed the same issue!

#### Ask on Slack

We have a channel on the [osu! public slack](https://osu.ppy.sh/p/slack) dedicated to osu-web development. If you have a problem which you think might be the result of your own stupidity, want to ask a quick question that doesn't deserve opening an issue or just discuss things in a casual environment, this is for you!

Licence
-------

osu!web is licensed under AGPL version 3 or later. Please see [the licence file](LICENCE) for more information. [tl;dr](https://tldrlegal.com/license/gnu-affero-general-public-license-v3-(agpl-3.0)) if you want to use any code, design or artwork from this project, attribute it and make your project open source under the same licence.
