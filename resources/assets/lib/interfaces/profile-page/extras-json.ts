// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapPlaycountJson from 'interfaces/beatmap-playcount-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import ErrorJson from 'interfaces/error-json';
import EventJson from 'interfaces/event-json';
import KudosuHistoryJson from 'interfaces/kudosu-history-json';
import { ScoreJsonForUser } from 'interfaces/score-json';

export default interface ExtrasJson {
  beatmapPlaycounts: BeatmapPlaycountJson[];
  favouriteBeatmapsets: BeatmapsetExtendedJson[];
  graveyardBeatmapsets: BeatmapsetExtendedJson[];
  lovedBeatmapsets: BeatmapsetExtendedJson[];
  pendingBeatmapsets: BeatmapsetExtendedJson[];
  rankedBeatmapsets: BeatmapsetExtendedJson[];
  recentActivity: EventJson[];
  recentlyReceivedKudosu: KudosuHistoryJson[];
  scoresBest: ScoreJsonForUser[] | ErrorJson;
  scoresFirsts: ScoreJsonForUser[];
  scoresPinned: ScoreJsonForUser[];
  scoresRecent: ScoreJsonForUser[];
}
