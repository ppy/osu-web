// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

'use strict';

//#region plugin imports
const Autoprefixer = require('autoprefixer');
const CopyPlugin = require('copy-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const SentryPlugin = require('webpack-sentry-plugin');
const TsconfigPathsPlugin = require('tsconfig-paths-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');

//#endregion

// #region non-plugin imports
const fs = require('fs');
const path = require('path');
const webpack = require('webpack');

//#endregion

//#region env
const inProduction = process.env.NODE_ENV === 'production' || process.argv.includes('-p');
const paymentSandbox = !(process.env.PAYMENT_SANDBOX === '0'
                         || process.env.PAYMENT_SANDBOX === 'false'
                         || !process.env.PAYMENT_SANDBOX);

//#endregion

//#region helpers
function outputFilename(name, ext = 'js', hashType = 'contenthash:8') {
  return `${name}.${ext}?id=[${hashType}]`;
  // return `${name}.[${hashType}].${ext}`;
}

function resolvePath(...segments) {
  return path.resolve(__dirname, ...segments);
}

//#endregion

//#region Custom plugins
// Custom manifest dumper
// Dumps a manifest file and:
// Strip the hashes out - the problem is when adding assets via additionalAssets, as the copy and concat plugins do,
// we currently don't have the option to change th asset name to be different from the file name.
// Prefix the manifest keys with / - the existing php mix helper doesn't work properly without them.
class Manifest {
  constructor(options = {}) {
    this.fileName = options.fileName;
  }

  apply(compiler) {
    compiler.hooks.afterEmit.tap({ name: 'Manifest' }, (compilation) => {
      const json = compilation.getStats().toJson({
        // Disable data generation of everything we don't use
        all: false,
        // Add asset Information
        assets: true,
        // Show cached assets (setting this to `false` only shows emitted files)
        cachedAssets: true,
      });

      const manifest = {};
      json.assets.forEach((asset) => {
        let name = asset.name;
        // remove hash from name.
        if (name.lastIndexOf('?') > 0) {
          // querystring version
          name = name.substring(0, name.lastIndexOf('?'));
        } else {
          // hash in filename version
          let extname = path.extname(name);
          let basename = name.substring(0, name.lastIndexOf(extname));
          if (extname === '.map') {
            extname = `${path.extname(basename)}.map`;
          }

          basename = name.substring(0, name.lastIndexOf(extname));
          basename = basename.substring(0, basename.lastIndexOf('.'));

          name = `${basename}${extname}`;
        }

        manifest[name] = path.join(compiler.options.output.publicPath, asset.name);
      });

      fs.writeFileSync(this.fileName, JSON.stringify(manifest, null, 2));
    });
  }
}

//#endregion

//#region entrypoints and output
const entry = {
  'app': [
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
  entry[`react/${name}`] = [resolvePath(`resources/assets/coffee/react/${name}.coffee`)];
}

for (const name of tsReactComponents) {
  entry[`react/${name}`] = [resolvePath(`resources/assets/lib/${name}.ts`)];
}

const output = {
  filename: outputFilename('js/[name]'),
  path: resolvePath('public'),
  publicPath: '/',
};

//#endregion

//#region plugin list
const plugins = [
  new webpack.ProvidePlugin({
    $: 'jquery',
    _: 'lodash',
    Cookies: 'js-cookie',
    d3: 'd3', // TODO: d3 is fat and probably should have it's own chunk
    jQuery: 'jquery',
    moment: 'moment',
    React: 'react',
    ReactDOM: 'react-dom',
    Turbolinks: 'turbolinks',
  }),
  new webpack.DefinePlugin({
    'process.env.DOCS_URL': JSON.stringify(process.env.DOCS_URL || 'https://docs.ppy.sh'),
    'process.env.PAYMENT_SANDBOX': JSON.stringify(paymentSandbox),
    'process.env.SHOPIFY_DOMAIN': JSON.stringify(process.env.SHOPIFY_DOMAIN),
    'process.env.SHOPIFY_STOREFRONT_TOKEN': JSON.stringify(process.env.SHOPIFY_STOREFRONT_TOKEN),
  }),
  new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/), // don't add moment locales to bundle.
  new MiniCssExtractPlugin({
    filename: outputFilename('css/[name]', 'css'),
  }),
  new CopyPlugin({
    patterns: [
      { from: 'resources/assets/build/locales', to: outputFilename('js/locales/[name]', '[ext]') },
      { from: 'node_modules/moment/locale', to: outputFilename('js/moment-locales/[name]', '[ext]') },
    ],
  }),
  new Manifest({ fileName: 'public/mix-manifest.json'}),
];

if (process.env.SENTRY_RELEASE === '1') {
  plugins.push(
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

//#endregion

//#region Loader rules
const rules = [
  {
    enforce: 'pre',
    exclude: /(node_modules)/,
    loader: 'import-glob-loader',
    test: /\.(js|coffee)$/,
  },
  {
    exclude: /(node_modules|bower_components)/,
    test: /\.jsx?$/,
    use: [
      {
        loader: 'babel-loader',
        options: {
          cacheDirectory: true,
          plugins: [
            '@babel/plugin-syntax-dynamic-import',
            '@babel/plugin-proposal-object-rest-spread',
            [
              '@babel/plugin-transform-runtime',
              {
                helpers: false,
              },
            ],
          ],
          presets: [
            [
              '@babel/preset-env',
              {
                forceAllTransforms: true,
                modules: false,
              },
            ],
          ],
        },
      },
    ],
  },
  {
    exclude: /node_modules/,
    loader: 'ts-loader',
    test: /\.tsx?$/,
  },
  {
    // loader for preexisting global coffeescript
    exclude: [
      resolvePath('resources/assets/coffee/react'),
    ],
    include: [
      resolvePath('resources/assets/coffee'),
    ],
    test: /\.coffee$/,
    use: ['imports-loader?jQuery=jquery,$=jquery,this=>window', 'coffee-loader'],
  },
  {
    // loader for import-based coffeescript
    include: [
      resolvePath('resources/assets/coffee/react'),
      resolvePath('resources/assets/lib'),
    ],
    test: /\.coffee$/,
    use: ['coffee-loader'],
  },
  {
    test: /\.less$/,
    use: [
      MiniCssExtractPlugin.loader,
      {
        loader: 'css-loader',
        options: {
          importLoaders: 1,
          sourceMap: true,
          // url-loader didn't try to resolve aboslute paths before 4.1
          // https://github.com/webpack-contrib/css-loader/commit/f9ba0ce11789770c4c9220478e9c98dbd432a5d6
          url: (url) => !url.startsWith('/'),
        },
      },
      {
        loader: 'postcss-loader',
        options: {
          plugins: [Autoprefixer],
          sourceMap: true,
        },
      },
      { loader: 'less-loader', options: { sourceMap: true } },
    ],
  },
  {
    loaders: [
      {
        loader: 'file-loader',
        options: {
          name: (filepath) => {
            return outputFilename('images/[name]', '[ext]');
          },
        },
      },
      {
        loader: 'img-loader',
      },
    ],
    test: /(\.(png|jpe?g|gif|webp)$|^((?!font).)*\.svg$)/,
  },
  {
    loader: 'file-loader',
    options: {
      name: (filepath) => {
        return outputFilename('fonts/[name]', '[ext]');
      },
    },
    test: /(\.(woff2?|ttf|eot|otf)$|font.*\.svg$)/,
  },
];

//#endregion

//#region resolvers
const resolve = {
  alias: {
    '@fonts': path.resolve(__dirname, 'resources/assets/fonts'),
    'layzr': resolvePath('node_modules/layzr.js/dist/layzr.module.js'),
    'ziggy': resolvePath('resources/assets/js/ziggy.js'),
    'ziggy-route': resolvePath('vendor/tightenco/ziggy/dist/js/route.js'),
  },
  extensions: ['*', '.js', '.coffee', '.ts', '.tsx'],
  modules: [
    resolvePath('resources/assets/coffee'),
    resolvePath('resources/assets/lib'),
    resolvePath('resources/assets/coffee/react/_components'),
    resolvePath('node_modules'),
  ],
  plugins: [new TsconfigPathsPlugin()],
};

//#endregion

//#region optimization and chunk splitting settings
const cacheGroups = {
  commons: {
    chunks: 'initial',
    minChunks: 2,
    name: 'commons',
    priority: -20,
  },
  vendor: {
    chunks: 'initial',
    name: 'vendor',
    priority: -10,
    reuseExistingChunk: true,
    test: (module, chunks) => {
      // Doing it this way doesn't split the css imported via app.less from the main css bundle.
      return module.resource && module.resource.includes(`${path.sep}node_modules${path.sep}`);
    },
  },
};

const optimization = {
  moduleIds: 'hashed',
  runtimeChunk: {
    name: 'runtime',
  },
  splitChunks: {
    cacheGroups,
  },

};

if (inProduction) {
  optimization.minimizer = [
    new TerserPlugin({
      sourceMap: true,
      terserOptions: {
        safari10: true,
      },
    }),
    new CssMinimizerPlugin({
      sourceMap: true,
    }),
  ];
}

//#endregion

module.exports = {
  devtool: 'source-map',
  entry,
  mode: inProduction ? 'production' : 'development',
  module: {
    rules,
  },
  optimization,
  output,
  plugins,
  resolve,
  stats: {
    entrypoints: false,
    errorDetails: false,
    excludeAssets: [
      // exclude copied files
      /^js\/(moment-locales|locales)\//,
      /^fonts/,
      /^images/,
    ],
  },
};
