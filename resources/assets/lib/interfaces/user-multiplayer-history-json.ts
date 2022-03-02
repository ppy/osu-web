// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJson from './beatmap-json';
import BeatmapsetJson from './beatmapset-json';
import RoomJson from './room-json';

export type MultiplayerTypeGroup = 'playlists' | 'realtime';

type RoomJsonIncludes =
  'current_playlist_item' |
  'difficulty_range' |
  'host' |
  'playlist_item_stats';

export type EndpointRoomJson = RoomJson & Required<Pick<RoomJson, RoomJsonIncludes>>;

export default interface UserMultiplayerHistoryJson {
  beatmaps: BeatmapJson[];
  beatmapsets: BeatmapsetJson[];
  cursor: unknown;
  rooms: EndpointRoomJson[];
  type_group: MultiplayerTypeGroup;
}
