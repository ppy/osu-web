// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import Main from './main';

export default class Settings {
  private applied = false;

  constructor(private main: Main) {
  }

  apply = () => {
    if (!this.applied) {
      this.applied = true;
      this.toggleMuted(this.storedMuted());
      this.setVolume(this.storedVolume());
    }
  }

  getMuted = () => this.main.audio.muted;

  getVolume = () => this.main.audio.volume;

  save = () => {
    localStorage.audioVolume = JSON.stringify(this.getVolume());
    localStorage.audioMuted = JSON.stringify(this.getMuted());

    if (currentUser.id != null) {
      $.ajax(route('account.options'), {
        data: { user_profile_customization: {
          audio_muted: this.getMuted(),
          audio_volume: this.getVolume(),
        } },
        method: 'PUT',
      }).fail(osu.ajaxError);
    }
  }

  setVolume = (volume: number) => {
    this.main.audio.volume = volume;
  }

  toggleMuted = (muted?: boolean) => {
    this.main.audio.muted = muted == null ? !this.getMuted() : muted;
  }

  private storedMuted = () => {
    try {
      const local = JSON.parse(localStorage.audioMuted ?? '');

      if (typeof local === 'boolean') {
        return local;
      }
    } catch {
      console.debug('invalid local audioMuted data');
      delete localStorage.audioMuted;
    }

    const userPreference = currentUser.user_preferences?.audio_muted;

    if (typeof userPreference === 'boolean') {
      return userPreference;
    }

    return false;
  }

  private storedVolume = () => {
    try {
      const local = JSON.parse(localStorage.audioVolume ?? '');

      if (typeof local === 'number') {
        return local;
      }
    } catch {
      console.debug('invalid local audioVolume data');
      delete localStorage.audioVolume;
    }

    const userPreference = currentUser.user_preferences?.audio_volume;

    if (typeof userPreference === 'number') {
      return userPreference;
    }

    return 0.45;
  }
}
