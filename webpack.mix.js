// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

'use strict';

const mix = require('laravel-mix');
const fs = require('fs');
const path = require('path');
const webpack = require('webpack');
const SentryPlugin = require('webpack-sentry-plugin');
const TsconfigPathsPlugin = require('tsconfig-paths-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');

// .js doesn't support globbing by itself, so we need to glob
// and spread the values in.
const glob = require('glob');
let min = '';
let reactMin = 'development';
if (mix.inProduction()) {
  min = '.min';
  reactMin = 'production.min';
}

const reactComponentSet = function(name) {
    return [[`resources/assets/coffee/react/${name}.coffee`], `js/react/${name}.js`];
};

const paymentSandbox = !(process.env.PAYMENT_SANDBOX === '0'
                         || process.env.PAYMENT_SANDBOX === 'false'
                         || !process.env.PAYMENT_SANDBOX);

// relative from root?
const nodeRoot = 'node_modules';

const vendor = [
  path.join(nodeRoot, 'clipboard-polyfill/build/clipboard-polyfill.js'),
  path.join(nodeRoot, `url-polyfill/url-polyfill${min}.js`),
  path.join(nodeRoot, 'turbolinks/dist/turbolinks.js'),
  path.join(nodeRoot, `jquery/dist/jquery${min}.js`),
  path.join(nodeRoot, 'jquery-ujs/src/rails.js'),
  path.join(nodeRoot, `qtip2/dist/jquery.qtip${min}.js`),
  path.join(nodeRoot, 'jquery.scrollto/jquery.scrollTo.js'),
  path.join(nodeRoot, 'jquery-ui/ui/data.js'),
  path.join(nodeRoot, 'jquery-ui/ui/scroll-parent.js'),
  path.join(nodeRoot, 'jquery-ui/ui/widget.js'),
  path.join(nodeRoot, 'jquery-ui/ui/widgets/mouse.js'),
  path.join(nodeRoot, 'jquery-ui/ui/widgets/slider.js'),
  path.join(nodeRoot, 'jquery-ui/ui/widgets/sortable.js'),
  path.join(nodeRoot, 'jquery-ui/ui/keycode.js'),
  path.join(nodeRoot, 'timeago/jquery.timeago.js'),
  path.join(nodeRoot, 'blueimp-file-upload/js/jquery.fileupload.js'),
  path.join(nodeRoot, 'bootstrap/dist/js/bootstrap.js'),
  path.join(nodeRoot, 'lodash/lodash.js'),
  path.join(nodeRoot, 'layzr.js/dist/layzr.js'),
  path.join(nodeRoot, `react/umd/react.${reactMin}.js`),
  path.join(nodeRoot, 'react-dom-factories/index.js'),
  path.join(nodeRoot, `react-dom/umd/react-dom.${reactMin}.js`),
  path.join(nodeRoot, `prop-types/prop-types${min}.js`),
  path.join(nodeRoot, 'photoswipe/dist/photoswipe.js'),
  path.join(nodeRoot, 'photoswipe/dist/photoswipe-ui-default.js'),
  path.join(nodeRoot, `d3/dist/d3${min}.js`),
  path.join(nodeRoot, 'moment/moment.js'),
  path.join(nodeRoot, 'js-cookie/src/js.cookie.js'),
  path.join(nodeRoot, `imagesloaded/imagesloaded.pkgd${min}.js`),
];

vendor.forEach(function(script) {
  if (!fs.existsSync(script)) {
    throw new Error(`${script} doesn't exist`);
  }
});

