// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton';
import * as React from 'react';
import UserMultiplayerHistoryContext, { makeStore, updateStore } from 'user-multiplayer-history-context';
import Main from 'user-multiplayer-index/main';
import { parseJson } from 'utils/json';

core.reactTurbolinks.register('user-multiplayer-index', () => {
  const store = makeStore();
  updateStore(store, parseJson('json-user-multiplayer-index'));

  return (
    <UserMultiplayerHistoryContext.Provider value={store}>
      <Main user={parseJson('json-user')} />
    </UserMultiplayerHistoryContext.Provider>
  );
});
