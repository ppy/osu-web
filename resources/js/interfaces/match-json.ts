// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJson from './beatmap-json';
import Ruleset from './ruleset';
import ScoreJson from './score-json';
import UserJson from './user-json';

export default interface Match {
  current_game_id?: number;
  events: MatchEvent[];
  first_event_id: number;
  latest_event_id: number;
  match: MatchDetails;
  users: UserJson[];
}

export interface MatchDetails {
  end_time?: string;
  id: number;
  name: string;
  start_time: string;
}

export interface MatchEvent {
  detail: MatchEventDetail;
  game?: MatchGame;
  id: number;
  timestamp: string;
  user_id?: number;
}

export type MatchEventType =
  | 'host-changed'
  | 'match-created'
  | 'match-disbanded'
  | 'other'
  | 'player-joined'
  | 'player-kicked'
  | 'player-left';

export interface MatchEventDetail {
  text?: string;
  type: MatchEventType;
}

export type MatchScoringType =
  | 'accuracy'
  | 'combo'
  | 'score'
  | 'scorev2';

export type MatchTeamType =
  | 'head-to-head'
  | 'tag-coop'
  | 'tag-team-vs'
  | 'team-vs';

export interface MatchGame {
  beatmap?: BeatmapJson;
  beatmap_id: number;
  end_time?: string;
  id: number;
  mode: Ruleset;
  mods: string[]; // TODO: use ModJson
  scores: ScoreJson[]; // TODO: use SoloScoreJson
  scoring_type: MatchScoringType;
  start_time: string;
  team_type: MatchTeamType;
}
