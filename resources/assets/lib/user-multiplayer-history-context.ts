// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJson } from 'beatmapsets/beatmapset-json';
import BeatmapJson from 'interfaces/beatmap-json';
import RoomJson from 'interfaces/room-json';
import UserMultiplayerHistoryJson from 'interfaces/user-multiplayer-history-json';
import { observable } from 'mobx';
import * as React from 'react';

interface Props {
  beatmaps: Map<number, BeatmapJson>;
  beatmapsets: Map<number, BeatmapsetJson>;
  cursor: {
    ends_at: string;
    id: number;
  } | null;
  rooms: (RoomJson & Required<Pick<RoomJson, 'playlist'>>)[];
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
