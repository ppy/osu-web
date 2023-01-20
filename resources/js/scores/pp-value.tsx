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
  let title: string;
  let content: React.ReactNode;

  const isBest = props.score.best_id != null;
  const isSolo = props.score.type === 'solo_score';

  if (!isBest && !isSolo) {
    title = trans('scores.status.non_best');
    content = '-';
  } else if (props.score.pp == null) {
    if (isSolo && !props.score.passed) {
      title = trans('scores.status.non_passing');
      content = '-';
    } else {
      title = trans('scores.status.processing');
      content = <span className='fas fa-exclamation-triangle' />;
    }
  } else {
    title = formatNumber(props.score.pp);
    content = <>{formatNumber(Math.round(props.score.pp))}{props.suffix}</>;
  }

  return <span title={title}>{content}</span>;
}
