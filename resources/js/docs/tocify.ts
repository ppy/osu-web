// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import 'jquery.tocify';

const selectors = 'h1,h2';

export default class Tocify {
  constructor() {
    this.setHeaderIds();

    $('#toc').tocify({
      extendPage: false,
      hashGenerator(_text: unknown, $element: JQuery<Element>) {
        return $element.attr('id');
      },
      hideEffectSpeed: 180,
      highlightOffset: 60,
      ignoreSelector: '.toc-ignore',
      scrollHistory: true,
      scrollTo: -1,
      selectors,
      showEffectSpeed: 0,
      smoothScroll: false,
      theme: 'none',
    });
  }

  private setHeaderIds() {
    for (const header of document.querySelectorAll(selectors)) {
      if (header instanceof HTMLElement) {
        header.id = header
          .innerText
          .toLowerCase()
          .replace(/\s+/g, '-')
          .replace(/[^\w-]+/g, '')
          .replace(/--+/g, '-')
          .replace(/^-+/, '')
          .replace(/-+$/, '');
      }
    }
  }
}
