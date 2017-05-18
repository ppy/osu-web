/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
 */

const { mix } = require('laravel-mix');
const path = require('path');

// .js doesn't support globbing by itself, so we need to glob
// and spread the values in.
const glob = require('glob');
let min = '';
if (mix.config.inProduction) {
  min = '.min';
}

// relative from root?
const node_root = 'node_modules';

mix
.webpackConfig({
  module: {
    rules: [
      { test: /\.coffee$/, loader: 'coffee-loader' }
    ]
  }
})
.copy('node_modules/font-awesome/fonts', 'public/vendor/fonts/font-awesome')
.copy('node_modules/photoswipe/dist/default-skin', 'public/vendor/_photoswipe-default-skin')
.copy('node_modules/timeago/locales', 'public/vendor/js/timeago-locales')
.less('resources/assets/less/app.less', 'public/build/css')
.js([
  ...glob.sync('resources/assets/coffee/_classes/*.coffee'),

  ...glob.sync('resources/assets/coffee/react-namespaces.coffee'),
  ...glob.sync('resources/assets/coffee/react/_components/*.coffee'),
  ...glob.sync('resources/assets/coffee/react/_mixins/*.coffee'),

  'resources/assets/coffee/jquery-pubsub.coffee',
  'resources/assets/coffee/osu!live.coffee',
  'resources/assets/coffee/osu_common.coffee',

  'resources/assets/coffee/navbar-mobile.coffee',
  'resources/assets/coffee/spoilerbox.coffee',
  'resources/assets/coffee/store.coffee',
  'resources/assets/coffee/forum/post-box.coffee',
  'resources/assets/coffee/forum/topic-ajax.coffee',
  'resources/assets/coffee/ujs-common.coffee',
  'resources/assets/coffee/bootstrap-modal.coffee',
  'resources/assets/coffee/logout.coffee',
  'resources/assets/coffee/shared.coffee',
  'resources/assets/coffee/turbolinks-overrides.coffee',

  'resources/assets/coffee/main.coffee'
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
  path.join(node_root, 'layzr.js/dist/layzr.js'),
  path.join(node_root, 'react/dist/react-with-addons' + min + '.js'),
  path.join(node_root, 'react-dom/dist/react-dom' + min + '.js'),
  path.join(node_root, 'photoswipe/dist/photoswipe.js'),
  path.join(node_root, 'photoswipe/dist/photoswipe-ui-default.js'),
  path.join(node_root, 'd3/build/d3' + min + '.js'),
  path.join(node_root, 'moment/moment.js'),
  path.join(node_root, 'js-cookie/src/js.cookie.js'),

  path.join(node_root, 'react-height/build/react-height' + min + '.js'),
  path.join(node_root, 'react-motion/build/react-motion.js'),
  path.join(node_root, 'react-collapse/build/react-collapse' + min + '.js'),
  path.join(node_root, 'react-disqus-thread/dist/react-disqus-thread' + min + '.js'),
], 'public/js/vendor.js')
.scripts([
  'resources/assets/js/ga.js',
  'resources/assets/js/messages.js',
  'resources/assets/js/laroute.js',
  'resources/assets/js/build/app-main.js',
], 'public/js/app.js')
.js([
  ...glob.sync('resources/assets/coffee/react/profile-page/*.coffee'),
  'resources/assets/coffee/react/profile-page.coffee',
], 'public/js/react/profile-page.js')
.js([
  ...glob.sync('resources/assets/coffee/react/beatmaps/*.coffee'),
  'resources/assets/coffee/react/beatmaps.coffee'
], 'public/js/react/beatmaps.js')
.js([
  ...glob.sync('resources/assets/coffee/react/status-page/*.coffee'),
  'resources/assets/coffee/react/status-page.coffee'
], 'public/js/react/status-page.js')
.js([
  ...glob.sync('resources/assets/coffee/react/beatmap-discussions/*.coffee'),
  'resources/assets/coffee/react/beatmap-discussions.coffee'
], 'public/js/react/beatmap-discussions.js')
.js([
  ...glob.sync('resources/assets/coffee/react/beatmapset-page/*.coffee'),
  'resources/assets/coffee/react/beatmapset-page.coffee'
], 'public/js/react/beatmapset-page.js')
.js([
  ...glob.sync('resources/assets/coffee/react/mp-history/*.coffee'),
  'resources/assets/coffee/react/mp-history.coffee'
], 'public/js/react/mp-history.js')
.js([
  'resources/assets/coffee/react/artist-page.coffee',
], 'public/js/react/artist-page.js')
.js([
  // 'resources/assets/coffee/react/contest/voting/_base-entry-list.coffee',
  ...glob.sync('resources/assets/coffee/react/contest/voting/*.coffee'),
  'resources/assets/coffee/react/contest-voting.coffee',
], 'public/js/react/contest-voting.js')
.js([
  ...glob.sync('resources/assets/coffee/react/contest/entry/*.coffee'),
  'resources/assets/coffee/react/contest-entry.coffee',
], 'public/js/react/contest-entry.js')
.version([
  'public/build/css/app.css',
  // 'public/js/app.js', // .scripts() already minifies and versions.
  // 'public/js/vendor.js',
  // 'public/js/react/profile-page.js',
  // 'public/js/react/beatmaps.js',
  // 'public/js/react/status-page.js',
  // 'public/js/react/beatmap-discussions.js',
  // 'public/js/react/beatmapset-page.js',
  // 'public/js/react/mp-history.js',
  // 'public/js/react/artist-page.js',
  // 'public/js/react/contest-voting.js',
  // 'public/js/react/contest-entry.js',
]);
