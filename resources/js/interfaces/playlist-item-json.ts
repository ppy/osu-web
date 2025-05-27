// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJson from './beatmap-json';
import { RealtimeRoomType } from './room-json';
import ScoreJson from './score-json';
import ScoreModJson from './score-mod-json';

export interface Details {
  room_type: RealtimeRoomType;
  teams?: Partial<Record<number, 'red' | 'blue'>>;
}

export default interface PlaylistItemJson {
  allowed_mods: ScoreModJson[];
  beatmap?: BeatmapJson;
  beatmap_id: number;
  created_at: string;
  expired: boolean;
  freestyle: boolean;
  id: number;
  played_at: null | string;
  required_mods: ScoreModJson[];
  room_id: number;
  ruleset_id: number;
}

export interface PlaylistItemJsonForMultiplayerEvent extends PlaylistItemJson {
  details: Details;
  scores: ScoreJson[];
}
