/**
*    Copyright 2015 ppy Pty. Ltd.
*
*    This file is part of osu!web. osu!web is distributed with the hope of
*    attracting more community contributions to the core ecosystem of osu!.
*
*    osu!web is free software: you can redistribute it and/or modify
*    it under the terms of the Affero GNU General Public License version 3
*    as published by the Free Software Foundation.
*
*    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
*    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*    See the GNU Affero General Public License for more details.
*
*    You should have received a copy of the GNU Affero General Public License
*    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
*
*/
var
  elixir = require('laravel-elixir'),
  path = require('path'),
  bower_root = '../../../bower_components/', // relative from resources/assets/*
  composer_root = '../../../vendor/',
  node_root = '../../../node_modules/';


/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
  mix
  .copy('node_modules/font-awesome/fonts', 'public/vendor/fonts/font-awesome')
  .copy('node_modules/photoswipe/dist/default-skin', 'public/vendor/_photoswipe-default-skin')
  .less('app.less')
  .browserify(['vendor-modules.js'], 'resources/assets/js/build/vendor-modules.js')
  .coffee([
    '_classes/*.coffee',
    'react/_components/*.coffee',

    'jquery-pubsub.coffee',
    'osu!live.coffee',
    'osu_common.coffee',
    'turbolinks-mod.coffee',

    'navbar-mobile.coffee',
    'spoilerbox.coffee',
    'store.coffee',
    'forum/post-box.coffee',
    'forum/topic-ajax.coffee',
    'ujs-common.coffee',
    'bootstrap-modal.coffee',
    'user-dropdown-modal.coffee',
    'logout.coffee',
    'shared.coffee',

    'main.coffee',
  ], 'resources/assets/js/build/app-main.js')
  .scripts([
    path.join(composer_root, 'helthe/turbolinks/Resources/public/js/turbolinks.js'),
    'build/vendor-modules.js',
    'ga.js',
    'messages.js',
    'build/app-main.js',
  ], 'public/js/app.js')
  .coffee([
    'react/profile-page/*.coffee',
    'react/profile-page.coffee',
  ], 'public/js/react/profile-page.js')
  .coffee([
    'react/beatmaps/*.coffee',
    'react/beatmaps.coffee'
  ], 'public/js/react/beatmaps.js')
  .version([
    'css/app.css',
    'js/app.js',
    'js/react/profile-page.js',
    'js/react/beatmaps.js',
  ]);
});
