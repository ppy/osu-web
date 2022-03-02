// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserStatisticsJson from 'interfaces/user-statistics-json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

// sorted by display order
const entryKeys = [
  'ranked_score',
  'hit_accuracy',
  'play_count',
  'total_score',
  'total_hits',
  'maximum_combo',
  'replays_watched_by_others',
] as const;

type EntryKey = typeof entryKeys[number];

interface Props {
  stats: UserStatisticsJson;
}

export default class Stats extends React.PureComponent<Props> {
  render() {
    return <div className='profile-stats'>{entryKeys.map(this.renderEntry)}</div>;
  }

  private formatValue(key: EntryKey) {
    const val = this.props.stats[key];

    if (key === 'hit_accuracy') {
      return `${osu.formatNumber(val, 2)}%`;
    }

    return osu.formatNumber(val);
  }

  private readonly renderEntry = (key: EntryKey) => (
    <dl key={key} className={classWithModifiers('profile-stats__entry', `key-${key}`)}>
      <dt className='profile-stats__key'>{osu.trans(`users.show.stats.${key}`)}</dt>
      <dd className='profile-stats__value'>{this.formatValue(key)}</dd>
    </dl>
  );
}
