// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import SoloScoreJson from 'interfaces/solo-score-json';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { formatNumber } from 'utils/html';

interface Props {
  score: SoloScoreJson;
}

const ScoreValue = observer(({ score }: Props) => {
  let value: number;

  if (score.legacy_score_id !== null && core.userPreferences.get('legacy_score_only')) {
    value = score.legacy_total_score;
  } else if (score.type === 'solo_score' && core.userPreferences.get('scoring_mode') === 'classic') {
    value = score.classic_total_score;
  } else {
    value = score.total_score;
  }

  return <>{formatNumber(value)}</>;
});

export default ScoreValue;
