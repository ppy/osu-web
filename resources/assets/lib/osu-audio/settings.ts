// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import Main from './main';

export default class Settings {
  autoplay = false;

  private applied = false;

  get muted() {
    return this.main.audio.muted;
  }

  get volume() {
    return this.main.audio.volume;
  }

  set volume(volume: number) {
    this.main.audio.volume = volume;
  }

  constructor(private main: Main) {
  }

  apply() {
    if (!this.applied) {
      this.applied = true;
      this.toggleMuted(this.storedMuted());
      this.toggleAutoplay(this.storedAutoplay());
      this.volume = this.storedVolume();
    }
  }

  save() {
    localStorage.audioAutoplay = JSON.stringify(this.autoplay);
    localStorage.audioVolume = JSON.stringify(this.volume);
    localStorage.audioMuted = JSON.stringify(this.muted);

    if (currentUser.id != null) {
      $.ajax(route('account.options'), {
        data: { user_profile_customization: {
          audio_autoplay: this.autoplay,
          audio_muted: this.muted,
          audio_volume: this.volume,
        } },
        method: 'PUT',
      }).fail(osu.ajaxError);
    }
  }

  toggleAutoplay(autoplay?: boolean) {
    this.autoplay = autoplay == null ? !this.autoplay : autoplay;
  }

  toggleMuted(muted?: boolean) {
    this.main.audio.muted = muted == null ? !this.muted : muted;
  }

  private fromLocalStorage(key: string) {
    if (localStorage[key] == null) {
      return null;
    }

    try {
      return JSON.parse(localStorage[key]);
    } catch {
      console.debug(`invalid local ${key} data`);
      delete localStorage[key];

      return null;
    }
  }

  private storedAutoplay() {
    const local = this.fromLocalStorage('audioAutoplay');

    if (typeof local === 'boolean') {
      return local;
    }

    const userPreference = currentUser.user_preferences?.audio_autoplay;

    if (typeof userPreference === 'boolean') {
      return userPreference;
    }

    return true;
  }

  private storedMuted() {
    const local = this.fromLocalStorage('audioMuted');

    if (typeof local === 'boolean') {
      return local;
    }

    const userPreference = currentUser.user_preferences?.audio_muted;

    if (typeof userPreference === 'boolean') {
      return userPreference;
    }

    return false;
  }

  private storedVolume() {
    const local = this.fromLocalStorage('audioVolume');

    if (typeof local === 'number') {
      return local;
    }

    const userPreference = currentUser.user_preferences?.audio_volume;

    if (typeof userPreference === 'number') {
      return userPreference;
    }

    return 0.45;
  }
}
