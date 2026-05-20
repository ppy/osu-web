// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ScoreJson, { ScoreJsonForUser } from './score-json';

interface ScoreReplayStatsJsonAvailableIncludes {
  score: ScoreJson;
}

interface ScoreReplayStatsJsonDefaultAttributes {
  score_id: number;
  watch_count: number;
}

type ScoreReplayStatsJson = ScoreReplayStatsJsonDefaultAttributes & Partial<ScoreReplayStatsJsonAvailableIncludes>;

export default ScoreReplayStatsJson;

export type ScoreReplayStatsJsonForUser = ScoreReplayStatsJson & { score: ScoreJsonForUser };
