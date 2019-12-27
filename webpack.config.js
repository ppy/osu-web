
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

const routesFile = path.resolve(__dirname, 'routes/web.php');
const langDir = path.resolve(__dirname, 'resources/lang');

let resolved = false;

const watches = [
  {
    callback: () => {
      spawnSync('php', ['artisan', 'ziggy:generate'], spawnOptions);
    },
    path: routesFile,
    type: 'file',
  },
  {
    callback: () => {
      spawnSync('yarn', ['generate-localizations'], spawnOptions);
      // touching the file on first build might cause karma's watchers to fire after tests start.
      if (resolved) {
        spawnSync('touch', [path.resolve(__dirname, 'resources/assets/coffee/main.coffee')], spawnOptions);
      }
    },
    path: langDir,
    type: 'dir',
  },
]

function buildConfig() {
  require(Mix.paths.mix());
  Mix.dispatch('init', Mix);
  const WebpackConfig = require(path.resolve(mixPath, 'src/builder/WebpackConfig'));

  return new WebpackConfig().build();
}

function configPromise(env, argv) {
  return new Promise((resolve) => {
    const options = {
      // fire an aggregated event after 200ms on changes.
      aggregateTimeout: 200,
    };
    // same as webpack-cli's handling
    if (argv['watch-poll'] === 'true' || argv['watch-poll'] === '') options.poll = true;

    if (!argv.watch) {
      watches.forEach((watched) => {
        watched.callback();
      })

      return resolve(buildConfig());
    }

    const wp = new Watchpack(options);
    wp.watch(
      watches.filter(x => x.type === 'file').map(x => x.path),
      watches.filter(x => x.type === 'dir').map(x => x.path)
    ); // files and directories are different arguments.

    // directory watchers cause change events on start, file watchers don't;
    // run the callback for each file watcher once.
    watches.filter(x => x.type === 'file').forEach((watched) => {
      watched.callback();
      watched.ranOnce = true;
    })

    wp.on('aggregated', (changes, removals) => {
      watches.forEach((watched) => {
        if (changes.includes(watched.path) || removals.includes(watched.path)) {
          watched.callback();
          watched.ranOnce = true;
        }
      });

      // let webpack run after the first build.
      if (!resolved && watches.reduce((value, watched) => value && watched.ranOnce, true)) {
        resolved = true;
        resolve(buildConfig());
      }
    });
  });
}

module.exports = configPromise;
