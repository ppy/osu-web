// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserMultiplayerHistoryJson from 'interfaces/user-multiplayer-history-json';
import core from 'osu-core-singleton';
import * as React from 'react';
import RoomListStore from 'stores/room-list-store';
import Main from 'user-multiplayer-index/main';
import { parseJson } from 'utils/json';

core.reactTurbolinks.register('user-multiplayer-index', () => {
  const store = new RoomListStore();
  const json: UserMultiplayerHistoryJson = parseJson('json-user-multiplayer-index');
  store.updateWithJson(json);

  return (
    <Main store={store} typeGroup={json.type_group} user={parseJson('json-user')} />
  );
});
