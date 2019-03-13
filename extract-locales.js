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

const fs = require('fs');
const path = require('path');

function extract() {
  const json = getAllMesssages();

  const langs = new Map();
  for (const key in json) {
    const index = key.indexOf('.');
    const lang = key.substring(0, index);
    if (!langs.has(lang)) {
      langs.set(lang, {});
    }
    langs.get(lang)[key] = json[key];
  }

  for (const lang of langs.keys()) {
    filename = path.resolve(__dirname, `resources/assets/locales/${lang}.json`);
    fs.writeFileSync(filename, JSON.stringify(langs.get(lang)));
  }
}

function getAllMesssages() {
  const messagesFile = path.resolve(__dirname, 'resources/assets/locales/messages.json');
  const content = fs.readFileSync(messagesFile);

  return JSON.parse(content);
}

module.exports = {
  extract: extract,
};
