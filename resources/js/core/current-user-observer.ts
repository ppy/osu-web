// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { reaction, runInAction } from 'mobx';
import OsuCore from 'osu-core';
import { urlPresence } from 'utils/css';

export default class CurrentUserObserver {
  private get avatarUrl() {
    return this.core.currentUser?.avatar_url;
  }

  private get coverUrl() {
    return this.core.currentUser?.cover.url;
  }

  constructor(private readonly core: OsuCore) {
    // one time setup to monitor user url variables. No disposer because nothing destroys this object.
    $(() => {
      reaction(() => this.avatarUrl, this.setAvatar);
      reaction(() => this.coverUrl, this.setCover);

      runInAction(() => {
        this.setAvatar(this.avatarUrl);
        this.setCover(this.coverUrl);
      });
    });
  }

  private setAvatar(this: void, url: string | undefined) {
    document.documentElement.style.setProperty(
      '--current-user-avatar',
      urlPresence(url) ?? '',
    );
  }

  private setCover(this: void, url: string | null | undefined) {
    document.documentElement.style.setProperty(
      '--current-user-cover',
      urlPresence(url) ?? '',
    );
  }
}
