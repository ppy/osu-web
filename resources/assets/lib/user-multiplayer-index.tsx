// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { RoomsContext } from 'beatmap-discussions/rooms-context';
import UserMultiplayerHistoryJson from 'interfaces/user-multiplayer-history-json';
import { keyBy } from 'lodash';
import { observable } from 'mobx';
import core from 'osu-core-singleton';
import * as React from 'react';
import Main from 'user-multiplayer-index/main';

core.reactTurbolinks.register('user-multiplayer-index', true, () => {
  const json = osu.parseJson<UserMultiplayerHistoryJson>('json-user-multiplayer-index');
  const beatmaps = keyBy(json.beatmaps, 'id');
  const beatmapsets = keyBy(json.beatmapsets, 'id');

  const store = observable({ beatmaps, beatmapsets, cursor: json.cursor, rooms: json.rooms });

  return (
    <RoomsContext.Provider value={store}>
      <Main rooms={json.rooms} user={json.user} />
    </RoomsContext.Provider>
  );
});
