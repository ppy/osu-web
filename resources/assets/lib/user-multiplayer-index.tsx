// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { RoomsContext } from 'beatmap-discussions/rooms-context';
import { BeatmapsetJson } from 'beatmapsets/beatmapset-json';
import BeatmapJson from 'interfaces/beatmap-json';
import RoomJson from 'interfaces/room-json';
import UserJsonExtended from 'interfaces/user-json-extended';
import { keyBy } from 'lodash';
import core from 'osu-core-singleton';
import * as React from 'react';
import Main from 'user-multiplayer-index/main';

interface Props {
  beatmaps: BeatmapJson[];
  beatmapsets: BeatmapsetJson[];
  rooms: (RoomJson & Required<Pick<RoomJson, 'playlist'>>)[];
  user: UserJsonExtended;
}

core.reactTurbolinks.register('user-multiplayer-index', true, () => {
  const json = osu.parseJson<Props>('json-user-multiplayer-index');
  const beatmaps = keyBy(json.beatmaps, 'id');
  const beatmapsets = keyBy(json.beatmapsets, 'id');

  return (
    <RoomsContext.Provider value={{ beatmaps, beatmapsets }}>
      <Main rooms={json.rooms} user={json.user} />
    </RoomsContext.Provider>
  );
});
