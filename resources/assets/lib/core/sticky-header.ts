// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { debounce } from 'lodash';
import core from 'osu-core-singleton';
import { fadeToggle } from 'utils/fade';
import { htmlElementOrNull } from 'utils/html';

/**
 * Attachment that shows up below the omni-header.
 * How to use:
 * 1. render content into 'js-sticky-header-content' and 'js-sticky-header-breadcrumbs'
 * 2. Add 'js-sticky-header' class to a marker element that should cause the sticky to show.
 */
export default class StickyHeader {
  private readonly debouncedOnScroll = debounce(() => this.onScroll(), 20);
  private readonly header = document.getElementsByClassName('js-pinned-header');
  private readonly marker = document.getElementsByClassName('js-sticky-header');
  private readonly pinnedSticky = document.getElementsByClassName('js-pinned-header-sticky');

  get breadcrumbsElement() {
    return htmlElementOrNull(window.newBody?.querySelector('.js-sticky-header-breadcrumbs'));
  }

  get contentElement() {
    return htmlElementOrNull(window.newBody?.querySelector('.js-sticky-header-content'));
  }

  get headerHeight() {
    const styles = window._styles.header;

    return core.windowSize.isMobile
      ? styles.heightMobile
      : styles.heightSticky;
  }

  private get scrollOffsetValue() {
    // just assume scroll will always try to go to a position that causes sticky to show.
    // TODO: don't assume.
    const pinnedSticky = this.pinnedSticky[0];
    const stickyHeight = pinnedSticky == null ? 0 : pinnedSticky.getBoundingClientRect().height;

    return this.headerHeight + stickyHeight;
  }

  private get shouldStick() {
    const marker = this.marker[0];
    const pinnedSticky = this.pinnedSticky[0];

    if (marker == null || pinnedSticky == null) return;

    const markerTop = marker.getBoundingClientRect().top;
    const headerBottom = this.headerHeight + pinnedSticky.getBoundingClientRect().height;

    return markerTop < headerBottom;
  }

  constructor() {
    $(window).on('scroll', this.onScroll);
    $(document).on('turbolinks:load', this.debouncedOnScroll);
    $.subscribe('osu:page:change', this.debouncedOnScroll);
    $(window).on('resize', this.stickOrUnstick);
  }

  scrollOffset(orig: number) {
    return Math.max(0, orig - this.scrollOffsetValue);
  }

  private readonly onScroll = () => {
    this.pin();
    this.stickOrUnstick();
  };

  private pin() {
    if (this.header[0] == null) return;

    if (this.shouldPin()) {
      document.body.classList.add('js-header-is-pinned');
    } else {
      document.body.classList.remove('js-header-is-pinned');
    }
  }

  private setVisible(visible: boolean) {
    fadeToggle(htmlElementOrNull(this.pinnedSticky[0]), visible);

    $(document).trigger('sticky-header:sticking', [visible]);
  }

  private shouldPin(offset?: number | null) {
    return (offset ?? window.pageYOffset) > 30 || this.shouldStick;
  }

  private readonly stickOrUnstick = () => {
    const visible = this.shouldStick; // undefined when no elements exist

    if (visible == null) return;

    this.setVisible(visible);
  };
}
