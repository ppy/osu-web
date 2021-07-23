// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJsonExtended from 'interfaces/user-json-extended';
import UserMultiplayerHistoryJson from 'interfaces/user-multiplayer-history-json';
import osu from 'osu-common';
import core from 'osu-core-singleton';
import * as React from 'react';
import UserMultiplayerHistoryContext, { makeStore, updateStore } from 'user-multiplayer-history-context';
import Main from 'user-multiplayer-index/main';

core.reactTurbolinks.register('user-multiplayer-index', () => {
  const jsonUser = osu.parseJson<UserJsonExtended>('json-user');
  const json = osu.parseJson<UserMultiplayerHistoryJson>('json-user-multiplayer-index');
  const store = makeStore();
  updateStore(store, json);

  return (
    <UserMultiplayerHistoryContext.Provider value={store}>
      <Main user={jsonUser} />
    </UserMultiplayerHistoryContext.Provider>
  );
});
