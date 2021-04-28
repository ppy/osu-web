// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import CurrentUser from 'interfaces/current-user';
import { defaultUserPreferencesJson, UserPreferencesJson } from 'interfaces/current-user';
import { route } from 'laroute';
import { observable } from 'mobx';

export default class UserPreferences {

  get audioAutoplay() {
    return this.current.audio_autoplay;
  }

  set audioAutoplay(value: boolean) {
    if (this.audioAutoplay === value) return;

    this.current.audio_autoplay = value;
    this.updateOptions({ audio_autoplay: value });
  }

  get audioMuted() {
    return this.current.audio_muted;
  }

  set audioMuted(value: boolean) {
    if (this.audioMuted === value) return;

    this.current.audio_muted = value;
    this.updateOptions({ audio_muted: value });
  }

  get audioVolume() {
    return this.current.audio_volume ?? 0.45;
  }

  set audioVolume(value: number) {
    if (this.audioVolume === value) return;

    this.current.audio_volume = value;
    this.updateOptions({ audio_volume: value });
  }
  @observable private current: UserPreferencesJson;
  private updatingOptions = false;
  private user?: CurrentUser;

  constructor() {
    this.current = Object.assign({}, defaultUserPreferencesJson, this.fromStorage());
  }

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

  private updateOptions(newOptions: Partial<UserPreferencesJson>) {
    localStorage.userPreferences = JSON.stringify(Object.assign(this.fromStorage(), newOptions));

    if (this.user == null) return;

    this.updatingOptions = true;

    void $.ajax(route('account.options'), {
      data: { user_profile_customization: newOptions },
      dataType: 'JSON',
      method: 'PUT',
    }).done((user: CurrentUser) => {
      this.updatingOptions = false;
      $.publish('user:update', user);
    });
  }
}
