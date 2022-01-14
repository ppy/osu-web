// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJson from 'interfaces/beatmap-json';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import RoomJson from 'interfaces/room-json';
import UserMultiplayerHistoryJson, { UserMultiplayerHistoryIndexJson } from 'interfaces/user-multiplayer-history-json';
import { action, observable } from 'mobx';
import * as React from 'react';

interface Props {
  beatmaps: Map<number, BeatmapJson>;
  beatmapsets: Map<number, BeatmapsetJson>;
  cursor: unknown;
  rooms: (RoomJson & Required<Pick<RoomJson, 'playlist'>>)[];
}

export class Stores {
  @observable
  playlists = makeStore();
  realtime = makeStore();

  @action
  updateWithJson(json: UserMultiplayerHistoryIndexJson) {
    updateStore(this.playlists, json.any);
    updateStore(this.realtime, json.realtime);
  }
}

export function makeStore(): Props {
  return observable({
    beatmaps: new Map<number, BeatmapJson>(),
    beatmapsets: new Map<number, BeatmapsetJson>(),
    cursor: null,
    rooms: [],
  });
}

export function updateStore(store: Props, json: UserMultiplayerHistoryJson) {
  for (const room of json.rooms) {
    store.rooms.push(room);
  }

  for (const beatmap of json.beatmaps) {
    store.beatmaps.set(beatmap.id, beatmap);
  }

  for (const beatmapset of json.beatmapsets) {
    store.beatmapsets.set(beatmapset.id, beatmapset);
  }

  store.cursor = json.cursor;
}

const defaultValue = makeStore();
const UserMultiplayerHistoryContext = React.createContext(defaultValue);

export default UserMultiplayerHistoryContext;
