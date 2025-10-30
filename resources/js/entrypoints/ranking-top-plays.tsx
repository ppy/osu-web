// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton';
import RankingTopPlays from 'ranking-top-plays';
import * as React from 'react';

core.reactTurbolinks.register('ranking-top-plays', (container) => (
  <RankingTopPlays {...(JSON.parse(container.dataset.props ?? ''))} />
));
