// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export type RealtimeRoomEventType =
  | 'game_started'
  | 'game_aborted'
  | 'game_completed'
  | 'host_changed'
  | 'player_joined'
  | 'player_kicked'
  | 'player_left'
  | 'room_created'
  | 'room_disbanded'
  | 'unknown';

export default interface RealtimeRoomEventJson {
  created_at: string;
  event_type: RealtimeRoomEventType;
  id: number;
  playlist_item_id: null | number;
  user_id: null | number;
}
