/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

'use strict';

const { spawnSync } = require('child_process');
const fs = require('fs');
const glob = require('glob');
const path = require('path');
const mkdirp = require('mkdirp');

const buildPath = path.resolve(__dirname, 'resources/assets/build');
const localesPath = path.resolve(buildPath, 'locales');
const messagesPath = path.resolve(buildPath, 'messages.json');

function extractLanguages() {
  console.log('Extracting localizations...')
  const messages = getAllMesssages();

  const languages = new Map();
  for (const key in messages) {
    const index = key.indexOf('.');
    const language = key.substring(0, index);
    if (!languages.has(language)) {
      languages.set(language, {});
    }
    languages.get(language)[key] = messages[key];
  }

  return languages;
}

function getAllMesssages() {
  const content = fs.readFileSync(messagesPath);

  return JSON.parse(content);
}

function generateTranslations()
{
  spawnSync('php', ['artisan', 'lang:js', '--json', messagesPath], { stdio: 'inherit' });
}

function writeTranslations(languages)
{
  for (const lang of languages.keys()) {
    const json = JSON.stringify(languages.get(lang));
    const filename = path.resolve(localesPath, `${lang}.js`);
    const script = `(function() { 'use strict'; Object.assign(Lang.messages, ${json}); })();`;

    fs.writeFileSync(filename, script);
    console.log(`Created: ${filename}`);
  }
}

// Remove previous existing files and ensure directory exists.
glob.sync(path.resolve(localesPath, '*.js')).forEach(fs.unlinkSync);
mkdirp.sync(localesPath);

generateTranslations();
writeTranslations(extractLanguages());

// copy lang.js
fs.copyFileSync(
  path.resolve(__dirname, 'vendor/mariuzzo/laravel-js-localization/lib/lang.min.js'),
  path.resolve(buildPath, 'lang.js')
);

// cleanup
fs.unlinkSync(messagesPath);
console.log(`Removed: ${messagesPath}`);
