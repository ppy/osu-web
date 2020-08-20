// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

'use strict';

const mix = require('laravel-mix');
const fs = require('fs');
const path = require('path');
const webpack = require('webpack');
const concatenate = require('concatenate');

const Autoprefixer = require('autoprefixer');
const CopyPlugin = require('copy-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const SentryPlugin = require('webpack-sentry-plugin');
const TsconfigPathsPlugin = require('tsconfig-paths-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');

const inProduction = process.env.NODE_ENV === 'production' || process.argv.includes('-p');

let min = '';
let reactMin = 'development';
if (inProduction) {
  min = '.min';
  reactMin = 'production.min';
}

const paymentSandbox = !(process.env.PAYMENT_SANDBOX === '0'
                         || process.env.PAYMENT_SANDBOX === 'false'
                         || !process.env.PAYMENT_SANDBOX);

// relative from root?
const nodeRoot = path.resolve(__dirname, 'node_modules');

const vendor = [
  'clipboard-polyfill/build/clipboard-polyfill.js',
  `url-polyfill/url-polyfill${min}.js`,
  'turbolinks/dist/turbolinks.js',
  `jquery/dist/jquery${min}.js`,
  'jquery-ujs/src/rails.js',
  `qtip2/dist/jquery.qtip${min}.js`,
  'jquery.scrollto/jquery.scrollTo.js',
  'jquery-ui/ui/data.js',
  'jquery-ui/ui/scroll-parent.js',
  'jquery-ui/ui/widget.js',
  'jquery-ui/ui/widgets/mouse.js',
  'jquery-ui/ui/widgets/slider.js',
  'jquery-ui/ui/widgets/sortable.js',
  'jquery-ui/ui/keycode.js',
  'timeago/jquery.timeago.js',
  'blueimp-file-upload/js/jquery.fileupload.js',
  'bootstrap/dist/js/bootstrap.js',
  'lodash/lodash.js',
  'layzr.js/dist/layzr.js',
  `react/umd/react.${reactMin}.js`,
  'react-dom-factories/index.js',
  `react-dom/umd/react-dom.${reactMin}.js`,
  `prop-types/prop-types${min}.js`,
  'photoswipe/dist/photoswipe.js',
  'photoswipe/dist/photoswipe-ui-default.js',
  `d3/dist/d3${min}.js`,
  'moment/moment.js',
  'js-cookie/src/js.cookie.js',
  `imagesloaded/imagesloaded.pkgd${min}.js`,
].map((name) => path.join(nodeRoot, name));

vendor.forEach(function(script) {
  if (!fs.existsSync(script)) {
    throw new Error(`${script} doesn't exist`);
  }
});

if (!fs.readdirSync('resources/assets/build/locales').some((file) => file.endsWith('.js'))) {
  throw new Error('missing locale files.');
}

const filesToConcat = {
  // FIXME: less dumb name; this needs to be separated -
  // compiling coffee and then concating together doesn't
  // work so well when versioning is used with webpack.
  'app-deps': [
    'resources/assets/js/ga.js',
    'resources/assets/build/lang.js',
    'resources/assets/js/bootstrap-lang.js',
  ],
  vendor: vendor,
};

// TODO: move to plugin for webpack
fs.mkdirSync('public/js', {recursive: true});
for (const key in filesToConcat) {
  const out = path.resolve(__dirname, `public/js/${key}.js`);
  console.log(`Writing concatenate output to: ${out}`);
  concatenate.sync(filesToConcat[key], out);
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

const webpackConfig = {
  mode: inProduction ? 'production' : 'development',
  devtool: 'source-map',
  entry: entry,
  output: {
    path: path.resolve(__dirname, 'public'),
  },
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
        test: /\.jsx?$/,
        exclude: /(node_modules|bower_components)/,
        use: [
          {
            loader: 'babel-loader',
            options: {
              presets: [
                [
                  '@babel/preset-env',
                  {
                    modules: false,
                    forceAllTransforms: true
                  }
                ]
              ],
              plugins: [
                '@babel/plugin-syntax-dynamic-import',
                '@babel/plugin-proposal-object-rest-spread',
                [
                  '@babel/plugin-transform-runtime',
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
                  plugins: [Autoprefixer],
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
        { from: 'resources/assets/build/locales', to: 'js/locales' },
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

if (inProduction) {
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
.webpackConfig(webpackConfig);

if (inProduction) {
  mix.version();
}
