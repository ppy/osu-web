// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton';

export default class PinnedNoticesScrollPadding {
  constructor() {
    $(document).on('turbolinks:load', this.adjustScrollPadding);
  }

  private adjustScrollPadding = () => {
    const pinnedNotices = document.querySelector('.js-wiki-pinned-notices');

    if (!(pinnedNotices instanceof HTMLElement)) return;

    const scrollPadding =
      core.stickyHeader.headerHeight +
      pinnedNotices.getBoundingClientRect().height +
      10;
    document.documentElement.style.scrollPaddingTop = `${scrollPadding}px`;
  };
}
