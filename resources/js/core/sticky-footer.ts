// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { throttle } from 'lodash';

// How to use:
// 1. create a marker on when it should be fixed, with class including
//    'js-sticky-footer' and data attribute 'data-sticky-footer-target'
// 2. subscribe to 'stickyFooter' event
// 3. in the function, check if second parameter (first one is unused event
//    object) is the correct target
// 4. stick if matches, unstick otherwise
export default class StickyFooter {
  private readonly permanentFixedFooter = document.getElementsByClassName('js-permanent-fixed-footer');
  private readonly stickMarker = document.getElementsByClassName('js-sticky-footer');
  private readonly throttledStickOrUnstick;

  constructor() {
    this.throttledStickOrUnstick = throttle(this.stickOrUnstick, 100);

    $(window).on('scroll resize', this.stickOrUnstick);
    $.subscribe('stickyFooter:check', this.throttledStickOrUnstick);
    $(document).on('turbo:load', this.throttledStickOrUnstick);
  }

  markerDisable(el: HTMLElement) {
    el.dataset.stickyFooterDisabled = '1';
  }

  markerEnable(el: HTMLElement) {
    el.dataset.stickyFooterDisabled = '';
  }

  private readonly stickOrUnstick = () => {
    if (this.stickMarker.length === 0) return;

    const footer = this.permanentFixedFooter[0];
    if (!(footer instanceof HTMLElement)) return;

    const bottom = window.innerHeight - footer.offsetHeight;

    for (const marker of this.stickMarker) {
      if (marker instanceof HTMLElement) {
        if (marker.dataset.stickyFooterDisabled === '1') continue;

        if (marker.getBoundingClientRect().top >= bottom) {
          $.publish('stickyFooter', marker.dataset.stickyFooterTarget);
          return;
        }
      }
    }

    $.publish('stickyFooter');
  };
}
