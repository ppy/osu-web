// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import LegacyMatchEventJson, { LegacyMatchEventType } from './legacy-match-event-json';

export function eventFromLegacy(event: LegacyMatchEventJson): RealtimeRoomEventJson {
  return {
    created_at: event.timestamp,
    event_type: eventTypeFromLegacy(event),
    id: event.id,
    playlist_item_id: event.game?.id ?? null,
    user_id: event.user_id,
  };
}

function eventTypeFromLegacy(event: LegacyMatchEventJson) {
  const map: Record<LegacyMatchEventType, RealtimeRoomEventType> = {
    'host-changed': 'host_changed',
    'match-created': 'room_created',
    'match-disbanded': 'room_disbanded',
    other: 'unknown',
    'player-joined': 'player_joined',
    'player-kicked': 'player_kicked',
    'player-left': 'player_left',
  };

  return event.detail.type === 'other' && event.game != null
    ? 'game_started'
    : map[event.detail.type];
}

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
