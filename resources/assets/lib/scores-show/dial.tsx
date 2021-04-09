// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as d3 from 'd3';
import GameMode from 'interfaces/game-mode';
import Rank from 'interfaces/rank';
import * as React from 'react';

interface Props {
  accuracy: number;
  mode: GameMode;
  rank: Rank;
}

const displayRank: Record<Rank, string> = {
  A: 'A',
  B: 'B',
  C: 'C',
  D: 'D',
  S: 'S',
  SH: 'S',
  X: 'SS',
  XH: 'SS',
};

const refDataMap: Record<GameMode, number[]> = {
  // <rank>: minimum acc => (higher rank acc - current acc)
  // for SS, use minimum accuracy of 0.99 (any less and it's too small)
  // actual array is reversed as it's rendered from D to SS clockwise

  // SS: 0.99 => 0.01
  // S: 0.9801 => 0.0099
  // A: 0.9401 => 0.04
  // B: 0.9001 => 0.04
  // C: 0.8501 => 0.05
  // D: 0 => 0.8501
  fruits: [0.8501, 0.05, 0.04, 0.04, 0.0099, 0.01],
  // SS: 0.99 => 0.01
  // S: 0.95 => 0.04
  // A: 0.9 => 0.05
  // B: 0.8 => 0.1
  // C: 0.7 => 0.1
  // D: 0 => 0.7
  mania: [0.7, 0.1, 0.1, 0.05, 0.04, 0.01],
  // SS: 0.99 => 0.01
  // S: (0.9 * 300 + 0.1 * 100) / 300 = 0.933 => 0.057
  // A: (0.8 * 300 + 0.2 * 100) / 300 = 0.867 => 0.066
  // B: (0.7 * 300 + 0.3 * 100) / 300 = 0.8 => 0.067
  // C: 0.6 => 0.2
  // D: 0 => 0.6
  osu: [0.6, 0.2, 0.067, 0.066, 0.057, 0.01],
  // SS: 0.99 => 0.01
  // S: (0.9 * 300 + 0.1 * 50) / 300 = 0.917 => 0.073
  // A: (0.8 * 300 + 0.2 * 50) / 300 = 0.833 => 0.084
  // B: (0.7 * 300 + 0.3 * 50) / 300 = 0.75 => 0.083
  // C: 0.6 => 0.15
  // D: 0 => 0.6
  taiko: [0.6, 0.15, 0.083, 0.084, 0.073, 0.01],
};

export default function Dial(props: Props) {
  const arc = d3.arc();
  const pie = d3.pie().sortValues(null);
  const valueData = [props.accuracy, 1 - props.accuracy];
  const refData = refDataMap[props.mode];

  return (
    <div className='score-dial'>
      <div className='score-dial__layer'>
        <svg viewBox='0 0 200 200'>
          <defs>
            <linearGradient gradientTransform='rotate(90)' id='dial-outer'>
              <stop className='score-dial__outer-gradient score-dial__outer-gradient--start' offset='0%' />
              <stop className='score-dial__outer-gradient score-dial__outer-gradient--end' offset='100%' />
            </linearGradient>
          </defs>
          <g transform='translate(100, 100)'>
            {pie(refData).map((d) => (
              <path
                key={d.index}
                className={`score-dial__inner score-dial__inner--${d.index}`}
                d={arc({ innerRadius: 68, outerRadius: 73, ...d }) ?? undefined}
              />
            ))}
            {pie(valueData).map((d) => (
              <path
                key={d.index}
                className={`score-dial__outer score-dial__outer--${d.index}`}
                d={arc({ innerRadius: 75, outerRadius: 100, ...d }) ?? undefined}
              />
            ))}
          </g>
        </svg>
      </div>

      <div className='score-dial__layer score-dial__layer--grade'>
        <span>{displayRank[props.rank]}</span>
      </div>
    </div>
  );
}
