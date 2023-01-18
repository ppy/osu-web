// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Layzr, { LayzrInstance } from 'layzr';

export default class OsuLayzr {
  private layzr?: LayzrInstance;
  private observer: MutationObserver;

  constructor() {
    this.observer = new MutationObserver(this.observePage);
    this.observer.observe(document, { childList: true, subtree: true });

    // Layzr depends on document.body which is only available after document is ready.
    $(() => {
      this.layzr ??= Layzr();
      this.reinit();
    });
  }

  private observePage = (mutations: MutationRecord[]) => {
    if (this.layzr == null) return;

    for (const mutation of mutations) {
      for (const node of mutation.addedNodes) {
        if (node instanceof HTMLElement && (node.dataset.normal != null || node.querySelector('[data-normal]') != null)) {
          this.reinit();

          return;
        }
      }
    }
  };

  private reinit() {
    this.layzr?.update().check().handlers(true);
  }
}
