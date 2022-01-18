// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserExtendedJson from 'interfaces/user-extended-json';
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
export const topScoreSections = ['scoresBest', 'scoresFirsts', 'scoresPinned'] as const;
export type TopScoreSection = typeof topScoreSections[number];

const historicalSections = ['beatmapPlaycounts', 'scoresRecent'] as const;
export type HistoricalSection = typeof historicalSections[number];

type ProfilePageIncludes =
  'account_history'
  | 'active_tournament_banner'
  | 'badges'
  | 'beatmap_playcounts_count'
  | 'comments_count'
  | 'favourite_beatmapset_count'
  | 'follower_count'
  | 'graveyard_beatmapset_count'
  | 'groups'
  | 'loved_beatmapset_count'
  | 'mapping_follower_count'
  | 'monthly_playcounts'
  | 'page'
  | 'pending_beatmapset_count'
  | 'previous_usernames'
  | 'rank_history'
  | 'ranked_beatmapset_count'
  | 'replays_watched_counts'
  | 'scores_best_count'
  | 'scores_first_count'
  | 'scores_pinned_count'
  | 'scores_recent_count'
  | 'statistics'
  | 'support_level'
  | 'user_achievements';

export type ProfilePageUserJson = UserExtendedJson & Required<Pick<UserExtendedJson, ProfilePageIncludes>>;

export const profilePageSections = [...beatmapsetSections, ...topScoreSections, ...historicalSections, 'recentActivity', 'recentlyReceivedKudosu'] as const;
export type ProfilePageSection = typeof profilePageSections[number];

export default interface ExtraPageProps {
  controller: Controller;
  name: string;
}
