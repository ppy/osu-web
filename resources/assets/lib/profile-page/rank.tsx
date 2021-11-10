// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserStatisticsJson, { RankType } from 'interfaces/user-statistics-json';
import * as React from 'react';
import { Modifiers } from 'utils/css';
import ValueDisplay from 'value-display';

interface Props {
  modifiers?: Modifiers;
  stats: UserStatisticsJson;
  type: RankType;
}

export default function Rank({ modifiers, stats, type }: Props) {
  const key = `${type}_rank` as const;

  const variantTooltip: string[] = [];
  for (const variant of stats.variants ?? []) {
    const variantRank = variant[key];
    if (variantRank == null) continue;

    const name = osu.trans(`beatmaps.variant.${variant.mode}.${variant.variant}`);
    const value = `#${osu.formatNumber(variantRank)}`;

    variantTooltip.push(`<div>${name}: ${value}</div>`);
  }

  const rank = stats[key];

  return (
    <ValueDisplay
      label={osu.trans(`users.show.rank.${type}_simple`)}
      modifiers={modifiers}
      value={
        <div data-html-title={variantTooltip.join('')} title=''>
          {rank != null ? (
            `#${osu.formatNumber(rank)}`
          ) : '-'}
        </div>
      }
    />
  );
}
