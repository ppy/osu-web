// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import CountryJson from './country-json';
import GameMode from './game-mode';
import ProfileBannerJson from './profile-banner';
import RankHistoryJson from './rank-history-json';
import UserAccountHistoryJson from './user-account-history-json';
import UserAchievementJson from './user-achievement-json';
import UserBadgeJson from './user-badge-json';
import UserCoverJson from './user-cover-json';
import UserGroupJson from './user-group-json';
import UserPreferencesJson from './user-preferences-json';
import UserRelationJson from './user-relation-json';
import UserStatisticsJson from './user-statistics-json';

interface UserMonthlyPlaycountJson {
  count: number;
  start_date: string;
}

type UserStatisticsRulesetsJson = Partial<Record<GameMode, UserStatisticsJson | null>>;

interface UserReplaysWatchedCount {
  count: number;
  start_date: string;
}

interface UserJsonAvailableIncludes {
  account_history: UserAccountHistoryJson[];
  active_tournament_banner: ProfileBannerJson | null;
  badges: UserBadgeJson[];
  beatmap_playcounts_count: number;
  blocks: UserRelationJson[];
  comments_count: number;
  country: CountryJson | null;
  cover: UserCoverJson;
  favourite_beatmapset_count: number;
  follow_user_mapping: number[];
  follower_count: number;
  friends: UserRelationJson[];
  graveyard_beatmapset_count: number;
  groups: UserGroupJson[];
  is_admin: boolean;
  is_bng: boolean;
  is_full_bn: boolean;
  is_gmt: boolean;
  is_limited_bn: boolean;
  is_moderator: boolean;
  is_nat: boolean;
  is_restricted: boolean;
  is_silenced: boolean;
  loved_beatmapset_count: number;
  mapping_follower_count: number;
  monthly_playcounts: UserMonthlyPlaycountJson;
  page: {
    html: string;
    raw: string;
  };
  pending_beatmapset_count: number;
  previous_usernames: string[];
  rank_history: RankHistoryJson | null;
  ranked_beatmapset_count: number;
  replays_watched_counts: UserReplaysWatchedCount[];
  scores_best_count: number;
  scores_first_count: number;
  scores_recent_count: number;
  statistics: UserStatisticsJson;
  statistics_rulesets: UserStatisticsRulesetsJson;
  support_level: number;
  unread_pm_count: number;
  user_achievements: UserAchievementJson[];
  user_preferences: UserPreferencesJson;
}

interface UserJsonDefaultAttributes {
  avatar_url: string;
  country_code: string; // TODO: country object?
  default_group: string;
  id: number;
  is_active: boolean;
  is_bot: boolean;
  is_deleted: boolean;
  is_online: boolean;
  is_supporter: boolean;
  last_visit: string | null;
  pm_friends_only: boolean;
  profile_colour: string | null;
  username: string;
}

type UserJson = UserJsonDefaultAttributes & Partial<UserJsonAvailableIncludes>;

export default UserJson;
