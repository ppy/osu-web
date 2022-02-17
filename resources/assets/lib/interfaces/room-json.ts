// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';
import PlaylistItemJson from './playlist-item-json';

const roomCategories = ['normal', 'spotlight'] as const;
export type RoomCategory = (typeof roomCategories)[number];

const roomTypes = ['playlists', 'head_to_head', 'team_versus'] as const;
export type RoomType = (typeof roomTypes)[number];

interface RoomJsonAvailableIncludes {
  current_playlist_item: PlaylistItemJson;
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
  ends_at: string;
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
