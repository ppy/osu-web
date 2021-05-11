// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import CurrentUser from 'interfaces/current-user';
import { defaultUserPreferencesJson, UserPreferencesJson } from 'interfaces/current-user';
import { route } from 'laroute';
import { observable } from 'mobx';

export default class UserPreferences {
  @observable private current: UserPreferencesJson;
  private updatingOptions = false;
  private user?: CurrentUser;

  constructor() {
    this.current = Object.assign({}, defaultUserPreferencesJson, this.fromStorage());
  }

  getOpt = <T extends keyof UserPreferencesJson>(key: T) => this.current[key];

  setOpt = <T extends keyof UserPreferencesJson>(key: T, value: UserPreferencesJson[T]) => {
    if (this.current[key] === value) return Promise.resolve(null);

    this.current[key] = value;
    localStorage.userPreferences = JSON.stringify(this.current);

    if (this.user == null) return Promise.resolve(null);

    this.updatingOptions = true;

    return $.ajax(route('account.options'), {
      data: { user_profile_customization: { [key]: value } },
      dataType: 'JSON',
      method: 'PUT',
    }).done((user: CurrentUser) => {
      this.updatingOptions = false;
      $.publish('user:update', user);
    });
  };

  setUser(user?: CurrentUser) {
    this.user = user;

    if (user != null && !this.updatingOptions) {
      this.current = user?.user_preferences;
    }
  }

  private fromStorage(): Partial<UserPreferencesJson> {
    try {
      return JSON.parse(localStorage.userPreferences) as Partial<UserPreferencesJson>;
    } catch {
      return {};
    }
  }
}
