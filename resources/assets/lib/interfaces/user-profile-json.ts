// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserExtendedJson from './user-extended-json';
import UserJson from './user-json';

type UserProfileHeaderIncludes =
  | 'active_tournament_banner'
  | 'badges'
  | 'comments_count'
  | 'follower_count'
  | 'groups'
  | 'mapping_follower_count'
  | 'previous_usernames'
  | 'support_level'
  | 'voted_in_project_loved';

type UserProfileJson = UserExtendedJson & Required<Pick<UserJson, UserProfileHeaderIncludes>>;

export default UserProfileJson;