let webpackConfig = {
  externals: {
    'd3': 'd3',
    'lodash': '_',
    'moment': 'moment',
    'prop-types': 'PropTypes',
    'react': 'React',
    'react-dom': 'ReactDOM',
    'react-dom-factories': 'ReactDOMFactories',
  },
  module: {
    rules: [
      {
        enforce: 'pre',
        exclude: /(node_modules)/,
        loader: 'import-glob-loader',
        test: /\.(js|coffee)$/,
      },
      {
        // loader for preexisting global coffeescript
        exclude: [
          path.resolve(__dirname, 'resources/assets/coffee/react'),
        ],
        include: [
          path.resolve(__dirname, 'resources/assets/coffee'),
        ],
        test: /\.coffee$/,
        use: ['imports-loader?this=>window', 'coffee-loader'],
      },
      {
        // loader for import-based coffeescript
        include: [
          path.resolve(__dirname, 'resources/assets/coffee/react'),
          path.resolve(__dirname, 'resources/assets/lib'),
        ],
        test: /\.coffee$/,
        use: ['coffee-loader'],
      },
    ],
  },
  optimization: {
    runtimeChunk: {
      name: '/js/commons',
    },
    splitChunks: {
      cacheGroups: {
        commons: {
          chunks: 'initial',
          minChunks: 2,
          name: '/js/commons',
        },
      },
    },
  },
  plugins: [
    new webpack.DefinePlugin({
      'process.env.DOCS_URL': JSON.stringify(process.env.DOCS_URL || 'https://docs.ppy.sh'),
      'process.env.PAYMENT_SANDBOX': JSON.stringify(paymentSandbox),
      'process.env.SHOPIFY_DOMAIN': JSON.stringify(process.env.SHOPIFY_DOMAIN),
      'process.env.SHOPIFY_STOREFRONT_TOKEN': JSON.stringify(process.env.SHOPIFY_STOREFRONT_TOKEN),
    }),
  ],
  resolve: {
    alias: {
      '@fonts': path.resolve(__dirname, 'resources/assets/fonts'),
      'ziggy': path.resolve(__dirname, 'resources/assets/js/ziggy.js'),
      'ziggy-route': path.resolve(__dirname, 'vendor/tightenco/ziggy/dist/js/route.js'),
    },
    extensions: ['*', '.js', '.coffee', '.ts'],
    modules: [
      path.resolve(__dirname, 'resources/assets/coffee'),
      path.resolve(__dirname, 'resources/assets/lib'),
      path.resolve(__dirname, 'resources/assets/coffee/react/_components'),
      path.resolve(__dirname, 'node_modules'),
    ],
    plugins: [new TsconfigPathsPlugin()],
  },
};

if (mix.inProduction()) {
  webpackConfig.optimization.minimizer = [
    new TerserPlugin({
      sourceMap: true,
      terserOptions: {
        safari10: true,
      },
    }),
  ];
}

if (process.env.SENTRY_RELEASE === '1') {
  webpackConfig.plugins.push(
    new SentryPlugin({
      apiKey: process.env.SENTRY_API_KEY,
      organisation: process.env.SENTRY_ORG,
      project: process.env.SENTRY_PROJ,

      deleteAfterCompile: true,
      exclude: /\.css(\.map)?$/,
      filenameTransform: function(filename) {
        return '~' + filename;
      },
      release: function() {
        return process.env.GIT_SHA;
      },
    }),
  );
}

mix
.webpackConfig(webpackConfig)
.sourceMaps(true, 'source-map', 'source-map')
.js([
  'resources/assets/app.js',
], 'js/app.js')
.js(...reactComponentSet('artist-page'))
.js(...reactComponentSet('beatmap-discussions'))
.js(...reactComponentSet('beatmap-discussions-history'))
.js(...reactComponentSet('beatmapset-page'))
.js(...reactComponentSet('changelog-build'))
.js(...reactComponentSet('changelog-index'))
.js(...reactComponentSet('comments-index'))
.js(...reactComponentSet('comments-show'))
.js(...reactComponentSet('mp-history'))
.js(...reactComponentSet('modding-profile'))
.js(...reactComponentSet('profile-page'))
.js(...reactComponentSet('admin/contest'))
.js(...reactComponentSet('contest-entry'))
.js(...reactComponentSet('contest-voting'))
.ts('resources/assets/lib/account-edit.ts', 'js/react/account-edit.js')
.js('resources/assets/lib/beatmaps.ts', 'js/react/beatmaps.js')
.ts('resources/assets/lib/chat.ts', 'js/react/chat.js')
.ts('resources/assets/lib/friends-index.ts', 'js/react/friends-index.js')
.ts('resources/assets/lib/groups-show.ts', 'js/react/groups-show.js')
.ts('resources/assets/lib/news-index.ts', 'js/react/news-index.js')
.ts('resources/assets/lib/news-show.ts', 'js/react/news-show.js')
.ts('resources/assets/lib/notifications-index.ts', 'js/react/notifications-index.js')
.ts('resources/assets/lib/scores-show.ts', 'js/react/scores-show.js')
.ts('resources/assets/lib/store-bootstrap.ts', 'js/store-bootstrap.js')
.copy('node_modules/moment/locale', 'public/vendor/js/moment-locales')
.less('resources/assets/less/app.less', 'public/css')
.scripts([
  'resources/assets/js/ga.js',
  'resources/assets/build/lang.js',
  'resources/assets/js/bootstrap-lang.js',
], 'public/js/app-deps.js') // FIXME: less dumb name; this needs to be separated -
                            // compiling coffee and then concating together doesn't
                            // work so well when versioning is used with webpack.
.scripts(vendor, 'public/js/vendor.js');

// include locales in manifest
const locales = glob.sync('resources/assets/build/locales/*.js');
if (locales.length === 0) {
  throw new Error('missing locale files.');
}

for (const locale of locales) {
  mix.scripts([locale], `public/js/locales/${path.basename(locale)}`);
}

if (mix.inProduction()) {
  mix.version();
}
