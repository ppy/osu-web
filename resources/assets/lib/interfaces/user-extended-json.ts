// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from 'interfaces/game-mode';
import UserJson from 'interfaces/user-json';

export type ProfileExtraPage =
  'beatmaps'
  | 'historical'
  | 'kudosu'
  | 'me'
  | 'medals'
  | 'recent_activity'
  | 'top_ranks';

type UserExtendedDefaultIncludes =
  'country'
  | 'cover'
  | 'is_admin'
  | 'is_bng'
  | 'is_full_bn'
  | 'is_gmt'
  | 'is_limited_bn'
  | 'is_moderator'
  | 'is_nat'
  | 'is_restricted'
  | 'is_silenced';

interface UserExtendedAdditionalAttributes {
  discord: string | null;
  has_supported: boolean;
  interests: string | null;
  join_date: string;
  kudosu: {
    available: number;
    total: number;
  };
  location: string | null;
  max_blocks: number;
  max_friends: number;
  occupation: string | null;
  playmode: GameMode | null;
  playstyle: string[];
  post_count: number;
  profile_order: ProfileExtraPage[];
  title: string | null;
  title_url: string | null;
  twitter: string | null;
  website: string | null;
}
type UserExtendedJson = UserJson & Required<Pick<UserJson, UserExtendedDefaultIncludes>> & UserExtendedAdditionalAttributes;

export default UserExtendedJson;
