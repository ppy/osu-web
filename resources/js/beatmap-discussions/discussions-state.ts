// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { action, autorun, makeObservable, observable, runInAction } from 'mobx';

export default class DiscussionsState {
  @observable discussionCollapsed = new Map<number, boolean>();
  @observable discussionDefaultCollapsed = false;
  @observable highlightedDiscussionId: number | null = null;
  @observable mediaUrls = new Map<string, string>();
  @observable private mediaUrlsPending = new Set<string>();

  constructor() {
    makeObservable(this);

    autorun(() => {
      this.lookupMediaUrls();
    });
  }

  @action
  addUrl(url: string) {
    if (this.mediaUrls.has(url)) return;
    this.mediaUrlsPending.add(url);
  }

  async lookupMediaUrls() {
    if (this.mediaUrlsPending.size === 0) return;

    const xhr = $.post(route('beatmapsets.discussions.media-urls'), {
      urls: [...this.mediaUrlsPending.keys()],
    }) as JQuery.jqXHR<Record<string, string>>;

    const urls = await xhr;

    runInAction(() => {
      for (const [url, proxiedUrl] of Object.entries(urls)) {
        this.mediaUrls.set(url, proxiedUrl);
        this.mediaUrlsPending.delete(url);
      }
    });
  }
}
