// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Layzr, { LayzrInstance } from 'layzr';

export default class OsuLayzr {
  private layzr?: LayzrInstance;
  private observer: MutationObserver;

  constructor() {
    this.observer = new MutationObserver(this.reinit);

    $(document).on('turbolinks:load', this.init);
  }

  init = () => {
    this.layzr ??= Layzr();

    this.reinit();
    this.observer.observe(document.body, { childList: true, subtree: true });
  }

  reinit = () => {
    this.layzr?.update().check().handlers(true);
  }
}
