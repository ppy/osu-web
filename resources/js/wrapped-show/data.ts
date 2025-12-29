// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJson from 'interfaces/beatmap-json';
import UserJson from 'interfaces/user-json';
import WithBeatmapOwners from 'interfaces/with-beatmap-owners';

export type BeatmapForWrappedJson = WithBeatmapOwners<BeatmapJson> & Required<Pick<BeatmapJson, 'beatmapset'>>;

export default interface WrappedData {
  related_beatmaps: BeatmapForWrappedJson[];
  related_users: UserJson[];
  summary: Summary;
  user_id: number;
}

export interface DailyChallenge {
  cleared: number;
  highest_streak: number;
  top_10p: number;
  top_50p: number;
}

export interface FavouriteArtist {
  artist: {
    id: null | number;
    name: string;
  };
  scores: {
    pp_avg: number;
    pp_best: number;
    score_avg: number;
    score_best: number;
    score_best_beatmap_id: number;
    score_count: number;
  };
}

export interface FavouriteMapper {
  mapper_id: number;
  scores: {
    pp_avg: number;
    pp_best: number;
    score_avg: number;
    score_best: number;
    score_best_beatmap_id: number;
    score_count: number;
  };
}

export interface Mapping {
  created: number;
  discussions: number;
  guest: number;
  kudosu: number;
  loved: number;
  nominations: number;
  ranked: number;
}

export interface Scores {
  acc: number;
  combo: number;
  playcount: {
    playcount: number;
    pos: number;
    top_percent: number;
  };
  pp: number;
  score: number;
}

// note: maybe be out of date.
export interface TopPlay {
  accuracy: number;
  beatmap_id: number;
  best_id: null;
  build_id: null;
  classic_total_score: number;
  ended_at: string;
  has_replay: boolean;
  id: number;
  is_perfect_combo: boolean;
  legacy_perfect: boolean;
  legacy_score_id: number;
  legacy_total_score: number;
  max_combo: number;
  maximum_statistics: {
    great: number;
    legacy_combo_increase: number;
  };
  mods: {
    acronym: string;
  }[];
  passed: boolean;
  pp: number;
  preserve: boolean;
  processed: boolean;
  rank: string;
  ranked: boolean;
  replay: boolean;
  ruleset_id: number;
  started_at: null;
  statistics: {
    great: number;
    meh: number;
    miss: number;
    ok: number;
  };
  total_score: number;
  total_score_without_mods: number;
  type: string;
  user_id: number;
}

interface Summary {
  daily_challenge: DailyChallenge;
  favourite_artists: FavouriteArtist[];
  favourite_mappers: FavouriteMapper[];
  mapping: Mapping;
  medals: number;
  replays: number;
  scores: Scores;
  top_plays: TopPlay[];
  user: UserJson;
}
