// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Jets from 'jets';

export default class Search {
  readonly jets: Jets;

  constructor() {
    const wrapper = document.getElementById('toc');

    if (wrapper == null) {
      throw new Error('#toc element is missing');
    }

    this.jets = new Jets({
      contentTag: '#toc li',
      didSearch(term: string) {
        wrapper.classList.toggle('jets-searching', String(term).length > 0);
      },
      searchSelector: '*OR',
      searchTag: '#input-search',
    });
  }
}
