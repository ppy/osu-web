// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';
import { LegacyMatchTeamType } from './legacy-match-game-json';
import LegacyMatchJson from './legacy-match-json';
import PlaylistItemJson from './playlist-item-json';

export const roomTypeFromLegacy: Record<LegacyMatchTeamType, RealtimeRoomType> = {
  'head-to-head': 'head_to_head',
  'tag-coop': 'tag_coop',
  'tag-team-vs': 'tag_team_versus',
  'team-vs': 'team_versus',
};

export function roomJsonFromLegacy(match: LegacyMatchJson): RoomJson {
  return {
    active: match.end_time == null,
    category: 'normal',
    channel_id: null,
    ends_at: match.end_time,
    has_password: false,
    id: match.id,
    max_attempts: 1,
    name: match.name,
    participant_count: 1,
    queue_mode: 'host_only',
    starts_at: match.start_time,
    type: 'head_to_head',
    user_id: 0,
  };
}

export type RoomCategory = 'normal' | 'spotlight';

export type RealtimeRoomType =
  | 'head_to_head'
  | 'tag_coop'
  | 'tag_team_versus'
  | 'team_versus';

export type RoomType = 'playlists' | RealtimeRoomType;

interface RoomJsonAvailableIncludes {
  current_playlist_item: PlaylistItemJson | null;
  // current_user_score: MultiplayerScoreAggregateJson; (missing definition and not used)
  difficulty_range: {
    max: number;
    min: number;
  };
  host: UserJson;
  playlist: PlaylistItemJson[];
  playlist_item_stats: {
    count_active: number;
    count_total: number;
    ruleset_ids: number[];
  };
  recent_participants: UserJson[];
  // scores: MultiplayerScoreJson[]; (missing definition and not used)
}

interface RoomJsonDefaultAttributes {
  active: boolean;
  category: RoomCategory;
  channel_id: number | null;
  ends_at: string | null;
  has_password: boolean;
  id: number;
  max_attempts: number | null;
  name: string;
  participant_count: number;
  queue_mode: 'all_players' | 'all_players_round_robin' | 'host_only';
  starts_at: string;
  type: RoomType;
  user_id: number;
}

type RoomJson = RoomJsonDefaultAttributes & Partial<RoomJsonAvailableIncludes>;

export default RoomJson;
