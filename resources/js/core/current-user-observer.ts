// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { reaction } from 'mobx';
import OsuCore from 'osu-core';
import { urlPresence } from 'utils/css';

export default class CurrentUserObserver {
  private readonly avatars = document.getElementsByClassName('js-current-user-avatar');
  private readonly covers = document.getElementsByClassName('js-current-user-cover');

  constructor(private readonly core: OsuCore) {
    $(document).on('turbo:load', this.setAvatars);
    $(document).on('turbo:load', this.setCovers);

    // one time setup to monitor user url variables. No disposer because nothing destroys this object.
    $(() => reaction(() => this.core.currentUser?.avatar_url, this.setAvatars));
    $(() => reaction(() => this.core.currentUser?.cover.url, this.setCovers));
  }

  private readonly setAvatars = () => {
    const bgImage = urlPresence(this.core.currentUser?.avatar_url) ?? '';
    for (const el of this.avatars) {
      if (el instanceof HTMLElement) {
        el.style.backgroundImage = bgImage;
      }
    }
  };

  private readonly setCovers = () => {
    const bgImage = urlPresence(this.core.currentUser?.cover.url) ?? '';
    for (const el of this.covers) {
      if (el instanceof HTMLElement) {
        el.style.backgroundImage = bgImage;
      }
    }
  };
}
