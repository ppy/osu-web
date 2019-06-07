const webpackConfig = require('./webpack.config.js');
webpackConfig['mode'] = 'development';
webpackConfig['devtool'] = 'inline-source-map';
delete webpackConfig.optimization.splitChunks; // karma doesn't work with splitChunks
delete webpackConfig.entry; // test runner doesn't use the entry points

const testIndex = 'resources/assets/tests/index.ts';

const files = [
  'public/js/vendor.js',
  'public/js/app-deps.js',
  'public/js/locales/en.js',
  'resources/assets/tests/globals.js', // shims for tests
  testIndex,
];

const preprocessors = {};
preprocessors[testIndex] = ['webpack', 'sourcemap'];

module.exports = function (config) {
  config.set({
    basePath: '.',
    frameworks: ['jasmine'],
    files: files,
    exclude: [],
    // client: {
    //   clearContext: false
    // },
    mime: { 'text/x-typescript': ['ts', 'tsx'] },
    webpack: webpackConfig,
    webpackMiddleware: {
      noInfo: false,
      // stats: 'errors-only'
    },
    preprocessors: preprocessors,
    reporters: ['progress'],
    port: 9876,
    colors: true,
    logLevel: config.LOG_INFO,
    autoWatch: true,
    concurrency: Infinity,

    // browsers: ['Chrome'],
    // singleRun: false,

    browsers: ['ChromeHeadless'],
    singleRun: false,
  });
};
