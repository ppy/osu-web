// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

'use strict';

const fs = require('fs');
const path = require('path');
const { minify } = require('terser');
const webpack = require('webpack');
const loaderUtils = require('loader-utils');

const Autoprefixer = require('autoprefixer');
const CopyPlugin = require('copy-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const SentryPlugin = require('webpack-sentry-plugin');
const TsconfigPathsPlugin = require('tsconfig-paths-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');

const inProduction = process.env.NODE_ENV === 'production' || process.argv.includes('-p');
const paymentSandbox = !(process.env.PAYMENT_SANDBOX === '0'
                         || process.env.PAYMENT_SANDBOX === 'false'
                         || !process.env.PAYMENT_SANDBOX);

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
        let assetName = asset.name
        // ensure lookup name starts with / because mix helper is dumb.
        // also ensure assets are relative to root.
        if (!assetName.startsWith('/')) {
          assetName = `/${assetName}`;
        }

        let name = assetName;
        // remove hash from name.
        if (name.lastIndexOf('?') > 0) {
          // querystring version
          name = name.substring(0, name.lastIndexOf('?'));
        } else {
          // hash in filename version
          let extname = path.extname(name);
          let basename = name.substring(0, name.lastIndexOf(extname))
          if (extname === '.map') {
            extname = `${path.extname(basename)}.map`;
          }

          basename = name.substring(0, name.lastIndexOf(extname));
          basename = basename.substring(0, basename.lastIndexOf('.'));

          name = `${basename}${extname}`;
        }

        manifest[name] = assetName;
      })

      fs.writeFileSync(this.fileName, JSON.stringify(manifest, null, 2));
    });
  }
}

// TODO: move to own file
class ConcatPlugin {
  constructor(options = {}) {
    this.patterns = options.patterns;
    this.options = options.options || {};
  }

  apply(compiler) {
    const { RawSource, SourceMapSource } = require('webpack-sources');
    const concatenate = require('concatenate');

    const plugin = { name: 'ConcatPlugin' };

    compiler.hooks.thisCompilation.tap(plugin, (compilation) => {
      const logger = compilation.getLogger('concat-webpack-plugin');

      compilation.hooks.additionalAssets.tapAsync('concat-webpack-plugin', async (callback) => {
        const assets = this.patterns.map((pattern) => {
          let content = concatenate.sync(pattern.from);
          const webpackTo = loaderUtils.interpolateName(
            { resourcePath: path.resolve(compiler.options.output.path, pattern.to) },
            pattern.to,
            { content },
          );

          let source = content;
          let map = null;
          if (inProduction) {
            // TODO: move source map to optimization stage; also add sourcemap url
            const minified = minify(content, { sourceMap: true });
            source = minified.code;
            map = minified.map;
          }

          return {
            map,
            source,
            webpackTo,
          };
        });

        assets.forEach((asset) => {
          const {
            map,
            source,
            webpackTo,
          } = asset;

          const outputSource = map != null ? new SourceMapSource(source, webpackTo, map) : new RawSource(source);
          logger.log(`writing '${webpackTo}'`);
          compilation.emitAsset(`${webpackTo}`, outputSource);

          if (map != null) {
            compilation.emitAsset(`${webpackTo}.map`, new RawSource(map), { info: { development: true } });
          }
        });

        callback();
      });
    });
  }
}

