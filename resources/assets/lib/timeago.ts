// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

const searchQuery = '.js-timeago';

export default class Timeago {
  private observer: MutationObserver;

  constructor() {
    this.observer = new MutationObserver(this.observePage);
    this.observer.observe(document, { childList: true, subtree: true })
  }

  private observePage = (mutations: MutationRecord[]) => {
    // Third-party scripts may init conflicting versions of jquery
    if ($.fn.timeago == null) return;

    mutations.forEach((mutation) => {
      $(mutation.addedNodes)
        .find(searchQuery)
        .addBack(searchQuery)
        .timeago();
    });
  }
}
