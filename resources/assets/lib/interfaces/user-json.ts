// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJson from './group-json';
import ProfileBannerJson from './profile-banner';
import UserBadgeJson from './user-badge-json';
import UserStatisticsJson from './user-statistics-json';

export default interface UserJson {
  active_tournament_banner?: ProfileBannerJson | null;
  avatar_url: string;
  badges?: UserBadgeJson[];
  country?: Country;
  country_code: string; // TODO: country object?
  cover?: Cover;
  default_group: string;
  follower_count?: number;
  groups?: GroupJson[];
  id: number;
  is_active: boolean;
  is_bot: boolean;
  is_deleted: boolean;
  is_online: boolean;
  is_supporter: boolean;
  last_visit: string | null;
  pm_friends_only: boolean;
  previous_usernames?: string[];
  profile_colour: string | null;
  statistics?: UserStatisticsJson;
  support_level?: number;
  username: string;
}
