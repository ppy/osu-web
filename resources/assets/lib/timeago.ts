// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default class Timeago {
  private observer: MutationObserver;

  constructor() {
    this.observer = new MutationObserver((mutations) => {
      // Third-party scripts may init conflicting versions of jquery
      if ($.fn.timeago == null) return;

      mutations.forEach((mutation) => {
        $(mutation.addedNodes)
          .find('.js-timeago')
          .addBack('.js-timeago')
          .timeago();
      });
    });

    $(document).on('turbolinks:load', () => {
      $('.js-timeago').timeago();
      this.observer.observe(document.body, { childList: true, subtree: true })
    });
  }
}
