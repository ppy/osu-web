// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserExtendedJson from './user-extended-json';
import { ProfileHeaderIncludes } from './user-json';

type ModdingProfileIncludes =
  ProfileHeaderIncludes
  | 'beatmaps_modded_count'
  | 'beatmapset_status_counts'
  | 'guest_beatmapset_count'
  | 'issues_resolved_count'
  | 'kudosu'
  | 'nominated_beatmapset_count'
  | 'statistics';

type UserModdingProfileJson = UserExtendedJson & Required<Pick<UserExtendedJson, ModdingProfileIncludes>>;

export default UserModdingProfileJson;
