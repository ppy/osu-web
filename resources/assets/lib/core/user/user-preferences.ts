// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import CurrentUser from 'interfaces/current-user';
import { defaultUserPreferencesJson, UserPreferencesJson } from 'interfaces/current-user';
import { route } from 'laroute';
import { makeObservable, observable } from 'mobx';
import { onErrorWithCallback } from 'utils/ajax';

export default class UserPreferences {
  @observable private current: UserPreferencesJson;
  private updatingOptions = false;
  private user?: CurrentUser;

  constructor() {
    this.current = Object.assign({}, defaultUserPreferencesJson, this.fromStorage());

    makeObservable(this);
  }

  get<T extends keyof UserPreferencesJson>(key: T) {
    return this.current[key];
  }

  set<T extends keyof UserPreferencesJson>(key: T, value: UserPreferencesJson[T]) {
    if (this.current[key] === value) return;

    this.current[key] = value;
    localStorage.userPreferences = JSON.stringify(this.current);

    if (this.user == null) return;

    this.updatingOptions = true;

    return $.ajax(route('account.options'), {
      data: { user_profile_customization: { [key]: value } },
      dataType: 'JSON',
      method: 'PUT',
    }).done((user: CurrentUser) => {
      $.publish('user:update', user);
    }).fail(
      onErrorWithCallback(),
    ).always(() => {
      this.updatingOptions = false;
    });
  }

  setUser(user?: CurrentUser) {
    this.user = user;

    if (user != null && !this.updatingOptions) {
      this.current = user?.user_preferences;
    }
  }

  private fromStorage(): Partial<UserPreferencesJson> {
    try {
      const preferences: Partial<UserPreferencesJson> = JSON.parse(localStorage.userPreferences);

      if (preferences != null && typeof preferences === 'object') {
        return preferences;
      }
    } catch {
      // do nothing and let it be cleared on next update
    }

    return {};
  }
}
