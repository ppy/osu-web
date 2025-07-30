// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserMultiplayerHistoryJson from 'interfaces/user-multiplayer-history-json';
import core from 'osu-core-singleton';
import * as React from 'react';
import RoomListStore from 'stores/room-list-store';
import Main from 'user-multiplayer-index/main';
import { parseJson } from 'utils/json';

interface IndexJson {
  active: UserMultiplayerHistoryJson;
  ended: UserMultiplayerHistoryJson;
}

core.reactTurbolinks.register('user-multiplayer-index', () => {
  const store = {
    active: new RoomListStore(),
    ended: new RoomListStore(),
  };
  const json: IndexJson = parseJson('json-user-multiplayer-index');
  for (const type of ['active', 'ended'] as const) {
    store[type].updateWithJson(json[type]);
  }

  return (
    <Main store={store} typeGroup={json.active.type_group} user={parseJson('json-user')} />
  );
});
