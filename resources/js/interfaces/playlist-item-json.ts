// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJson from './beatmap-json';
import LegacyMatchGameJson, { LegacyMatchScoringType } from './legacy-match-game-json';
import { RealtimeRoomType, roomTypeFromLegacy } from './room-json';
import { RulesetId } from './ruleset';
import ScoreJson from './score-json';
import ScoreModJson from './score-mod-json';

export function playlistItemFromLegacy(game: LegacyMatchGameJson): PlaylistItemJsonForMultiplayerEvent {
  const teams: Details['teams'] = {};
  for (const score of game.scores) {
    const team = score.match.team;
    if (team === 'blue' || team === 'red') {
      teams[score.user_id] = team;
    }
  }

  return {
    allowed_mods: [],
    beatmap: game.beatmap,
    beatmap_id: game.beatmap_id,
    created_at: game.start_time,
    details: {
      room_type: roomTypeFromLegacy[game.team_type],
      started_at: game.start_time,
      teams,
    },
    expired: game.end_time != null,
    freestyle: false,
    id: game.id,
    legacy_scoring_type: game.scoring_type,
    played_at: game.end_time,
    required_mods: game.mods.map((m) => ({ acronym: m })),
    room_id: game.match_id,
    ruleset_id: game.mode_int,
    scores: game.scores,
  };
}

export interface Details {
  room_type: RealtimeRoomType;
  started_at: string;
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
  ruleset_id: RulesetId;
}

export interface PlaylistItemJsonForMultiplayerEvent extends PlaylistItemJson {
  details: Details;
  legacy_scoring_type?: LegacyMatchScoringType;
  scores: ScoreJson[];
}
