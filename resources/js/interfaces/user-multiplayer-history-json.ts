// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import RoomListJson from './room-list-json';

export type MultiplayerTypeGroup = 'playlists' | 'realtime';

export default interface UserMultiplayerHistoryJson extends RoomListJson {
  type_group: MultiplayerTypeGroup;
}
