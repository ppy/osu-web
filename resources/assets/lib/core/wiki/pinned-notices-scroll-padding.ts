// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default class PinnedNoticesScrollPadding {
  constructor() {
    $(document).on('turbolinks:load', this.adjustScrollPadding);
  }

  private adjustScrollPadding = () => {
    const pinnedNotices = document.querySelector('.js-wiki-pinned-notices');
    const scrollPadding = pinnedNotices instanceof HTMLElement
      ? pinnedNotices.getBoundingClientRect().height + 10
      : 0;
    document.documentElement.style.setProperty('--scroll-padding', `${scrollPadding}px`);
  };
}
