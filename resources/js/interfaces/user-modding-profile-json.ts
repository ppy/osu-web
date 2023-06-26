// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserExtendedJson from './user-extended-json';

type ProfileHeaderIncludes =
  'active_tournament_banner'
  | 'badges'
  | 'comments_count'
  | 'follower_count'
  | 'groups'
  | 'mapping_follower_count'
  | 'previous_usernames'
  | 'support_level';

type ModdingProfileAdditionalIncludes =
  'graveyard_beatmapset_count'
  | 'loved_beatmapset_count'
  | 'pending_beatmapset_count'
  | 'ranked_beatmapset_count'
  | 'statistics';

type UserModdingProfileJson = UserExtendedJson & Required<Pick<UserExtendedJson, ProfileHeaderIncludes | ModdingProfileAdditionalIncludes>>;

export default UserModdingProfileJson;
