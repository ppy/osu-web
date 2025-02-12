// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ScoreModJson from 'interfaces/score-mod-json';
import modNames from 'mod-names.json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { modDetails } from 'utils/score-helper';

// English only until the labels are translated.
const numberFormatter = new Intl.NumberFormat('en');
function format(value: unknown) {
  if (typeof value === 'boolean') {
    return value ? 'on' : 'off';
  }
  if (typeof value === 'number') {
    return numberFormatter.format(value);
  }

  return String(value);
}

function settingsLabel(modJson: NonNullable<typeof modNames[string]>, scoreModJson: ScoreModJson) {
  const settings = [];
  for (const [setting, value] of Object.entries(scoreModJson.settings ?? {})) {
    // Can use a better way to custom format mod settings but this is the
    // most common one for now.
    if (setting === 'speed_change') {
      settings.push(`${format(value)}×`);
    } else {
      const label = modJson.setting_labels[setting];
      if (label != null) {
        settings.push(`${label}: ${format(value)}`);
      }
    }
  }

  return settings.length === 0
    ? ''
    : ` (${settings.join(', ')})`;
}

interface Props {
  mod: ScoreModJson;
}

export default function Mod({ mod }: Props) {
  const modJson = modDetails(mod);

  return (
    <div
      className={classWithModifiers('mod', modJson.acronym, `type-${modJson.type}`)}
      data-acronym={modJson.acronym}
      title={`${modJson.name}${settingsLabel(modJson, mod)}`}
    />
  );
}
