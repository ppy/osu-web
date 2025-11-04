// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ValueDisplay from 'components/value-display';
import RankHighestJson from 'interfaces/rank-highest-json';
import UserStatisticsJson, { RankType } from 'interfaces/user-statistics-json';
import * as moment from 'moment';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';

interface Props {
  highest?: RankHighestJson | null;
  stats: UserStatisticsJson;
  type: RankType;
}

function globalTier(stats: UserStatisticsJson) {
  const rank = stats.global_rank;
  const percent = stats.global_rank_percent;

  if (rank == null || percent == null) {
    return null;
  }

  if (rank <= 100) {
    return 'lustrous';
  }

  return percent < 0.0005
    ? 'radiant'
    : percent < 0.0025
      ? 'rhodium'
      : percent < 0.005
        ? 'platinum'
        : percent < 0.025
          ? 'gold'
          : percent < 0.05
            ? 'silver'
            : percent < 0.25
              ? 'bronze'
              : percent < 0.5
                ? 'iron'
                : null;
}

export default function Rank({ highest, stats, type }: Props) {
  const key = `${type}_rank` as const;
  const rank = stats[key];
  const tooltip: string[] = [];

  for (const variant of stats.variants ?? []) {
    const variantRank = variant[key];
    if (variantRank == null) continue;

    const name = trans(`beatmaps.variant.${variant.mode}.${variant.variant}`);
    const value = `#${formatNumber(variantRank)}`;

    tooltip.push(`<div>${name}: ${value}</div>`);
  }

  if (highest != null) {
    const text = trans('users.show.rank.highest', {
      date: moment(highest.updated_at).format('ll'),
      rank: `#${formatNumber(highest.rank)}`,
    });

    tooltip.push(`<div>${text}</div>`);
  }

  const tier = type === 'global' ? globalTier(stats) : null;
  const tierVar = tier == null ? '' : `var(--level-tier-${tier})`;

  return (
    <ValueDisplay
      label={trans(`users.show.rank.${type}_simple`)}
      modifiers='rank'
      value={
        <div
          className={classWithModifiers('rank-value', tier ?? 'base')}
          data-html-title={tooltip.join('')}
          data-tooltip-position='bottom left'
          style={{
            '--colour': tierVar,
          } as React.CSSProperties}
          title=''
        >
          {rank != null ? (
            `#${formatNumber(rank)}`
          ) : '-'}
        </div>
      }
    />
  );
}
