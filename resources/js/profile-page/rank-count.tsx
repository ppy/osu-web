// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserStatisticsJson, { grades } from 'interfaces/user-statistics-json';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';
import { formatNumber } from 'utils/html';

interface Props {
  modifiers?: Modifiers;
  stats: UserStatisticsJson;
}

export default function RankCount({ modifiers, stats }: Props) {
  return (
    <div className={classWithModifiers('profile-rank-count', modifiers)}>
      {grades.map((grade) => (
        <div key={grade} className='profile-rank-count__item'>
          <div className='profile-rank-count__rank'>
            <div className={classWithModifiers('score-rank', `rank-${grade}`)} />
          </div>
          {formatNumber(stats.grade_counts[grade])}
        </div>
      ))}
    </div>
  );
}
