// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserExtendedJson from 'interfaces/user-extended-json';

export type BeatmapsetSection = 'favouriteBeatmapsets' | 'rankedBeatmapsets' | 'lovedBeatmapsets' | 'pendingBeatmapsets' | 'graveyardBeatmapsets';

export const topScoreSections = ['scoresBest', 'scoresFirsts'] as const;
export type TopScoreSection = typeof topScoreSections[number];

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
  | 'scores_recent_count'
  | 'statistics'
  | 'support_level'
  | 'user_achievements';

export type ProfilePageUserJson = UserExtendedJson & Required<Pick<UserExtendedJson, ProfilePageIncludes>>;

interface Pagination {
  hasMore: boolean;
  loading: boolean;
}

export type ProfilePagePaginationData = Record<BeatmapsetSection | TopScoreSection | 'recentlyReceivedKudosu', Pagination>;

export default interface ExtraPageProps {
  name: string;
  user: ProfilePageUserJson;
  withEdit: boolean;
}
