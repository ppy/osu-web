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
var elixir = require('laravel-elixir');
var path = require('path');
var util = require('gulp-util');

// relative from resources/assets/*/
var composer_root = '../../../vendor/';
var node_root = '../../../node_modules/';

/*
 * The merge rules plugin is kind of buggy and broke safari.
 * Noticeably in loading overlay circles having wrong animation.
 *
 * Reference: https://github.com/ben-eb/cssnano/issues/154
 */
elixir.config.css.cssnano.pluginOptions = {
  mergeRules: false,
}

var min = '';
if (util.env.production) {
    min = '.min';
}

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
  .copy('node_modules/timeago/locales', 'public/vendor/js/timeago-locales')
  .less('app.less')
  .coffee([
    '_classes/*.coffee',

    'react-namespaces.coffee',
    'react/_components/*.coffee',
    'react/_mixins/*.coffee',

    'jquery-pubsub.coffee',
    'osu!live.coffee',
    'osu_common.coffee',

    'navbar-mobile.coffee',
    'spoilerbox.coffee',
    'store.coffee',
    'forum/post-box.coffee',
    'forum/topic-ajax.coffee',
    'ujs-common.coffee',
    'bootstrap-modal.coffee',
    'logout.coffee',
    'shared.coffee',
    'turbolinks-overrides.coffee',

    'main.coffee'
  ], 'resources/assets/js/build/app-main.js')
  .scripts([
    path.join(node_root, 'turbolinks/dist/turbolinks.js'),
    path.join(node_root, 'jquery/dist/jquery' + min + '.js'),
    path.join(node_root, 'jquery-ujs/src/rails.js'),
    path.join(node_root, 'qtip2/dist/jquery.qtip' + min + '.js'),
    path.join(node_root, 'jquery.scrollto/jquery.scrollTo.js'),
    path.join(node_root, 'jquery-ui/ui/data.js'),
    path.join(node_root, 'jquery-ui/ui/scroll-parent.js'),
    path.join(node_root, 'jquery-ui/ui/widget.js'),
    path.join(node_root, 'jquery-ui/ui/widgets/mouse.js'),
    path.join(node_root, 'jquery-ui/ui/widgets/sortable.js'),
    path.join(node_root, 'timeago/jquery.timeago.js'),
    path.join(node_root, 'blueimp-file-upload/js/jquery.fileupload.js'),
    path.join(node_root, 'bootstrap/dist/js/bootstrap.js'),
    path.join(node_root, 'lodash/lodash.js'),
    path.join(node_root, 'layzr.js/dist/layzr.min.js'),
    path.join(node_root, 'react/dist/react-with-addons' + min + '.js'),
    path.join(node_root, 'react-dom/dist/react-dom' + min + '.js'),
    path.join(node_root, 'photoswipe/dist/photoswipe.js'),
    path.join(node_root, 'photoswipe/dist/photoswipe-ui-default.js'),
    path.join(node_root, 'd3/d3.js'),
    path.join(node_root, 'moment/moment.js'),
    path.join(node_root, 'slick-carousel/slick/slick.js'),
    path.join(node_root, 'js-cookie/src/js.cookie.js'),
    'ga.js',
    'messages.js',
    'laroute.js',
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
  .coffee([
    'react/slack-page/*.coffee',
    'react/slack-page.coffee'
  ], 'public/js/react/slack-page.js')
  .coffee([
    'react/status-page/*.coffee',
    'react/status-page.coffee'
  ], 'public/js/react/status-page.js')
  .coffee([
    'react/beatmap-discussions/*.coffee',
    'react/beatmap-discussions.coffee'
  ], 'public/js/react/beatmap-discussions.js')
  .coffee([
    'react/beatmapset-page/*.coffee',
    'react/beatmapset-page.coffee'
  ], 'public/js/react/beatmapset-page.js')
  .coffee([
    'react/mp-history/*.coffee',
    'react/mp-history.coffee'
  ], 'public/js/react/mp-history.js')
  .coffee([
    'react/artist-page.coffee',
  ], 'public/js/react/artist-page.js')
  .coffee([
    'react/contest/voting/_base-entry-list.coffee',
    'react/contest/voting/*.coffee',
    'react/contest-voting.coffee',
  ], 'public/js/react/contest-voting.js')
  .coffee([
    'react/contest/entry/*.coffee',
    'react/contest-entry.coffee',
  ], 'public/js/react/contest-entry.js')
  .version([
    'css/app.css',
    'js/app.js',
    'js/react/profile-page.js',
    'js/react/beatmaps.js',
    'js/react/slack-page.js',
    'js/react/status-page.js',
    'js/react/beatmap-discussions.js',
    'js/react/beatmapset-page.js',
    'js/react/mp-history.js',
    'js/react/artist-page.js',
    'js/react/contest-voting.js',
    'js/react/contest-entry.js',
  ]);
});
