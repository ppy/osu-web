// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

'use strict';

// karma-webpack doesn't exit on compile error.
// This plugin makes it exit on compile error.
class ExitOnErrorWebpackPlugin {
  apply(compiler) {
    compiler.hooks.done.tap('ExitOnErrorWebpackPlugin', (stats) => {
      if (stats && stats.hasErrors()) {
        stats.toJson().errors.forEach((error) => {
          console.error(error);
        });
        process.exit(1);
      }
    });
  }
}

/**
 * Blocks until the webpack config is read.
 */
function readWebpackConfig() {
  const yargs = require('yargs');
  const argv = yargs(process.argv).parse();

  if (!argv.singleRun) {
    argv.watch = true;
  }

  const configFn = require('./webpack.config.js');

  return configFn(null, argv);
}

process.env.SKIP_MANIFEST = true;
const webpackConfig = readWebpackConfig();
webpackConfig.plugins.push(new ExitOnErrorWebpackPlugin());
webpackConfig.mode = 'development';
webpackConfig.devtool = 'inline-source-map';
delete webpackConfig.optimization; // karma doesn't work with splitChunks...or runtimeChunk
delete webpackConfig.entry; // test runner doesn't use the entry points

const testIndex = './tests/karma/index.ts';

const files = [
  './tests/karma/globals.js', // shims for tests
  testIndex,
];

const preprocessors = {};
preprocessors[testIndex] = ['webpack', 'sourcemap'];

module.exports = function(config) {
  config.set({
    autoWatch: true,
    basePath: '.',
    customLaunchers: {
      ChromeHeadless: {
        base: 'ChromeHeadless',
        // chrome sandboxing does not work in every container runtime
        flags: process.env.CHROME_NO_SANDBOX ? ['--no-sandbox'] : [],
      },
    },
    colors: true,
    concurrency: Infinity,
    exclude: [],
    files,
    frameworks: ['jasmine', 'webpack'],
    logLevel: config.LOG_INFO,
    mime: { 'text/x-typescript': ['ts', 'tsx'] },
    port: 9876,
    preprocessors,
    reporters: ['mocha'],
    singleRun: false, // set to true for the process to exit after completing.
    webpack: webpackConfig,
    webpackMiddleware: {
      noInfo: true,
      stats: 'errors-only',
    },
  });
};
