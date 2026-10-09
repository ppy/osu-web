// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DonutChart from 'components/donut-chart';
import ValueDisplay from 'components/value-display';
import UserModdingProfileJson from 'interfaces/user-modding-profile-json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';

const statusOrder = [
  'ranked',
  'qualified',
  'loved',
  'pending',
  'wip',
  'graveyard',
] as const;

type Status = typeof statusOrder[number];

const sideGroups = [
  ['guest_beatmapset_count', 'nominated_beatmapset_count'],
  ['beatmaps_modded_count', 'issues_resolved_count'],
] as const;

interface Props {
  user: UserModdingProfileJson;
}

function kudosuRankTier(rank: number) {
  const tiers = [
    ['lustrous', 100],
    ['radiant', 200],
    ['rhodium', 300],
    ['platinum', 400],
    ['gold', 600],
    ['silver', 800],
    ['bronze', 1000],
  ] as const;

  for (const [tier, maxRank] of tiers) {
    if (rank <= maxRank) {
      return tier;
    }
  }

  return null;
}

// var(--beatmapset-graveyard-bg-hsl) is too dark to use here
function statusColour(status: Status) {
  return status === 'graveyard'
    ? 'var(--beatmapset-graveyard-colour)'
    : `hsl(var(--beatmapset-${status}-bg-hsl))`;
}

export default function Stats({ user }: Props) {
  const rank = user.kudosu.rank;
  const tier = rank == null ? null : kudosuRankTier(rank);
  const slices = statusOrder.map((status) => {
    const value = user.beatmapset_status_counts[status];

    return {
      colour: statusColour(status),
      key: status,
      title: `${trans(`users.show.stats.${status}_beatmapset_count`)}: ${formatNumber(value)}`,
      value,
    };
  });

  return (
    <div className='modding-profile-stats'>
      <div className='profile-detail-stats-card profile-detail-stats-card--modding'>
        <div className='profile-detail-stats-card__top'>
          <div className='profile-detail-stats-card__title'>
            <div className='profile-detail-stats-card__title-icon'>
              <span className='svg-icon svg-icon--stats' />
            </div>
            <div>
              {trans('users.show.stats.title')}
            </div>
          </div>
          <div className='profile-detail-stats-card__values'>
            <ValueDisplay
              label={trans('users.show.rank.kudosu_simple')}
              modifiers='rank'
              value={
                <div
                  className={classWithModifiers('rank-value', tier ?? 'base')}
                  data-html-title={rank == null ? trans('users.show.rank.kudosu_outside_top_1000') : undefined}
                  data-tooltip-position='bottom left'
                  style={tier == null ? undefined : {
                    '--colour': `var(--level-tier-${tier})`,
                  } as React.CSSProperties}
                  title=''
                >
                  {rank != null ? `#${formatNumber(rank)}` : '-'}
                </div>
              }
            />
            <ValueDisplay
              label={trans('users.show.extra.kudosu.total')}
              modifiers='rank rank-small'
              value={formatNumber(user.kudosu.total)}
            />
          </div>
        </div>

        <div className='modding-profile-stats__body'>
          <ul className='modding-profile-stats__legend'>
            {statusOrder.map((status) => (
              <li key={status} className='modding-profile-stats__legend-item'>
                <span className='modding-profile-stats__label'>
                  <span
                    className='modding-profile-stats__swatch'
                    style={{ '--colour': statusColour(status) } as React.CSSProperties}
                  />
                  {trans(`users.show.stats.${status}_beatmapset_count`)}
                </span>
                <span className='modding-profile-stats__value'>
                  {formatNumber(user.beatmapset_status_counts[status])}
                </span>
              </li>
            ))}
          </ul>

          <div className='modding-profile-stats__chart'>
            <DonutChart emptyTitle={trans('users.show.stats.no_data')} slices={slices} />
          </div>
        </div>

        <div className='profile-detail-stats-card__decor-corner' />
        <div className='profile-detail-stats-card__decor' />
      </div>

      <div className='modding-profile-stats__counts'>
        {sideGroups.map((group) => (
          <div key={group[0]} className='profile-stats'>
            {group.map((key) => (
              <dl key={key} className='profile-stats__entry'>
                <dt className='profile-stats__key'>{trans(`users.show.stats.${key}`)}</dt>
                <dd className='profile-stats__value'>{formatNumber(user[key])}</dd>
              </dl>
            ))}
          </div>
        ))}
      </div>
    </div>
  );
}
