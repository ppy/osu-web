// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as d3 from 'd3';
import Rank from 'interfaces/rank';
import ScoreJson from 'interfaces/score-json';
import * as React from 'react';
import { accuracy, rank, rankCutoffs, rankAbsoluteCutoffs } from 'utils/score-helper';

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

// the index for maximum accuracy of the rank
const cutoffIndex: Record<Rank, number> = {
  A: 4,
  B: 3,
  C: 2,
  D: 1,
  F: 0,
  S: 5,
  SH: 5,
  X: 6,
  XH: 6,
};

export default function Dial({ score }: { score: ScoreJson }) {
  const scoreAccuracy = accuracy(score);
  const scoreRank = rank(score);
  const scoreRankCutoffs = rankCutoffs(score);
  const scoreRankAbsoluteCutoffs = rankAbsoluteCutoffs(score);
  const displayAccuracy = Math.min(scoreAccuracy, scoreRankAbsoluteCutoffs[cutoffIndex[scoreRank]] ?? 1);

  const arc = d3.arc();
  const pie = d3.pie().sortValues(null);
  const valueData = [displayAccuracy, 1 - displayAccuracy];

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
            {pie(scoreRankCutoffs).map((d) => (
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
        <span>{displayRank[scoreRank]}</span>
      </div>
    </div>
  );
}
