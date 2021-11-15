// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserStatisticsJson from 'interfaces/user-statistics-json';
import * as React from 'react'
import { classWithModifiers } from 'utils/css';

interface Props {
  stats: UserStatisticsJson;
}

/* eslint-disable sort-keys */
const ranks = {
  XH: 'ssh',
  X: 'ss',
  SH: 'sh',
  S: 's',
  A: 'a',
};
/* eslint-enable sort-keys */


export default function RankCount({ stats }: Props) {
  return (
    <div className='profile-rank-count'>
      {Object.entries(ranks).map(([name, grade]) => (
        <div
          key={name}
          className='profile-rank-count__item'
        >
          <div className={classWithModifiers('score-rank', name, 'profile-page')} />
          {osu.formatNumber(stats.grade_counts[grade])}
        </div>
      ))}
    </div>
  );
}
