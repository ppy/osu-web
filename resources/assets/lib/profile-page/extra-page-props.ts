// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';
import UserProfileJson from 'interfaces/user-profile-json';
import Controller from './controller';

export const beatmapsetSections = [
  'favouriteBeatmapsets',
  'rankedBeatmapsets',
  'lovedBeatmapsets',
  'pendingBeatmapsets',
  'graveyardBeatmapsets',
] as const;
export type BeatmapsetSection = typeof beatmapsetSections[number];

// sorted by display order in the page
export const topScoreSections = ['scoresPinned', 'scoresBest', 'scoresFirsts'] as const;
export type TopScoreSection = typeof topScoreSections[number];

const historicalSections = ['beatmapPlaycounts', 'scoresRecent'] as const;
export type HistoricalSection = typeof historicalSections[number];

type ProfilePageIncludes =
  'account_history'
  | 'beatmap_playcounts_count'
  | 'favourite_beatmapset_count'
  | 'graveyard_beatmapset_count'
  | 'loved_beatmapset_count'
  | 'monthly_playcounts'
  | 'page'
  | 'pending_beatmapset_count'
  | 'rank_history'
  | 'ranked_beatmapset_count'
  | 'replays_watched_counts'
  | 'scores_best_count'
  | 'scores_first_count'
  | 'scores_pinned_count'
  | 'scores_recent_count'
  | 'statistics'
  | 'user_achievements';

export type ProfilePageUserJson = UserProfileJson & Required<Pick<UserJson, ProfilePageIncludes>>;

export const profilePageSections = [...beatmapsetSections, ...topScoreSections, ...historicalSections, 'recentActivity', 'recentlyReceivedKudosu'] as const;
export type ProfilePageSection = typeof profilePageSections[number];

export default interface ExtraPageProps {
  controller: Controller;
  name: string;
}
