// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import * as ReactDOM from 'react-dom';

function isTurbolinksPermanent(element: Element) {
  return element instanceof HTMLElement && element.id !== '' && element.dataset.turbolinksPermanent != null;
}

type ElementFn = (target: Element) => React.ReactElement;

interface Component {
  elementFn: ElementFn;
  loaded: boolean;
  persistent: boolean;
  targets: HTMLCollection;
}

export default class ReactTurbolinks {
  private components = new Map<string, Component>();
  private documentReady = false;
  private newVisit = true;
  private scrolled = false;
  private scrollTimeout?: number;
  private targets = new Set<Element>();

  constructor() {
    $(document).on('turbolinks:before-cache', this.onBeforeCache);
    $(document).on('turbolinks:before-visit', this.onBeforeVisit);
    $(document).on('turbolinks:load', this.onLoad);
  }

  allTargets = (callback: (params: { component: Component; name: string; target: Element }) => void) => {
    for (const [name, component] of this.components.entries()) {
      for (const target of component.targets) {
        callback({ component, name, target });
      }
    }
  };

  boot = () => {
    if (!this.documentReady) return;

    this.allTargets(({ target, component }) => {
      if (this.targets.has(target)) return;

      this.targets.add(target);
      ReactDOM.render(component.elementFn(target), target);
    });
  };

  destroy = () => {
    this.allTargets(({ target, component }) => {
      if (!isTurbolinksPermanent(target) && this.targets.has(target) && !component.persistent) {
        ReactDOM.unmountComponentAtNode(target);
      }
    });
  };

  destroyPersisted = () => {
    for (const target of this.targets.values()) {
      if (isTurbolinksPermanent(target) && document.body.contains(target)) continue;

      ReactDOM.unmountComponentAtNode(target);
      this.targets.delete(target);
    }
  };

  onBeforeCache = () => {
    window.clearTimeout(this.scrollTimeout);
    this.documentReady = false;
    this.destroy();
  };

  onBeforeVisit = () => {
    this.newVisit = true;
  };

  onLoad = () => {
    this.scrolled = false;
    $(window).off('scroll', this.onWindowScroll);
    $(window).on('scroll', this.onWindowScroll);

    // Delayed to wait until cacheSnapshot finishes. The delay matches Turbolinks' defer.
    window.setTimeout(() => {
      this.destroyPersisted();
      this.documentReady = true;
      this.boot();
      this.scrollTimeout = window.setTimeout(this.scrollOnNewVisit, 100);
    }, 1);
  };

  onWindowScroll = () => {
    this.scrolled = this.scrolled || window.scrollX !== 0 || window.scrollY !== 0;
  };

  register(name: string, persistent: boolean, elementFn: ElementFn) {
    if (this.components.has(name)) return;

    this.components.set(name, {
      elementFn,
      loaded: false,
      persistent,
      targets: document.getElementsByClassName(`js-react--${name}`),
    });

    this.boot();
  }

  scrollOnNewVisit = () => {
    $(window).off('scroll', this.onWindowScroll);
    const newVisit = this.newVisit;
    this.newVisit = false;

    if (!newVisit || this.scrolled) return;

    const targetId = decodeURIComponent(document.location.hash.substr(1));

    if (targetId === '') return;

    document.getElementById(targetId)?.scrollIntoView();
  };
}
