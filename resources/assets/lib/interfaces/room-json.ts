// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';
import PlaylistItemJson from './playlistitem-json';

const roomCategories = ['normal', 'spotlight'] as const;
export type RoomCategory = (typeof roomCategories)[number];

const roomTypes = ['playlists', 'head_to_head', 'team_versus'] as const;
export type RoomType = (typeof roomTypes)[number];

export default interface RoomJson {
  active: boolean;
  category: RoomCategory;
  channel_id: number | null;
  ends_at: string;
  host: UserJson;
  id: number;
  max_attempts: number | null;
  name: string;
  participant_count: number;
  playlist?: PlaylistItemJson[];
  starts_at: string;
  type: RoomType;
  user_id: number;
}
