// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-extended-json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';

const entries = [
  'ranked_beatmapset_count',
  'loved_beatmapset_count',
  'pending_beatmapset_count',
  'graveyard_beatmapset_count',
] as const;
type UserBeatmapsetCount = typeof entries[number];

interface Props {
  // TODO: add actual typing for modding profile user json
  user: UserJson & Required<Pick<UserJson, UserBeatmapsetCount>>;
}

export default class Stats extends React.PureComponent<Props> {
  render() {
    return (
      <div className={classWithModifiers('profile-stats', 'modding')}>
        {entries.map(this.renderEntry)}
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
