// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserMultiplayerHistoryJson from 'interfaces/user-multiplayer-history-json';
import core from 'osu-core-singleton';
import * as React from 'react';
import UserMultiplayerHistoryContext, { makeStore, updateStore } from 'user-multiplayer-history-context';
import Main from 'user-multiplayer-index/main';
import { parseJson } from 'utils/json';

core.reactTurbolinks.register('user-multiplayer-index', () => {
  const json = parseJson<UserMultiplayerHistoryJson>('json-user-multiplayer-index');
  const store = makeStore();
  updateStore(store, json);

  return (
    <UserMultiplayerHistoryContext.Provider value={store}>
      <Main user={parseJson('json-user')} />
    </UserMultiplayerHistoryContext.Provider>
  );
});
