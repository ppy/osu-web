// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

'use strict';

const fs = require('fs');

const root = `${__dirname}/../../..`;

// Reference: https://github.com/ppy/osu/blob/91bc23e39eb1048d7b75acf669bd46e9ef9a4f9e/osu.Game/Rulesets/Mods/ModType.cs
const typeOrder = {};
for (const [index, type] of [
  'DifficultyReduction',
  'DifficultyIncrease',
  'Conversion',
  'Automation',
  'Fun',
  'System',
].entries()) {
  typeOrder[type] = index;
}

// Reference: https://github.com/ppy/osu/blob/91bc23e39eb1048d7b75acf669bd46e9ef9a4f9e/osu.Game/Rulesets/Mods/ModExtensions.cs#L33-L35
function modSorter(a, b) {
  if (a.Type !== b.Type) {
    return typeOrder[a.Type] - typeOrder[b.Type];
  }

  return a.Acronym.localeCompare(b.Acronym);
}

function modNamesGenerator() {
  const modsByRuleset = JSON.parse(fs.readFileSync(`${root}/database/mods.json`));

  const modNames = {};
  for (const mods of modsByRuleset) {
    let rulesetId = mods.RulesetID;
    for (const [i, mod] of mods.Mods.sort(modSorter).entries()) {
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
    type: 'System',
  };
  modNames.NM = {
    acronym: 'NM',
    index: {},
    name: 'No Mod',
    setting_labels: {},
    type: 'System',
  };

  const outDir = `${root}/resources/builds`;
  fs.mkdirSync(outDir, { recursive: true });
  fs.writeFileSync(`${outDir}/mod-names.json`, JSON.stringify(modNames));
}

module.exports = modNamesGenerator;
