// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import cogBadge from '@images/badges/mods/blanks/mod-cog-badge.svg';
import ScoreModJson from 'interfaces/score-mod-json';
import modNames from 'mod-names.json';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';
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

function formatNumberWithPrecision(value: number, precision: number)  {
  return value.toLocaleString('en', {
    maximumFractionDigits: precision,
    minimumFractionDigits: precision,
  });
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

interface ExtendedContentDisplayCandidate {
  acronym: string;
  significantDigits: number;
}

function getExtendedContent(scoreModJson: ScoreModJson): string | null {
  switch (scoreModJson.acronym) {
    case 'HT':
    case 'DC':
    case 'DT':
    case 'NC':
    {
      const speedChange = scoreModJson.settings?.speed_change as number;
      return speedChange != null ? `${formatNumberWithPrecision(speedChange, 2)}×` : null;
    }

    case 'DA':
    {
      const displayCandidates: Partial<Record<string, ExtendedContentDisplayCandidate>> = {
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

      let displayCandidate: ExtendedContentDisplayCandidate | undefined;
      let displayValue: number | undefined;

      for (const [key, setting] of Object.entries(displayCandidates)) {
        const settingValue = scoreModJson.settings?.[key];
        if (typeof settingValue === 'number') {
          if (displayCandidate !== undefined) {
            return null;
          }

          displayValue = settingValue;
          displayCandidate = setting;
        }
      }

      if (displayCandidate != null && displayValue != null) {
        return `${displayCandidate.acronym}${formatNumberWithPrecision(displayValue, displayCandidate.significantDigits)}`;
      }

      return null;
    }

    default:
      return null;
  }
}

interface Props {
  mod: ScoreModJson;
  modifiers?: Modifiers;
}

export default function Mod({ mod, modifiers }: Props) {
  const modJson = modDetails(mod);
  const extendedContent = getExtendedContent(mod);

  return (
    <div className={classWithModifiers('mod', `type-${modJson.type}`, modifiers)} title={`${modJson.name}${settingsLabel(modJson, mod)}`}>
      <div
        className={classWithModifiers('mod__icon', mod.acronym)}
        data-acronym={modJson.acronym}
      />
      {extendedContent !== null && <div className='mod__extender'><span>{extendedContent}</span></div>}
      {Object.entries(mod.settings ?? {}).length > 0 && (
        <div className='mod__customised-indicator'>
          {/* Doing it this way allows using page css variables */}
          <svg height='100%' viewBox='0 0 32 16' width='100%'>
            <use href={`${cogBadge}#icon`} />
          </svg>
        </div>
      )}
    </div>
  );
}
