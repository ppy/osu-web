// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { TurboBeforeRenderEvent } from '@hotwired/turbo';
import { removeLeftoverPortalContainers } from 'components/portal';
import TurbolinksReload from 'core/turbolinks-reload';
import { runInAction } from 'mobx';
import OsuCore from 'osu-core';
import * as React from 'react';
import * as ReactDOM from 'react-dom';
import { currentUrl } from 'utils/turbolinks';

type ElementFn = (container: HTMLElement) => React.ReactElement;

export default class ReactTurbolinks {
  private readonly components = new Map<string, ElementFn>();
  private newVisit = true;
  private pageReady = false;
  private readonly renderedContainers = new Set<HTMLElement>();
  private scrolled = false;
  private timeoutScroll?: number;

  constructor(private readonly core: OsuCore, private readonly turbolinksReload: TurbolinksReload) {
    $(document).on('turbo:before-cache', this.handleBeforeCache);
    $(document).on('turbo:before-visit', this.handleBeforeVisit);
    $(document).on('turbo:load', this.handleLoad);
    document.addEventListener('turbo:before-render', this.handleBeforeRender);
  }

  boot = () => {
    if (!this.pageReady || window.newBody == null) return;

    for (const container of window.newBody.querySelectorAll('.js-react')) {
      if (!(container instanceof HTMLElement)) {
        continue;
      }
      const name = container.dataset.react ?? '';
      const elementFn = this.components.get(name);

      if (elementFn != null) {
        if (!this.renderedContainers.has(container)) {
          this.renderedContainers.add(container);

          runInAction(() => {
            ReactDOM.render(elementFn(container), container);
          });
        }
      }
    }
  };

  register(name: string, elementFn: ElementFn) {
    if (this.components.has(name)) return;

    this.components.set(name, elementFn);

    this.boot();
  }

  runAfterPageLoad(callback: () => void) {
    if (document.body === window.newBody) {
      callback();
    } else {
      $(document).one('turbo:load', callback);

      return () => {
        $(document).off('turbo:load', callback);
      };
    }
  }

  private readonly destroy = () => {
    for (const target of this.renderedContainers.values()) {
      if (document.body.contains(target)) continue;

      ReactDOM.unmountComponentAtNode(target);
      this.renderedContainers.delete(target);
    }
  };

  private readonly handleBeforeCache = () => {
    this.pageReady = false;
    window.clearTimeout(this.timeoutScroll);
  };

  private readonly handleBeforeRender = (e: TurboBeforeRenderEvent) => {
    e.preventDefault();

    window.newBody = e.detail.newBody;
    this.setNewUrl();
    this.pageReady = true;
    removeLeftoverPortalContainers();
    this.core.updateCurrentUser();
    this.loadScripts().then(() => {
      this.boot();
      e.detail.resume();
    });
  };

  private readonly handleBeforeVisit = () => {
    this.newVisit = true;
  };

  private readonly handleLoad = () => {
    window.newBody ??= document.body;
    window.newUrl = null; // location.href should now be correct
    this.pageReady = true;
    this.scrolled = false;
    $(window).off('scroll', this.handleWindowScroll);
    $(window).on('scroll', this.handleWindowScroll);

    // Delayed to wait until cacheSnapshot finishes. The delay matches Turbolinks' defer.
    window.setTimeout(() => {
      this.destroy();
      this.loadScripts().then(() => {
        this.boot();
        this.timeoutScroll = window.setTimeout(this.scrollOnNewVisit, 100);
      });
    }, 1);
  };

  private readonly handleWindowScroll = () => {
    this.scrolled = this.scrolled || window.scrollX !== 0 || window.scrollY !== 0;
  };

  private loadScripts() {
    const promises: Promise<unknown>[] = [];

    if (window.newBody != null) {
      window.newBody.querySelectorAll('.js-react-turbolinks--script').forEach((script) => {
        if (script instanceof HTMLDivElement) {
          const src = script.dataset.src;
          if (src != null) {
            promises.push(this.turbolinksReload.load(src));
          }
        }
      });
    }

    return Promise.all(promises);
  }

  private readonly scrollOnNewVisit = () => {
    $(window).off('scroll', this.handleWindowScroll);
    const newVisit = this.newVisit;
    this.newVisit = false;

    if (!newVisit || this.scrolled) return;

    const targetId = decodeURIComponent(currentUrl().hash.substr(1));

    if (targetId === '') return;

    document.getElementById(targetId)?.scrollIntoView();
  };

  private setNewUrl() {
    window.newUrl = Turbo.session.navigator.currentVisit?.redirectedToLocation
      ?? Turbo.session.navigator.currentVisit?.location
      ?? document.location;
  }
}
