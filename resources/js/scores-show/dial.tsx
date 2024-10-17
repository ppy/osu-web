// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as d3 from 'd3';
import Rank from 'interfaces/rank';
import * as React from 'react';

interface Props {
  accuracy: number;
  rank: Rank;
  rankCutoffs: number[];
}

const displayRank: Record<Rank, string> = {
  A: 'A',
  B: 'B',
  C: 'C',
  D: 'D',
  F: 'F',
  S: 'S',
  SH: 'S',
  X: 'SS',
  XH: 'SS',
};

export default function Dial(props: Props) {
  const arc = d3.arc();
  const pie = d3.pie().sortValues(null);
  const valueData = [props.accuracy, 1 - props.accuracy];

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
            {pie(props.rankCutoffs).map((d) => (
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
