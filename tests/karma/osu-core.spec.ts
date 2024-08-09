// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import User from 'models/user';
import OsuCore from 'osu-core';
import testCurrentUserJson from './test-current-user-json';

const expectedUser = new User(1);
expectedUser.updateWithJson(testCurrentUserJson);

describe('OsuCore user update', () => {
  it('.setCurrentUser should update the user store from a JSON value', () => {
    const core = new OsuCore();
    core.setCurrentUser(testCurrentUserJson);

    expect(core.dataStore.userStore.users.get(1)).toEqual(expectedUser);
    expect(core.dataStore.userStore.users.size).toEqual(1);
  });

  it('user:update subscriber should update the user store from a JSON value', () => {
    const core = new OsuCore();
    $.publish('user:update', testCurrentUserJson);

    expect(core.dataStore.userStore.users.get(1)).toEqual(expectedUser);
    expect(core.dataStore.userStore.users.size).toEqual(1);

    // unset the singleton
    $.publish('user:update', { id: undefined });
  });
});
