// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton';
import * as React from 'react';
import Main from 'user-multiplayer-index/main';
import MultiplayerHistoryStore from 'user-multiplayer-index/multiplayer-history-store';
import { parseJson } from 'utils/json';

core.reactTurbolinks.register('user-multiplayer-index', () => {
  const store = new MultiplayerHistoryStore();
  store.updateWithJson(parseJson('json-user-multiplayer-index'));

  return (
    <Main store={store} user={parseJson('json-user')} />
  );
});
