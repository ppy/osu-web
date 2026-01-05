// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJson from 'interfaces/beatmap-json';
import ScoreJson from 'interfaces/score-json';
import UserJson from 'interfaces/user-json';
import WithBeatmapOwners from 'interfaces/with-beatmap-owners';

export type BeatmapForWrappedJson = WithBeatmapOwners<BeatmapJson> & Required<Pick<BeatmapJson, 'beatmapset'>>;

export default interface WrappedData {
  related_beatmaps: BeatmapForWrappedJson[];
  related_users: UserJson[];
  share_link: string;
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

interface Summary {
  daily_challenge: DailyChallenge;
  favourite_artists: FavouriteArtist[];
  favourite_mappers: FavouriteMapper[];
  mapping: Mapping;
  medals: number;
  replays: number;
  scores: Scores;
  top_plays: ScoreJson[];
  user: UserJson;
}
