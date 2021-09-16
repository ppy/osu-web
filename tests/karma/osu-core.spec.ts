// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';
import User from 'models/user';
import OsuCore from 'osu-core';

describe('OsuCore user:update subscriber testing thing', () => {
  it('user:update should update the user store from a JSON value', () => {
    const core = new OsuCore();

    const json: UserJson = {
      avatar_url: '',
      country_code: '',
      cover: { custom_url: null, id: null, url: null },
      default_group: '',
      id: 1,
      is_active: true,
      is_bot: false,
      is_deleted: false,
      is_online: true,
      is_supporter: true,
      last_visit: null,
      pm_friends_only: false,
      profile_colour: null,
      username: 'foo',
    };

    const user = User.fromJson(json);

    $.publish('user:update', json);

    expect(core.dataStore.userStore.users.get(1)).toEqual(user);
    expect(core.dataStore.userStore.users.size).toEqual(1);
  });
});
