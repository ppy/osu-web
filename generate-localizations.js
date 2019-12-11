/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

'use strict';

const { spawnSync } = require('child_process');
const fs = require('fs');
const glob = require('glob');
const path = require('path');

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
    const json = languages.get(lang);
    delete json[`${lang}.mail`];
    const jsonString = JSON.stringify(json);
    const filename = path.resolve(localesPath, `${lang}.js`);
    const script = `(function() { 'use strict'; Object.assign(Lang.messages, ${jsonString}); })();`;

    fs.writeFileSync(filename, script);
    console.log(`Created: ${filename}`);
  }
}

// Remove previous existing files and ensure directory exists.
glob.sync(path.resolve(localesPath, '*.js')).forEach(fs.unlinkSync);
fs.mkdirSync(localesPath, {recursive: true});

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
