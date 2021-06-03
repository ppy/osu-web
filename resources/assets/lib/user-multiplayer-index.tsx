// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserMultiplayerHistoryContext, { makeStore, updateStore } from 'beatmap-discussions/rooms-context';
import UserMultiplayerHistoryJson from 'interfaces/user-multiplayer-history-json';
import core from 'osu-core-singleton';
import * as React from 'react';
import Main from 'user-multiplayer-index/main';

core.reactTurbolinks.register('user-multiplayer-index', true, () => {
  const json = osu.parseJson<UserMultiplayerHistoryJson>('json-user-multiplayer-index');
  const store = makeStore();
  updateStore(store, json);

  return (
    <UserMultiplayerHistoryContext.Provider value={store}>
      <Main user={json.user} />
    </UserMultiplayerHistoryContext.Provider>
  );
});
