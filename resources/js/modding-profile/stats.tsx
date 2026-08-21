// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ValueDisplay from 'components/value-display';
import UserModdingProfileJson from 'interfaces/user-modding-profile-json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';

const entries = [
  'ranked_beatmapset_count',
  'loved_beatmapset_count',
  'pending_beatmapset_count',
  'graveyard_beatmapset_count',
  'guest_beatmapset_count',
  'nominated_beatmapset_count',
] as const;
type UserBeatmapsetCount = typeof entries[number];

interface Props {
  user: UserModdingProfileJson;
}

export default class Stats extends React.PureComponent<Props> {
  render() {
    const rank = this.props.user.kudosu.rank;

    return (
      <div className='profile-detail-stats'>
        <div className='profile-detail-stats__values'>
          <ValueDisplay
            label={trans('users.show.rank.kudosu_simple')}
            modifiers='rank'
            value={
              <div
                className='rank-value rank-value--base'
                data-html-title={rank == null ? trans('users.show.rank.kudosu_outside_top_1000') : undefined}
                data-tooltip-position='bottom left'
                title=''
              >
                {rank != null ? `#${formatNumber(rank)}` : '-'}
              </div>
            }
          />
        </div>

        <div className='profile-detail-stats__separator' />

        <div className={classWithModifiers('profile-stats', 'modding')}>
          {entries.map(this.renderEntry)}
        </div>
      </div>
    );
  }

  private readonly renderEntry = (key: UserBeatmapsetCount) => (
    <dl key={key} className='profile-stats__entry'>
      <dt className='profile-stats__key'>{trans(`users.show.stats.${key}`)}</dt>
      <dd className='profile-stats__value'>{formatNumber(this.props.user[key])}</dd>
    </dl>
  );
}
