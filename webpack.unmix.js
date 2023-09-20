// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

'use strict';

// built-in imports
const fs = require('fs');
const path = require('path');

const Autoprefixer = require('autoprefixer');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const dotenv = require('dotenv');
const ForkTsCheckerWebpackPlugin = require('fork-ts-checker-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const TsconfigPathsPlugin = require('tsconfig-paths-webpack-plugin');
const webpack = require('webpack');
const { WebpackManifestPlugin } = require('webpack-manifest-plugin');
const SentryPlugin = require('webpack-sentry-plugin');

// #region env
const env = process.env.NODE_ENV || 'development';
dotenv.config({ path: `.env.${env}` });
dotenv.config();

const inProduction = env === 'production' || process.argv.includes('-p');

const writeManifest = !(process.env.SKIP_MANIFEST === '1'
                        || process.env.SKIP_MANIFEST === 'true'
                        || process.env.SKIP_MANIFEST);
// #endregion

// #region helpers
// Most plugins should follow webpack's own interpolation format:
// https://github.com/webpack/loader-utils#interpolatename
function outputFilename(name, ext = '[ext]', hashType = 'contenthash:8') {
  return `${name}.[${hashType}]${ext}`;
}

function resolvePath(...segments) {
  return path.resolve(__dirname, ...segments);
}

// #endregion

// #region entrypoints and output
const entry = {};
const entrypointDirs = [
  'resources/css/entrypoints',
  'resources/js/entrypoints',
];
const supportedExts = new Set(['.coffee', '.less', '.ts', '.tsx']);
for (const entrypointsPath of entrypointDirs) {
  fs.readdirSync(resolvePath(entrypointsPath), { withFileTypes: true }).forEach((item) => {
    if (item.isFile()) {
      const filename = item.name;
      const ext = path.extname(filename);

      if (supportedExts.has(ext)) {
        const entryName = path.basename(filename, ext);

        if (entry[entryName] == null) {
          entry[entryName] = [];
        }
        entry[entryName].push(resolvePath(entrypointsPath, filename));
      }
    }
  });
}

const output = {
  filename: outputFilename('js/[name]', '.js'),
  path: resolvePath('public/assets'),
  publicPath: '/assets/',
};

// #endregion

// #region plugin list
const plugins = [
  new ForkTsCheckerWebpackPlugin(),
  new webpack.ProvidePlugin({
    $: 'jquery',
    _: 'lodash',
    d3: 'd3', // TODO: d3 is fat and probably should have it's own chunk
    jQuery: 'jquery',
    moment: 'moment',
    React: 'react',
    ReactDOM: 'react-dom',
    Turbolinks: 'turbolinks',
  }),
  new webpack.DefinePlugin({
    'process.env.DOCS_URL': JSON.stringify(process.env.DOCS_URL || 'https://docs.ppy.sh'),
  }),
  new webpack.IgnorePlugin({
    // don't add moment locales to bundle.
    contextRegExp: /moment$/,
    resourceRegExp: /^\.\/locale$/,
  }),
  new MiniCssExtractPlugin({
    filename: outputFilename('css/[name]', '.css'),
  }),
  new CopyPlugin({
    patterns: [
      { from: 'resources/builds/locales', to: outputFilename('js/locales/[name]') },
      { from: 'node_modules/moment/locale', to: outputFilename('js/moment-locales/[name]') },
      { from: 'node_modules/@discordapp/twemoji/dist/svg/*-*.svg', to: 'images/flags/[name][ext]' },
    ],
  }),
];

if (writeManifest) {
  plugins.push(new WebpackManifestPlugin({
    filter: (file) => file.path.match(/^\/assets\/(?:css|js)\/.*\.(?:css|js)$/) !== null,
    map: (file) => {
      const baseDir = file.path.match(/^\/assets\/(css|js)\//)?.[1];
      if (baseDir !== null && !file.name.startsWith(`${baseDir}/`)) {
        file.name = `${baseDir}/${file.name}`;
      }

      return file;
    },
  }));
}

// TODO: should have a different flag for this
if (!inProduction) {
  plugins.push(new CleanWebpackPlugin());
}

if (process.env.SENTRY_RELEASE === '1') {
  plugins.push(
    new SentryPlugin({
      apiKey: process.env.SENTRY_API_KEY,
      deleteAfterCompile: true,
      exclude: /\.css(\.map)?$/,
      filenameTransform(filename) {
        return path.join('~', filename);
      },
      organisation: process.env.SENTRY_ORG,
      project: process.env.SENTRY_PROJ,
      release: process.env.GIT_SHA,
    }),
  );
}

const notifierConfigPath = resolvePath('.webpack-build-notifier-config.js');
if (fs.existsSync(notifierConfigPath)) {
  const WebpackBuildNotifierPlugin = require('webpack-build-notifier');
  plugins.push(new WebpackBuildNotifierPlugin(require(notifierConfigPath)));
}

// #endregion

// #region Loader rules
const rules = [
  {
    exclude: /node_modules/,
    loader: 'ts-loader',
    options: {
      transpileOnly: true,
    },
    test: /\.tsx?$/,
  },
  {
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
    generator: {
      filename: outputFilename('images/[name]'),
    },
    test: /(\.(png|jpe?g|gif|webp)$|^((?!font).)*\.svg$)/,
    type: 'asset/resource',
  },
  {
    generator: {
      filename: outputFilename('fonts/[name]'),
    },
    test: /(\.(woff2?|ttf|eot|otf)$|font.*\.svg$)/,
    type: 'asset/resource',
  },
];

// #endregion

// #region resolvers
const resolve = {
  alias: {
    '@fonts': path.resolve(__dirname, 'resources/fonts'),
    '@images': path.resolve(__dirname, 'public/images'),
    'ziggy-route': resolvePath('vendor/tightenco/ziggy/dist/index.es.js'),
  },
  extensions: ['*', '.js', '.coffee', '.ts', '.tsx'],
  modules: [
    resolvePath('resources/builds'),
    resolvePath('resources/js'),
    resolvePath('node_modules'),
  ],
  plugins: [new TsconfigPathsPlugin()],
};

// #endregion

// #region optimization and chunk splitting settings
function partialPathCheck(pathCheck, partialPathArray) {
  return pathCheck.includes(['', ...partialPathArray, ''].join(path.sep));
}

const docsOnlyLibraries = [
  ['node_modules', 'highlight.js'],
  ['node_modules', 'jets'],
];

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
    // Doing it this way doesn't split the css imported via app.less from the main css bundle.
    test: (module) => module.resource && (
      partialPathCheck(module.resource, ['node_modules'])
      && docsOnlyLibraries.every((p) => !partialPathCheck(module.resource, p))
    ),
  },
};

const optimization = {
  moduleIds: 'deterministic',
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
      terserOptions: {
        safari10: true,
        sourceMap: true,
      },
    }),
    new CssMinimizerPlugin(),
  ];
}

// #endregion

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
