// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserExtendedJson, { ProfileExtraPage } from 'interfaces/user-extended-json';
import Controller from './controller';

export const beatmapsetSections = [
  'favouriteBeatmapsets',
  'graveyardBeatmapsets',
  'guestBeatmapsets',
  'lovedBeatmapsets',
  'nominatedBeatmapsets',
  'pendingBeatmapsets',
  'rankedBeatmapsets',
] as const;
export type BeatmapsetSection = typeof beatmapsetSections[number];

// sorted by display order in the page
export const topScoreSections = ['scoresPinned', 'scoresBest', 'scoresFirsts'] as const;
export type TopScoreSection = typeof topScoreSections[number];

const historicalSections = ['beatmapPlaycounts', 'scoresRecent'] as const;
export type HistoricalSection = typeof historicalSections[number];

type ProfilePageIncludes =
  'account_history'
  | 'active_tournament_banner'
  | 'badges'
  | 'comments_count'
  | 'follower_count'
  | 'groups'
  | 'mapping_follower_count'
  | 'page'
  | 'previous_usernames'
  | 'rank_highest'
  | 'rank_history'
  | 'statistics'
  | 'support_level'
  | 'user_achievements';

export type ProfilePageUserJson = UserExtendedJson & Required<Pick<UserExtendedJson, ProfilePageIncludes>>;

export const profilePageSections = [...beatmapsetSections, ...topScoreSections, ...historicalSections, 'recentActivity', 'recentlyReceivedKudosu'] as const;
export type ProfilePageSection = typeof profilePageSections[number];

export default interface ExtraPageProps {
  controller: Controller;
  name: ProfileExtraPage;
}
