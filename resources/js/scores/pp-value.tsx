// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ScoreJson from 'interfaces/score-json';
import * as React from 'react';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';

interface Props {
  score: ScoreJson;
  suffix?: React.ReactNode;
}

export default function PpValue({ score, suffix }: Props) {
  if (score.type !== 'solo_score' && score.best_id == null) {
    return <span title={trans('scores.status.non_best')}>-</span>;
  }

  if (
    score.type === 'solo_score' &&
    (!score.preserve || !score.ranked || (score.pp == null && score.processed))
  ) {
    return <span title={trans('scores.status.no_pp')}>-</span>;
  }

  if (score.pp == null) {
    return (
      <span title={trans('scores.status.processing')}>
        <span className='fas fa-sync' />
      </span>
    );
  }

  return (
    <span title={formatNumber(score.pp)}>
      {formatNumber(Math.round(score.pp))}
      {suffix}
    </span>
  );
}
