// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ScoreModJson from 'interfaces/score-mod-json';
import modNames from 'mod-names.json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

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

interface Props {
  mod: ScoreModJson;
}

export default function Mod({ mod }: Props) {
  const modJson = modNames[mod.acronym] ?? {
    acronym: mod.acronym,
    name: '',
    setting_labels: {},
    type: 'Fun',
  };

  let title = modJson.name;

  const settings = [];
  for (const [setting, value] of Object.entries(mod.settings ?? {})) {
    // Can use a better way to custom format mod settings but this is the
    // most common one for now.
    if (setting === 'speed_change') {
      settings.push(`${format(value)}×`);
    } else {
      const label = modJson.setting_labels[setting] ?? setting;
      settings.push(`${label}: ${format(value)}`);
    }
  }
  if (settings.length > 0) {
    title += ` (${settings.join(', ')})`;
  }

  return (
    <div
      className={classWithModifiers('mod', modJson.acronym, `type-${modJson.type}`)}
      data-acronym={modJson.acronym}
      title={title}
    />
  );
}
