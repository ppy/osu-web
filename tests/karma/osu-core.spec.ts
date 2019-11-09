/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import { UserJSON } from 'chat/chat-api-responses';
import User from 'models/user';
import OsuCore from 'osu-core';

describe('OsuCore user:update subscriber testing thing', () => {
  it('user:update should update the user store from a JSON value', () => {
    const core = new OsuCore(window);

    const json: UserJSON = {
      avatar_url: '',
      blocks: [],
      can_moderate: false,
      country_code: '',
      id: 1,
      is_active: true,
      is_admin: true,
      is_bot: false,
      is_online: true,
      is_supporter: true,
      pm_friends_only: false,
      profile_colour: '',
      username: 'foo',
    };

    const user = User.fromJSON(json);

    $.publish('user:update', json);

    expect(core.dataStore.userStore.users.get(1)).toEqual(user);
    expect(core.dataStore.userStore.users.size).toEqual(1);
  });
});
