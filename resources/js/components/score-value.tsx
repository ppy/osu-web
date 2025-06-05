// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ScoreJson from 'interfaces/score-json';
import { observer } from 'mobx-react';
import * as React from 'react';
import { formatNumber } from 'utils/html';
import { totalScore } from 'utils/score-helper';

interface Props {
  score: ScoreJson;
}

const ScoreValue = observer(({ score }: Props) => <>{formatNumber(totalScore(score))}</>);

export default ScoreValue;
