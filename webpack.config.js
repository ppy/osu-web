
/**
 * As our first step, we'll pull in the user's webpack.mix.js
 * file. Based on what the user requests in that file,
 * a generic config object will be constructed for us.
 */

const path = require('path');
const currentPath = path.resolve(__dirname);
const mixPath = path.resolve(currentPath, 'node_modules/laravel-mix');
const { spawnSync } = require('child_process');
const Watchpack = require('watchpack');
const spawnOptions = { stdio: 'inherit' };

require(path.resolve(mixPath, 'src/index'));

Mix.paths.setRootPath(currentPath);

let ComponentFactory = require(path.resolve(mixPath, 'src/components/ComponentFactory'));
new ComponentFactory().installAll();

require(Mix.paths.mix());

/**
 * Just in case the user needs to hook into this point
 * in the build process, we'll make an announcement.
 */

Mix.dispatch('init', Mix);

/**
 * Now that we know which build tasks are required by the
 * user, we can dynamically create a configuration object
 * for Webpack. And that's all there is to it. Simple!
 */

let WebpackConfig = require(path.resolve(mixPath, 'src/builder/WebpackConfig'));
const config = new WebpackConfig().build();

function configPromise(env, argv) {
  return new Promise((resolve) => {
    const options = {
      // fire an aggregated event after 200ms on changes.
      aggregateTimeout: 200,
    };
    // same as webpack-cli's handling
    if (argv['watch-poll'] === 'true' || argv['watch-poll'] === '') options.poll = true;

    const routesFile = path.resolve(__dirname, 'routes/web.php');
    const langDir = path.resolve(__dirname, 'resources/lang');
    const wp = new Watchpack(options);

    wp.watch([routesFile], [langDir]);

    wp.on('aggregated', function (changes, removals) {
      if (changes.includes(routesFile) || removals.includes(routesFile)) {
        spawnSync('php', ['artisan', 'ziggy:generate'], spawnOptions);
      }

      if (changes.includes(langDir) || removals.includes(langDir)) {
        spawnSync('yarn', ['generate-localizations'], spawnOptions);
        spawnSync('touch', [path.resolve(__dirname, 'resources/assets/coffee/main.coffee')], spawnOptions);
      }

      // let webpack run after the first build.
      resolve(config);
    });
  });
}

module.exports = configPromise;
