// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as moment from 'moment';

export default class Localtime {
  private observer: MutationObserver;

  constructor() {
    this.observer = new MutationObserver(this.mutationHandler);
    this.observer.observe(document, { childList: true, subtree: true });
  }

  private formatElem = (elem: HTMLTimeElement) => {
    if (elem.dataset.localtime === '1') {
      return;
    }

    elem.dataset.localtime = '1';
    elem.classList.add('js-tooltip-time');
    elem.title = elem.dateTime;
    elem.innerText = moment(elem.dateTime).format('LLL');
  };

  private formatElems = (elems?: HTMLTimeElement[]) => {
    if (elems == null) {
      elems = this.getElems(document.body);
    }

    return elems.map(this.formatElem);
  };

  private getElems = (parent: Node): HTMLTimeElement[] => {
    if (!(parent instanceof HTMLElement)) {
      return [];
    }

    if (parent instanceof HTMLTimeElement && parent.classList.contains('js-localtime')) {
      return [parent];
    } else {
      // Casting is needed because the compiler doesn't detect result of
      // 'time.class-name' query as array of time elements.
      return [...parent.querySelectorAll<HTMLTimeElement>('time.js-localtime')];
    }
  };

  private mutationHandler = (mutations: MutationRecord[]) => {
    const timeElems: HTMLTimeElement[] = [];

    mutations.forEach((mutation) => {
      mutation.addedNodes.forEach((node) => {
        timeElems.push(...this.getElems(node));
      });
    });

    this.formatElems(timeElems);
  };
}
