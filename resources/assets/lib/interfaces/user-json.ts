// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJson from './group-json';

export default interface UserJson {
  avatar_url: string;
  country?: Country;
  country_code: string; // TODO: country object?
  cover?: Cover;
  current_mode_rank?: number;
  default_group: string;
  follower_count?: number;
  groups?: GroupJson[];
  id: number;
  is_active: boolean;
  is_bot: boolean;
  is_online: boolean;
  is_supporter: boolean;
  last_visit: string | null;
  pm_friends_only: boolean;
  profile_colour: string | null;
  support_level?: number;
  username: string;
}
