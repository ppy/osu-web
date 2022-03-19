// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserStatisticsJson, { Grade, grades } from 'interfaces/user-statistics-json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  stats: UserStatisticsJson;
}

const ranks: Record<Grade, string> = {
  a: 'A',
  s: 'S',
  sh: 'SH',
  ss: 'X',
  ssh: 'XH',
};

export default function RankCount({ stats }: Props) {
  return (
    <div className='profile-rank-count'>
      {grades.map((grade) => (
        <div key={grade}>
          <div className={classWithModifiers('score-rank', ranks[grade], 'profile-page')} />
          {osu.formatNumber(stats.grade_counts[grade])}
        </div>
      ))}
    </div>
  );
}
