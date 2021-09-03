// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default class Timeago {
  private static readonly className = 'js-timeago';
  private static readonly searchQuery = `.${Timeago.className}`;

  private readonly observer = new MutationObserver(Timeago.handleMutations);

  constructor() {
    this.observer.observe(document, {
      attributeFilter: ['datetime'],
      attributeOldValue: true,
      childList: true,
      subtree: true,
    });
  }

  private static readonly handleMutation = (mutation: MutationRecord) => {
    switch (mutation.type) {
      case 'childList':
        $(mutation.addedNodes)
          .find(Timeago.searchQuery)
          .addBack(Timeago.searchQuery)
          .timeago();
        break;
      case 'attributes':
        if (
          mutation.target instanceof HTMLTimeElement
          && mutation.target.dateTime !== mutation.oldValue
          && mutation.target.classList.contains(Timeago.className)
        ) {
          $(mutation.target).timeago('updateFromDOM');
        }
        break;
    }
  };

  private static readonly handleMutations = (mutations: MutationRecord[]) => {
    // Third-party scripts may init conflicting versions of jquery
    if ($.fn.timeago == null) return;

    mutations.forEach(Timeago.handleMutation);
  };
}
