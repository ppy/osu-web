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
  elixir = require("laravel-elixir"),
  path = require("path"),
  bower_root = "../../../bower_components/", // relative from resources/assets/*
  composer_root = "../../../vendor/",
  node_root = "../../../node_modules/";


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
  .copy("node_modules/font-awesome/fonts", "public/vendor/fonts/font-awesome")
  .copy("node_modules/photoswipe/dist/default-skin", "public/vendor/_photoswipe-default-skin")
  .less("app.less")
  .scripts([
    path.join(composer_root, "components/jquery/jquery.js"),
    path.join(composer_root, "helthe/turbolinks/Resources/public/js/turbolinks.js"),
    path.join(bower_root, "jquery-ujs/src/rails.js"),
    path.join(node_root, "bootstrap/dist/js/bootstrap.js"),
    path.join(bower_root, "jquery-timeago/jquery.timeago.js"),
    path.join(bower_root, "jquery-zoom/jquery.zoom.js"),
    path.join(composer_root, "flesler/jquery.scrollto/jquery.scrollTo.js"),
    path.join(node_root, "blueimp-file-upload/js/vendor/jquery.ui.widget.js"),
    path.join(node_root, "blueimp-file-upload/js/jquery.iframe-transport.js"),
    path.join(node_root, "blueimp-file-upload/js/jquery.fileupload.js"),
    path.join(bower_root, "ResponsiveSlides.js/responsiveslides.js"),
    path.join(node_root, "photoswipe/dist/photoswipe.js"),
    path.join(node_root, "photoswipe/dist/photoswipe-ui-default.js"),
    path.join(node_root, "lodash/index.js"),
    path.join(node_root, "layzr.js/dist/layzr.js"),
    path.join(bower_root, "qtip2/jquery.qtip.js"),
    path.join(node_root, "react/dist/react-with-addons.js"),
    path.join(node_root, "react-dom/dist/react-dom.js"),
    "ga.js",
  ], "public/js/vendor.js")
  .scripts("messages.js", "public/js/messages.js")
  .coffee([
    "jquery-pubsub.coffee",
    "osu!live.coffee",
    "osu_common.coffee",
    "turbolinks-mod.coffee",
    "local-storage-polyfill.coffee",

    "editor-zoom.coffee",
    "fade.coffee",
    "form-placeholder-hide.coffee",
    "gallery.coffee",
    "global-drag.coffee",
    "header-menu.coffee",
    "logo-menu.coffee",
    "menu.coffee",
    "navbar-mobile.coffee",
    "spoilerbox.coffee",
    "store.coffee",
    "sticky-footer.coffee",
    "sticky-header.coffee",
    "sync-height.coffee",
    "tooltip-default.coffee",
    "forum.coffee",
    "forum-auto-click.coffee",
    "forum-cover.coffee",
    "forum-posts-seek.coffee",
    "forum-search-modal.coffee",
    "forum-topic-post-jump.coffee",
    "forum-topic-reply.coffee",
    "forum/post-box.coffee",
    "forum/topic-ajax.coffee",
    "ujs-common.coffee",
    "bootstrap-modal.coffee",
    "user-dropdown-modal.coffee",
    "logout.coffee",
    "shared.coffee",
    "throttled-events.coffee",

    "main.coffee",

    "react/_components/*.coffee",
  ], "public/js/app.js")
  .coffee([
    "react/profile-page/*.coffee",
    "react/profile-page.coffee",
  ], "public/js/react/profile-page.js")
  .coffee([
    "react/beatmaps/*.coffee"
  ], "public/js/react/beatmaps.js")
  .version([
    "css/app.css",
    "js/app.js",
    "js/messages.js",
    "js/react/profile-page.js",
    "js/react/beatmaps.js",
    "js/vendor.js",
  ])
});
