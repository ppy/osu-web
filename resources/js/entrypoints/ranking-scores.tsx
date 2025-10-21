// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton';
import RankingScores from 'ranking-scores';
import * as React from 'react';

core.reactTurbolinks.register('ranking-scores', (container) => (
  <RankingScores {...(JSON.parse(container.dataset.props ?? ''))} />
));
