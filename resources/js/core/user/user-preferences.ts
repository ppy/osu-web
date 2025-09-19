// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import CurrentUserJson from 'interfaces/current-user-json';
import UserPreferencesJson, { defaultUserPreferencesJson } from 'interfaces/user-preferences-json';
import { route } from 'laroute';
import { action, makeObservable, observable } from 'mobx';
import { onErrorWithCallback } from 'utils/ajax';

const localStorageKey = 'userPreferences';

export default class UserPreferences {
  @observable private current: UserPreferencesJson;
  private updatingOptions = false;
  private user?: CurrentUserJson;

  constructor() {
    this.current = this.fromStorageWithDefaults();

    makeObservable(this);

    window.addEventListener('storage', this.updateFromStorage);
  }

  get<T extends keyof UserPreferencesJson>(key: T) {
    return this.current[key];
  }

  @action
  set<T extends keyof UserPreferencesJson>(key: T, value: UserPreferencesJson[T]) {
    if (this.current[key] === value) return;

    this.current[key] = value;
    this.updateStorage();

    if (this.user == null) return;

    this.updatingOptions = true;

    return $.ajax(route('account.options'), {
      data: { user_profile_customization: { [key]: value } },
      dataType: 'JSON',
      method: 'PUT',
    }).done((user: CurrentUserJson) => {
      $.publish('user:update', user);
    }).fail(
      onErrorWithCallback(),
    ).always(() => {
      this.updatingOptions = false;
    });
  }

  @action
  setUser(user?: CurrentUserJson) {
    this.user = user;

    if (!this.updatingOptions) {
      this.current = user?.user_preferences ?? defaultUserPreferencesJson();
      this.updateStorage();
    }
  }

  private fromStorage(): Partial<UserPreferencesJson> {
    try {
      const data = localStorage.getItem(localStorageKey);
      if (data != null) {
        const preferences = JSON.parse(data) as unknown;

        if (preferences != null && typeof preferences === 'object') {
          return preferences as Partial<UserPreferencesJson>;
        }
      }
    } catch {
      // do nothing and let it be cleared on next update
    }

    return {};
  }

  private fromStorageWithDefaults() {
    return Object.assign(defaultUserPreferencesJson(), this.fromStorage());
  }

  @action
  private readonly updateFromStorage = (event: StorageEvent) => {
    if (event.key == null || event.key === localStorageKey) {
      this.current = this.fromStorageWithDefaults();
    }
  };

  private updateStorage() {
    localStorage[localStorageKey] = JSON.stringify(this.current);
  }
}
