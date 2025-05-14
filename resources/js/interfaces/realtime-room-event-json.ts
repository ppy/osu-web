// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default RealtimeRoomEventJson;
type RealtimeRoomEventJson<T = RealtimeRoomEventType> = {
  event_type: T;
  id: number;
  playlist_item_id?: number;
  timestamp: string;
  user_id?: number;
} & ({
  event_type: Exclude<RealtimeRoomEventType, 'game_started'>;
} | {
  event_detail: GameStartedEventDetail;
  event_type: 'game_started';
});

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

export interface GameStartedEventDetail {
  room_type: RealtimeRoomMatchType;
  teams?: Partial<Record<number, 'red' | 'blue'>>;
}

export type RealtimeRoomMatchType =
  | 'head_to_head'
  | 'team_versus';
