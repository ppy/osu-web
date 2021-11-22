// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserExtendedJson from 'interfaces/user-extended-json';

export type BeatmapsetSection = 'favouriteBeatmapsets' | 'rankedBeatmapsets' | 'lovedBeatmapsets' | 'pendingBeatmapsets' | 'graveyardBeatmapsets';

export const topScoreSections = ['scoresBest', 'scoresFirsts'] as const;
export type TopScoreSection = typeof topScoreSections[number];

type ProfilePageIncludes =
  'account_history'
  | 'loved_beatmapset_count'
  | 'mapping_follower_count'
  | 'pending_beatmapset_count'
  | 'ranked_beatmapset_count'
  | 'replays_watched_counts'
  | 'scores_best_count'
  | 'scores_first_count'
  | 'scores_recent_count';

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
