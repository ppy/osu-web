const webpackConfig = require('./webpack.config.js');
webpackConfig['devtool'] = 'inline-source-map';
delete webpackConfig.optimization.splitChunks;
delete webpackConfig.entry;

module.exports = function (config) {
  config.set({
    basePath: './resources/assets',
    frameworks: ['jasmine'],
    files: [
      '../../public/js/vendor.js',
      '../../public/js/app-deps.js',
      '../../public/js/locales/en.js',
      'tests/globals.js', // shims for tests
      'tests/tests.ts',
    ],
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
    preprocessors: {
      'tests/tests.ts': ['webpack', 'sourcemap'],
    },

    reporters: ['progress'],
    port: 9876,
    colors: true,
    logLevel: config.LOG_INFO,
    autoWatch: true,
    browsers: ['Chrome'],
    singleRun: false,
    concurrency: Infinity,
  });
};
