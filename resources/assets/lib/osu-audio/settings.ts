// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import Main from './main';

export default class Settings {
  private applied = false;
  private autoplay = false;

  constructor(private main: Main) {
  }

  apply = () => {
    if (!this.applied) {
      this.applied = true;
      this.toggleMuted(this.storedMuted());
      this.setVolume(this.storedVolume());
      this.toggleAutoplay(this.storedAutoplay());
    }
  }

  getAutoplay = () => this.autoplay;

  getMuted = () => this.main.audio.muted;

  getVolume = () => this.main.audio.volume;

  save = () => {
    localStorage.audioAutoplay = JSON.stringify(this.getAutoplay());
    localStorage.audioMuted = JSON.stringify(this.getMuted());
    localStorage.audioVolume = JSON.stringify(this.getVolume());

    if (currentUser.id != null) {
      $.ajax(route('account.options'), {
        data: { user_profile_customization: {
          audio_autoplay: this.getAutoplay(),
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

  toggleAutoplay = (autoplay?: boolean) => {
    this.autoplay = autoplay == null ? !this.getAutoplay() : autoplay;
  }

  toggleMuted = (muted?: boolean) => {
    this.main.audio.muted = muted == null ? !this.getMuted() : muted;
  }

  private storedAutoplay = () => {
    try {
      const local = JSON.parse(localStorage.audioAutoplay ?? '');

      if (typeof local === 'boolean') {
        return local;
      }
    } catch {
      console.debug('invalid local audioAutoplay data');
      delete localStorage.audioAutoplay;
    }

    const userPreference = currentUser.user_preferences?.audio_autoplay;

    if (typeof userPreference === 'boolean') {
      return userPreference;
    }

    return true;
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
