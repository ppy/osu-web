// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import SoloScoreJson from 'interfaces/solo-score-json';
import * as React from 'react';
import { formatNumber } from 'utils/html';

interface Props {
  score: SoloScoreJson;
  suffix?: React.ReactNode;
}

export default function PpValue(props: Props) {
  const isBestScore = props.score.best_id != null || (props.score.type === 'solo_score' && props.score.pp != null);

  if (!isBestScore) {
    return (
      <span title={osu.trans('scores.status.non_best')}>
        -
      </span>
    );
  }

  if (props.score.pp == null) {
    return (
      <span
        className='fas fa-exclamation-triangle'
        title={osu.trans('scores.status.processing')}
      />
    );
  }

  return (
    <span title={formatNumber(props.score.pp)}>
      {formatNumber(Math.round(props.score.pp))}
      {props.suffix}
    </span>
  );
}
