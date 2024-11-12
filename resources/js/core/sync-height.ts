// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default class SyncHeight {
  private readonly observer;
  private readonly references = document.getElementsByClassName('js-sync-height--reference');
  private readonly targets = document.getElementsByClassName('js-sync-height--target');

  constructor() {
    $(document).on('turbo:load', this.sync);
    $.subscribe('sync-height:force', this.sync);
    $(window).on('resize', this.sync);

    this.observer = new MutationObserver(this.onResize);
    this.observer.observe(document, {
      attributes: true,
      subtree: true,
    });
  }

  private readonly onResize = (mutations: MutationRecord[]) => {
    for (const mutation of mutations) {
      if (mutation.target instanceof HTMLTextAreaElement) {
        this.sync();
        return;
      }
    }
  };

  private readonly sync = () => {
    const heights: Partial<Record<string, number>> = {};

    for (const reference of this.references) {
      if (!(reference instanceof HTMLElement)) continue;

      const id = reference.dataset.syncHeightTarget;
      if (id != null) {
        heights[id] = reference.offsetHeight;
      }
    }

    for (const target of this.targets) {
      if (!(target instanceof HTMLElement)) continue;

      const id = target.dataset.syncHeightId;
      if (id != null) {
        const height = heights[id];
        if (height != null) {
          target.style.minHeight = `${height}px`;
        }
      }
    }
  };
}
