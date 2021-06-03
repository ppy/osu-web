// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';
import PlaylistItemJson from './playlistitem-json';

export default interface RoomJson {
  active: boolean;
  category: string;
  channel_id: number | null;
  ends_at: string;
  host: UserJson;
  id: number;
  max_attempts: number | null;
  name: string;
  participant_count: number;
  playlist?: PlaylistItemJson[];
  starts_at: string;
  user_id: number;
}
