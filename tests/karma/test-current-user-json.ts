// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import CurrentUserJson from 'interfaces/current-user-json';
import { defaultUserPreferencesJson } from 'interfaces/user-preferences-json';

const testCurrentUserJson: CurrentUserJson = {
  avatar_url: '',
  blocks: [],
  country: {
    code: 'AU',
    name: 'Australia',
  },
  country_code: 'AU',
  cover: { custom_url: null, id: null, url: null },
  default_group: '',
  discord: null,
  follow_user_mapping: [],
  friends: [],
  groups: [],
  has_supported: false,
  id: 1,
  interests: null,
  is_active: true,
  is_admin: false,
  is_bng: false,
  is_bot: false,
  is_deleted: false,
  is_full_bn: false,
  is_gmt: false,
  is_limited_bn: false,
  is_moderator: false,
  is_nat: false,
  is_online: true,
  is_restricted: false,
  is_silenced: false,
  is_supporter: true,
  join_date: '2020-01-01T12:34:56+00:00',
  kudosu: {
    available: 0,
    total: 0,
  },
  last_visit: null,
  location: null,
  max_blocks: 1,
  max_friends: 1,
  occupation: null,
  playmode: 'osu',
  playstyle: [],
  pm_friends_only: false,
  post_count: 0,
  profile_colour: null,
  profile_hue: null,
  profile_order: [],
  title: null,
  title_url: null,
  twitter: null,
  unread_pm_count: 0,
  user_preferences: defaultUserPreferencesJson(),
  username: 'foo',
  website: null,
};

export default testCurrentUserJson;
