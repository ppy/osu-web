// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Rank from 'interfaces/rank';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  rank: Rank;
}

const rankIntMap: Record<Rank, number> = {
  A: 3,
  B: 2,
  C: 1,
  D: 0,
  S: 4,
  SH: 4,
  X: 5,
  XH: 5,
};

export default function ScoreTower(props: Props) {
  const ranks: Rank[] = ['X', 'S', 'A', 'B', 'C', 'D'];
  if (props.rank === 'XH') {
    ranks[0] = props.rank;
  } else if (props.rank === 'SH') {
    ranks[1] = props.rank;
  }

  const currentRankInt = rankIntMap[props.rank];

  return (
    <div className='score-tower'>{ranks.map((rank) => (
      <div
        key={rank}
        className={classWithModifiers('score-tower__item', {
          missed: currentRankInt < rankIntMap[rank],
          passed: currentRankInt > rankIntMap[rank],
        })}
      >
        <div className={`score-rank score-rank--${rank}`} />
      </div>
    ))}</div>
  );
}
