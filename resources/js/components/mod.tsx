// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ScoreModJson from 'interfaces/score-mod-json';
import modNames from 'mod-names.json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { modDetails } from 'utils/score-helper';
import { formatNumber } from '../utils/html';

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

function getExtendedContent(scoreModJson: ScoreModJson): string | null {
  const settings = Object.entries(scoreModJson.settings ?? {});
  switch (scoreModJson.acronym) {
    case 'HT':
    case 'DC':
    case 'DT':
    case 'NC':
    {
      const speedChange = settings.find((s) => s[0] === 'speed_change');
      return speedChange != null ? `${formatNumber(speedChange[1] as number, 2)}x` : null;
    }

    case 'DA':
    {
      const displayCandidates = {
        approach_rate: {
          acronym: 'AR',
          significantDigits: 1,
        },
        circle_size: {
          acronym: 'CS',
          significantDigits: 1,
        },
        drain_rate: {
          acronym: 'HP',
          significantDigits: 1,
        },
        overall_difficulty: {
          acronym: 'OD',
          significantDigits: 1,
        },
        scroll_speed: {
          acronym: 'SS',
          significantDigits: 2,
        },
      };

      let displayCandidate;
      let displayValue: number | undefined;
      for (const [setting, value] of settings) {
        if (setting in displayCandidates) {
          if (displayCandidate != null) {
            return null;
          }

          displayCandidate = displayCandidates[setting as keyof typeof displayCandidates];
          displayValue = value as number;
        }
      }

      if (displayCandidate != null && displayValue != null) {
        return `${displayCandidate.acronym}${formatNumber(displayValue, displayCandidate.significantDigits)}`;
      }

      return null;
    }

    default:
      return null;
  }
}

interface Props {
  mod: ScoreModJson;
}

export default function Mod({ mod }: Props) {
  const modJson = modDetails(mod);
  const extendedContent = getExtendedContent(mod);

  return (
    <div className={classWithModifiers('mod', `type-${modJson.type}`)} title={`${modJson.name}${settingsLabel(modJson, mod)}`}>
      <div
        className={classWithModifiers('mod__icon', mod.acronym)}
        data-acronym={modJson.acronym}
      />
      {Object.entries(mod.settings ?? {}).length > 0 && <div className='mod__customised-indicator' />}
      {extendedContent !== null && <div className='mod__extender'><span>{extendedContent}</span></div>}
    </div>
  );
}
