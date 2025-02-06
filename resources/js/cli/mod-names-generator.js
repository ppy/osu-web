// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

'use strict';

const fs = require('fs');

const root = `${__dirname}/../../..`;

function modNamesGenerator() {
  const modsByRuleset = JSON.parse(fs.readFileSync(`${root}/database/mods.json`));

  const modNames = {};
  for (const mods of modsByRuleset) {
    let rulesetId = mods.RulesetID;
    for (const [i, mod] of mods.Mods.entries()) {
      modNames[mod.Acronym] ??= {
        acronym: mod.Acronym,
        index: {},
        name: mod.Name,
        setting_labels: {},
        type: mod.Type,
      };
      for (const setting of mod.Settings) {
        modNames[mod.Acronym].setting_labels[setting.Name] = setting.Label;
      }
      modNames[mod.Acronym].index[rulesetId] = i;
    }
  }

  // extra for mod icons
  modNames.V2 = {
    acronym: 'V2',
    index: {},
    name: 'Score V2',
    setting_labels: {},
    type: 'Conversion',
  };
  modNames.NM = {
    acronym: 'NM',
    index: {},
    name: 'No Mod',
    setting_labels: {},
    type: 'Conversion', // not really relevant
  };

  const outDir = `${root}/resources/builds`;
  fs.mkdirSync(outDir, { recursive: true });
  fs.writeFileSync(`${outDir}/mod-names.json`, JSON.stringify(modNames));
}

module.exports = modNamesGenerator;
