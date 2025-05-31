// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJson from './beatmap-json';
import Ruleset from './ruleset';
import { LegacyMatchScoreJson } from './score-json';

export type LegacyMatchScoringType =
  | 'accuracy'
  | 'combo'
  | 'score'
  | 'scorev2';

export type LegacyMatchTeamType =
  | 'head-to-head'
  | 'tag-coop'
  | 'tag-team-vs'
  | 'team-vs';

export default interface LegacyMatchGameJson {
  beatmap?: BeatmapJson;
  beatmap_id: number;
  end_time: null | string;
  id: number;
  match_id: number;
  mode: Ruleset;
  mode_int: number;
  mods: string[];
  scores: LegacyMatchScoreJson[];
  scoring_type: LegacyMatchScoringType;
  start_time: string;
  team_type: LegacyMatchTeamType;
}
