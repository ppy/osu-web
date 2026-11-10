// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ValueDisplay from 'components/value-display';
import UserModdingProfileJson from 'interfaces/user-modding-profile-json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';

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

export default class Modding extends React.PureComponent<Props> {
  render() {
    const { user } = this.props;
    const rank = user.kudosu.rank;
    const tier = rank == null ? null : kudosuRankTier(rank);
    const rankValueStyle = tier == null
      ? undefined
      : {
        '--colour': `var(--level-tier-${tier})`,
      } as React.CSSProperties;

    return (
      <div className='profile-detail-stats-card profile-detail-stats-card--modding'>
        <div className='profile-detail-stats-card__top'>
          <div className='profile-detail-stats-card__title'>
            <div className='profile-detail-stats-card__title-icon'>
              <span className='svg-icon svg-icon--star' />
            </div>
            <div>
              {trans('users.show.modding.title')}
            </div>
          </div>
          <div className='profile-detail-stats-card__values'>
            <ValueDisplay
              label={trans('users.show.rank.kudosu_simple')}
              modifiers='rank'
              value={
                <div
                  className={classWithModifiers('rank-value', tier ?? 'base')}
                  data-tooltip-position='bottom left'
                  style={rankValueStyle}
                  title={rank == null ? trans('users.show.rank.kudosu_outside_top_1000') : undefined}
                >
                  {rank != null ? `#${formatNumber(rank)}` : '-'}
                </div>
              }
            />
          </div>
          <div className='profile-detail-stats-card__values profile-detail-stats-card__values--row'>
            <ValueDisplay
              label={trans('users.show.extra.kudosu.total')}
              modifiers='plain'
              value={formatNumber(user.kudosu.total)}
            />
            <ValueDisplay
              label={trans('users.show.stats.nominated_beatmapset_count')}
              modifiers='plain'
              value={formatNumber(user.nominated_beatmapset_count)}
            />
          </div>
          <div className='profile-detail-stats-card__values profile-detail-stats-card__values--row'>
            <ValueDisplay
              label={trans('users.show.stats.beatmaps_modded_count')}
              modifiers='plain'
              value={formatNumber(user.beatmaps_modded_count)}
            />
            <ValueDisplay
              label={trans('users.show.stats.issues_resolved_count')}
              modifiers='plain'
              value={formatNumber(user.issues_resolved_count)}
            />
          </div>
        </div>
      </div>
    );
  }
}
