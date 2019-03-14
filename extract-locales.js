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

const fs = require('fs');
const path = require('path');
const mkdirp = require('mkdirp');

const buildPath = path.resolve(__dirname, 'resources/assets/build');
const localesPath = path.resolve(buildPath, 'locales');
const messagesPath = path.resolve(buildPath, 'messages.json');

function extract() {
  console.log('Extracting localizations...')
  mkdirp.sync(localesPath);

  const messages = getAllMesssages();

  const langs = new Map();
  for (const key in messages) {
    const index = key.indexOf('.');
    const lang = key.substring(0, index);
    if (!langs.has(lang)) {
      langs.set(lang, {});
    }
    langs.get(lang)[key] = messages[key];
  }

  for (const lang of langs.keys()) {
    const json = JSON.stringify(langs.get(lang));
    const script = `
(function() {
  'use strict';
  if (typeof(Lang) === 'function') { Lang = new Lang(); Lang.setMessages({}); }
  Object.assign(Lang.messages, ${json});
})();
`;

    const filename = path.resolve(localesPath, `${lang}.js`);
    fs.writeFileSync(filename, script);
    console.log(`Created: ${filename}`);
  }

  // copy lang.js
  fs.copyFileSync(
    path.resolve(__dirname, 'vendor/mariuzzo/laravel-js-localization/lib/lang.min.js'),
    path.resolve(__dirname, 'resources/assets/js/lang.js')
  );
}

function getAllMesssages() {
  const content = fs.readFileSync(messagesPath);

  return JSON.parse(content);
}

const { spawnSync } = require('child_process');
spawnSync('php', ['artisan', 'lang:js', '--json', messagesPath], { stdio: 'inherit' });
extract();
