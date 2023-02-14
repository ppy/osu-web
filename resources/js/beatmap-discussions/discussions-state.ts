// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { makeObservable, observable, runInAction } from 'mobx';

export default class DiscussionsState {
  @observable discussionCollapsed = new Map<number, boolean>();
  @observable discussionDefaultCollapsed = false;
  @observable highlightedDiscussionId: number | null = null;
  @observable mediaUrls = new Map<string, string>();
  mediaUrlsPending = new Set<string>();

  constructor() {
    makeObservable(this);
  }

  async lookupMediaUrls() {
    const xhr = $.post(route('beatmapsets.discussions.media-urls'), {
      urls: [...this.mediaUrlsPending.values()],
    }) as JQuery.jqXHR<Record<string, string>>;

    const urls = await xhr;

    runInAction(() => {
      for (const [url, proxiedUrl] of Object.entries(urls)) {
        this.mediaUrls.set(url, proxiedUrl);
      }
    });
  }
}
