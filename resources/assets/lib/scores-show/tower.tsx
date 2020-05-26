// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Rank from 'interfaces/rank';
import * as React from 'react';

interface Props {
  rank: Rank;
}

const dimmed = {
  A: 2,
  B: 3,
  C: 4,
  D: 5,
  S: 1,
  SH: 1,
  X: 0,
  XH: 0,
};

export default function ScoreTower(props: Props) {
  const ranks = ['X', 'S', 'A', 'B', 'C', 'D'];
  if (props.rank === 'XH') {
    ranks[0] = props.rank;
  } else if (props.rank === 'SH') {
    ranks[1] = props.rank;
  }

  const dimUpToIndex = dimmed[props.rank];

  return (
    <div className='score-tower'>{ranks.map((rank, index) => (
      <div
        key={rank}
        className={`score-tower__item ${index < dimUpToIndex ? 'score-tower__item--dimmed' : ''}`}
      >
        <div className={`score-rank score-rank--${rank}`} />
      </div>
    ))}</div>
  );
}
