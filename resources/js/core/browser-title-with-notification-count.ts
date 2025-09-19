// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action, autorun, makeObservable, observable, runInAction } from 'mobx';
import OsuCore from 'osu-core';
import { formatNumber } from 'utils/html';

export default class BrowserTitleWithNotificationCount {
  @observable private customTitle: string | null = null;
  private disposer?: () => void;
  @observable private origTitle = '';

  set title(newTitle: string | null) {
    runInAction(() => {
      this.customTitle = newTitle != null ? `${newTitle} | osu!` : newTitle;
    });
  }

  constructor(private readonly core: OsuCore) {
    makeObservable(this);
    document.addEventListener('turbo:load', this.setTitle);
    document.addEventListener('turbo:before-cache', this.resetTitle);
  }

  @action
  private readonly resetTitle = () => {
    document.title = this.origTitle;
    this.disposer?.();
  };

  @action
  private readonly setTitle = () => {
    this.origTitle = document.title;

    this.disposer = autorun(() => {
      const count = this.core.dataStore.notificationStore.unreadStacks.total;
      const titlePrefix = count === 0
        ? ''
        : `(${formatNumber(count)}) `;

      document.title = `${titlePrefix}${this.customTitle ?? this.origTitle}`;
    });
  };
}
