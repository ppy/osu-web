// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

'use strict';

const mix = require('laravel-mix');
const fs = require('fs');
const path = require('path');
const webpack = require('webpack');
const CopyPlugin = require('copy-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
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
  devtool: 'source-map',
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
        test: /\\.jsx?$/,
        exclude: /(node_modules|bower_components)/,
        use: [
          {
            loader: 'babel-loader',
            options: {
              presets: [
                [
                  'node_modules/@babel/preset-env/lib/index.js',
                  {
                    modules: false,
                    forceAllTransforms: true
                  }
                ]
              ],
              plugins: [
                'node_modules/@babel/plugin-syntax-dynamic-import/lib/index.js',
                'node_modules/@babel/plugin-proposal-object-rest-spread/lib/index.js',
                [
                  'node_modules/@babel/plugin-transform-runtime/lib/index.js',
                  {
                    helpers: false
                  }
                ]
              ],
              cacheDirectory: true
            }
          }
        ]
      },
      {
        test: /\.tsx?$/,
        loader: 'ts-loader',
        exclude: /node_modules/,
        include: [path.resolve(__dirname, 'resources/assets/lib')],
        options: {
          appendTsSuffixTo: [
            /\.vue$/
          ]
        }
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
      {
        test: /\.less$/,
          use: [
              MiniCssExtractPlugin.loader,
              // { loader: 'style-loader' },
              { loader: 'css-loader', options: { url: true, sourceMap: true, importLoaders: 1 } },
              {
                loader: 'postcss-loader',
                options: {
                  sourceMap: true,
                  ident: 'postcss0', // TODO: do we need this?
                  plugins: [
                    require('autoprefixer')
                  ],
                },
              },
              { loader: 'less-loader', options: { sourceMap: true } },
          ],
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
    new MiniCssExtractPlugin({
      filename: '/css/app.css',
      chunkFilename: '/css/app.css',
    }),
    new CopyPlugin({
      patterns: [
        { from: 'node_modules/@fortawesome/fontawesome-free/webfonts', to: 'vendor/fonts/font-awesome' },
        { from: 'node_modules/photoswipe/dist/default-skin', to: 'vendor/_photoswipe-default-skin' },
        { from: 'node_modules/moment/locale', to: 'vendor/js/moment-locales' },
      ],
    }),
  ],
  resolve: {
    alias: {
      'ziggy': path.resolve(__dirname, 'resources/assets/js/ziggy.js'),
      'ziggy-route': path.resolve(__dirname, 'vendor/tightenco/ziggy/dist/js/route.js'),
    },
    extensions: ['*', '.js', '.coffee', '.ts', '.tsx'],
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

const entry = {
  '/js/app': [
    './resources/assets/app.js',
    './resources/assets/less/app.less',
  ],
};

const coffeeReactComponents = [
  'artist-page',
  'beatmap-discussions',
  'beatmap-discussions-history',
  'beatmapset-page',
  'changelog-build',
  'changelog-index',
  'comments-index',
  'comments-show',
  'mp-history',
  'modding-profile',
  'profile-page',
  'admin/contest',
  'contest-entry',
  'contest-voting',
];

const tsReactComponents = [
  'account-edit',
  'beatmaps',
  'chat',
  'friends-index',
  'groups-show',
  'news-index',
  'news-show',
  'notifications-index',
  'scores-show',
  'store-bootstrap',
];

for (const name of coffeeReactComponents) {
  entry[`js/react/${name}`] = [path.resolve(__dirname, `resources/assets/coffee/react/${name}.coffee`)];
}

for (const name of tsReactComponents) {
  entry[`js/react/${name}`] = [path.resolve(__dirname, `resources/assets/lib/${name}.ts`)];
}

webpackConfig.entry = entry;

mix
.webpackConfig(webpackConfig)
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
