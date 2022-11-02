// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ValueDisplay from 'components/value-display';
import RankHighestJson from 'interfaces/rank-highest-json';
import UserStatisticsJson, { RankType } from 'interfaces/user-statistics-json';
import * as moment from 'moment';
import * as React from 'react';
import { formatNumber } from 'utils/html';

interface Props {
  highest?: RankHighestJson | null;
  stats: UserStatisticsJson;
  type: RankType;
}

export default function Rank({ highest, stats, type }: Props) {
  const key = `${type}_rank` as const;
  const rank = stats[key];
  const tooltip: string[] = [];

  for (const variant of stats.variants ?? []) {
    const variantRank = variant[key];
    if (variantRank == null) continue;

    const name = osu.trans(`beatmaps.variant.${variant.mode}.${variant.variant}`);
    const value = `#${formatNumber(variantRank)}`;

    tooltip.push(`<div>${name}: ${value}</div>`);
  }

  if (highest != null) {
    const text = osu.trans('users.show.rank.highest', {
      date: moment(highest.updated_at).format('ll'),
      rank: `#${formatNumber(highest.rank)}`,
    });

    tooltip.push(`<div>${text}</div>`);
  }

  return (
    <ValueDisplay
      label={osu.trans(`users.show.rank.${type}_simple`)}
      modifiers='rank'
      value={
        <div data-html-title={tooltip.join('')} title=''>
          {rank != null ? (
            `#${formatNumber(rank)}`
          ) : '-'}
        </div>
      }
    />
  );
}
