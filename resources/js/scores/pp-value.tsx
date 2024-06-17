// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import SoloScoreJson from 'interfaces/solo-score-json';
import * as React from 'react';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';

interface Props {
  score: SoloScoreJson;
  suffix?: React.ReactNode;
}

export default function PpValue(props: Props) {
  const [title, content] = getTitleAndContent(props);

  return <span title={title}>{content}</span>;
}

function getTitleAndContent({ score, suffix }: Props): [string, React.ReactNode] {
  if (score.type !== 'solo_score' && score.best_id == null) {
    return [trans('scores.status.non_best'), '-'];
  }

  if (
    score.type === 'solo_score' &&
    (!score.preserve || !score.ranked || (score.pp == null && score.processed))
  ) {
    return [trans('scores.status.no_pp'), '-'];
  }

  if (score.pp == null) {
    // eslint-disable-next-line react/jsx-key
    return [trans('scores.status.processing'), <span className='fas fa-sync' />];
  }

  return [formatNumber(score.pp), <>{formatNumber(Math.round(score.pp))}{suffix}</>];
}
