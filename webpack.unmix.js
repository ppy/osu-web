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
  return `${name}.[${hashType}].${ext}`;
}

function resolvePath(...segments) {
  return path.resolve(__dirname, ...segments);
}

// #endregion

// #region Custom plugins
// Custom manifest dumper
// Dumps a manifest file for hashless asset name lookups outside of webpack.
// Uses asset name only unlike webpack-manifest-plugin which prefers chunk name first.
// webpack-assets-manifest is better but doesn't include assets from copy-webpack-plugin
// https://github.com/webdeveric/webpack-assets-manifest/issues/49
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
        if (!(name.startsWith('js/') || name.startsWith('css/'))) return;
        if (name.endsWith('.map')) return;

        // remove hash from name.
        if (name.lastIndexOf('?') > 0) {
          // querystring version
          name = name.substring(0, name.lastIndexOf('?'));
        } else {
          // hash in filename version
          const extname = path.extname(name);
          let basename = name.substring(0, name.lastIndexOf(extname));
          basename = basename.substring(0, basename.lastIndexOf('.'));

          name = `${basename}${extname}`;
        }

        manifest[name] = path.join(compiler.options.output.publicPath, asset.name);
      });

      // directory might not exist when using webpack-dev-server because it
      // doesn't write to the same location as the manifest file.
      const dirname = path.dirname(this.fileName);
      if (!fs.existsSync(dirname)) {
        fs.mkdirSync(dirname, { recursive: true });
      }

      fs.writeFileSync(this.fileName, JSON.stringify(manifest, null, 2));
    });
  }
}

// #endregion

// #region entrypoints and output
const entry = {
  app: [
    './resources/assets/less/app.less',
  ],
};

const entrypointsPath = 'resources/assets/lib/entrypoints';
const supportedExts = new Set(['.coffee', '.ts', '.tsx']);
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

const output = {
  filename: outputFilename('js/[name]', 'js'),
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
  new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/), // don't add moment locales to bundle.
  new MiniCssExtractPlugin({
    filename: outputFilename('css/[name]', 'css'),
  }),
  new CopyPlugin({
    patterns: [
      { from: 'resources/assets/build/locales', to: outputFilename('js/locales/[name]') },
      { from: 'node_modules/moment/locale', to: outputFilename('js/moment-locales/[name]') },
      { from: 'node_modules/twemoji-emojis/vendor/svg/*-*.svg', to: 'images/flags/[name].[ext]' },
    ],
  }),
];

if (writeManifest) {
  plugins.push(new Manifest({ fileName: path.join(output.path, 'manifest.json') }));
}

// TODO: should have a different flag for this
if (!inProduction) {
  // there is an issue (bug?) where assets loaded via file-loader don't show up in the stats
  // when recompiling css so they end up being considered stale.
  plugins.push(new CleanWebpackPlugin({ cleanStaleWebpackAssets: false }));
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
    loaders: [
      {
        loader: 'file-loader',
        options: {
          name: outputFilename('images/[name]'),
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
      name: outputFilename('fonts/[name]'),
    },
    test: /(\.(woff2?|ttf|eot|otf)$|font.*\.svg$)/,
  },
];

// #endregion

// #region resolvers
const resolve = {
  alias: {
    '@fonts': path.resolve(__dirname, 'resources/assets/fonts'),
    '@images': path.resolve(__dirname, 'public/images'),
    layzr: resolvePath('node_modules/layzr.js/dist/layzr.module.js'),
    ziggy: resolvePath('resources/assets/js/ziggy.js'),
    'ziggy-route': resolvePath('vendor/tightenco/ziggy/dist/index.es.js'),
  },
  extensions: ['*', '.js', '.coffee', '.ts', '.tsx'],
  modules: [
    resolvePath('resources/assets/lib'),
    resolvePath('resources/assets/coffee'),
    resolvePath('node_modules'),
  ],
  plugins: [new TsconfigPathsPlugin()],
};

// #endregion

// #region optimization and chunk splitting settings
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
    test: (module) => module.resource && module.resource.includes(`${path.sep}node_modules${path.sep}`),
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
