import { action, autorun, makeObservable, observable, runInAction } from 'mobx';
import OsuCore from 'osu-core';
import { formatNumber } from 'utils/html';

export default class BrowserTitleWithNotificationCount {
  private disposer?: () => void;
  @observable private origTitle = '';

  set title(newTitle: string) {
    runInAction(() => {
      this.origTitle = `${newTitle} | osu!`;
    });
  }

  constructor(private core: OsuCore) {
    document.addEventListener('turbolinks:load', this.setTitle);
    document.addEventListener('turbolinks:before-cache', this.resetTitle);
    makeObservable(this);
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

      document.title = `${titlePrefix}${this.origTitle}`;
    });
  };
}
