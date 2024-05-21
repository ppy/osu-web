// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Main from 'contest-judge/main';
import core from 'osu-core-singleton';
import * as React from 'react';
import ContestJudgeStore from 'stores/contest-judge-store';
import { parseJson } from 'utils/json';

core.reactTurbolinks.register('contest-judge', () => {
  const store = new ContestJudgeStore();
  store.updateWithJson(parseJson('json-contest'));

  return <Main store={store} />;
});