// declare entrypoints and output first.
const entry = {
  'js/app': [
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

function chunkFilename(name, ext = 'js') {
  return outputFilename(name, ext, 'chunkhash:8');
}

function outputFilename(name, ext = 'js', hashType = 'contenthash:8') {
  return `${name}.${ext}?id=[${hashType}]`;
  // return `${name}.[${hashType}].${ext}`;
}

const output = {
  chunkFilename: chunkFilename('[name]'),
  filename:  outputFilename('[name]'),
  path: path.resolve(__dirname, 'public'),
};

const plugins = (function() {
  const concatPlugin = (function() {
    let min = '';
    let reactMin = 'development';
    if (inProduction) {
      min = '.min';
      reactMin = 'production.min';
    }

    // vendor and locale files.
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
    ].map((name) => path.join(path.resolve(__dirname, 'node_modules'), name));

    vendor.forEach(function(script) {
      if (!fs.existsSync(script)) {
        throw new Error(`${script} doesn't exist`);
      }
    });

    if (!fs.readdirSync('resources/assets/build/locales').some((file) => file.endsWith('.js'))) {
      throw new Error('missing locale files.');
    }

    return new ConcatPlugin({
      patterns: [
        {
          from: vendor, to: outputFilename('js/vendor'),
        },
      ],
    });
  }());

  const copyPlugin = new CopyPlugin({
    patterns: [
      { from: 'resources/assets/build/locales', to: outputFilename('js/locales/[name]', '[ext]') },
      { from: 'node_modules/@fortawesome/fontawesome-free/webfonts', to: outputFilename('vendor/fonts/font-awesome/[name]', '[ext]') },
      { from: 'node_modules/photoswipe/dist/default-skin', to: outputFilename('vendor/_photoswipe-default-skin/[name]', '[ext]') },
      { from: 'node_modules/moment/locale', to: outputFilename('vendor/js/moment-locales/[name]', '[ext]') },
    ],
  });

  return [
    new webpack.DefinePlugin({
      'process.env.DOCS_URL': JSON.stringify(process.env.DOCS_URL || 'https://docs.ppy.sh'),
      'process.env.PAYMENT_SANDBOX': JSON.stringify(paymentSandbox),
      'process.env.SHOPIFY_DOMAIN': JSON.stringify(process.env.SHOPIFY_DOMAIN),
      'process.env.SHOPIFY_STOREFRONT_TOKEN': JSON.stringify(process.env.SHOPIFY_STOREFRONT_TOKEN),
    }),
    new MiniCssExtractPlugin({
      chunkFilename: outputFilename('css/app', 'css'),
      filename: outputFilename('css/app', 'css'),
    }),
    concatPlugin,
    copyPlugin,
    new Manifest({ fileName: 'public/mix-manifest.json'}),
  ];
}());

const webpackConfig = {
  devtool: 'source-map',
  entry,
  externals: {
    'd3': 'd3',
    'lodash': '_',
    'moment': 'moment',
    'prop-types': 'PropTypes',
    'react': 'React',
    'react-dom': 'ReactDOM',
    'react-dom-factories': 'ReactDOMFactories',
  },
  mode: inProduction ? 'production' : 'development',
  module: {
    rules: [
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
          {
            loader: 'css-loader',
            options: {
              importLoaders: 1,
              sourceMap: true,
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
                if (!/node_modules|bower_components/.test(filepath)) {
                  return '/images/[name].[ext]?[hash]';
                }

                const cleanPath = filepath
                  .replace(/\\/g, '/')
                  .replace(/((.*(node_modules|bower_components))|images|image|img|assets)\//g, '');

                return `/images/vendor/${cleanPath}?[hash]`;
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
            if (!/node_modules|bower_components/.test(filepath)) {
              return '/fonts/[name].[ext]?[hash]';
            }

            const cleanPath = filepath
              .replace(/\\/g, '/')
              .replace(/((.*(node_modules|bower_components))|fonts|font|assets)\//g, '');

            return `/fonts/vendor/${cleanPath}?[hash]`;
          },
        },
        test: /(\.(woff2?|ttf|eot|otf)$|font.*\.svg$)/,
      },
    ],
  },
  optimization: {
    moduleIds: 'hashed',
    runtimeChunk: {
      name: 'js/commons',
    },
    splitChunks: {
      cacheGroups: {
        commons: {
          chunks: 'initial',
          minChunks: 2,
          name: 'js/commons',
        },
      },
    },
  },
  output,
  plugins,
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
  stats: {
    entrypoints: false,
    errorDetails: false,
    excludeAssets: [
      // exclude copied files
      /^js\/locales\//,
      /^\/fonts\//,
      /^vendor\//,
    ],
  }
};

if (inProduction) {
  webpackConfig.optimization.minimizer = [
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

module.exports = webpackConfig;
