// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import * as ReactDOM from 'react-dom';
import TurbolinksReload from 'turbolinks-reload';
import { currentUrl } from 'utils/turbolinks';

type ElementFn = (container: HTMLElement) => React.ReactElement;

export default class ReactTurbolinks {
  private components = new Map<string, ElementFn>();
  private newVisit = true;
  private pageReady = false;
  private renderedContainers = new Set<HTMLElement>();
  private scrolled = false;
  private timeoutScroll?: number;

  constructor(private turbolinksReload: TurbolinksReload) {
    $(document).on('turbolinks:before-cache', this.handleBeforeCache);
    $(document).on('turbolinks:before-visit', this.handleBeforeVisit);
    $(document).on('turbolinks:load', this.handleLoad);
    $(document).on('turbolinks:before-render', this.handleBeforeRender);
  }

  boot = () => {
    if (!this.pageReady || window.newBody == null) return;

    for (const [name, elementFn] of this.components.entries()) {
      const containers = window.newBody.querySelectorAll(`.js-react--${name}`);

      for (const container of containers) {
        if (!(container instanceof HTMLElement) || this.renderedContainers.has(container)) {
          continue;
        }

        this.renderedContainers.add(container);
        ReactDOM.render(elementFn(container), container);
      }
    }
  };

  register(name: string, elementFn: ElementFn) {
    if (this.components.has(name)) return;

    this.components.set(name, elementFn);

    this.boot();
  }

  runAfterPageLoad(eventId: string, callback: () => void) {
    if (document.body === window.newBody) {
      callback();
    } else {
      $(document).one(`turbolinks:load.${eventId}`, callback);
    }
  }

  private destroy = () => {
    for (const target of this.renderedContainers.values()) {
      if (document.body.contains(target)) continue;

      ReactDOM.unmountComponentAtNode(target);
      this.renderedContainers.delete(target);
    }
  };

  private handleBeforeCache = () => {
    this.pageReady = false;
    window.clearTimeout(this.timeoutScroll);
  };

  private handleBeforeRender = (e: JQuery.TriggeredEvent) => {
    window.newBody = (e.originalEvent as Event & { data: { newBody: HTMLElement }}).data.newBody;
    this.setNewUrl();
    this.pageReady = true;
    this.loadScripts(false);
    this.boot();
  };

  private handleBeforeVisit = () => {
    this.newVisit = true;
  };

  private handleLoad = () => {
    window.newBody ??= document.body;
    window.newUrl = null; // location.href should now be correct
    this.pageReady = true;
    this.scrolled = false;
    $(window).off('scroll', this.handleWindowScroll);
    $(window).on('scroll', this.handleWindowScroll);

    // Delayed to wait until cacheSnapshot finishes. The delay matches Turbolinks' defer.
    window.setTimeout(() => {
      this.destroy();
      this.loadScripts();
      this.boot();
      this.timeoutScroll = window.setTimeout(this.scrollOnNewVisit, 100);
    }, 1);
  };

  private handleWindowScroll = () => {
    this.scrolled = this.scrolled || window.scrollX !== 0 || window.scrollY !== 0;
  };

  private loadScripts(isAsync = true) {
    if (window.newBody == null) return;

    const loadFunc = isAsync ? 'load' : 'loadSync';

    window.newBody.querySelectorAll('.js-react-turbolinks--script').forEach((script) => {
      if (script instanceof HTMLDivElement) {
        const src = script.dataset.src;
        if (src != null) {
          void this.turbolinksReload[loadFunc](src);
        }
      }
    });
  }

  private scrollOnNewVisit = () => {
    $(window).off('scroll', this.handleWindowScroll);
    const newVisit = this.newVisit;
    this.newVisit = false;

    if (!newVisit || this.scrolled) return;

    const targetId = decodeURIComponent(currentUrl().hash.substr(1));

    if (targetId === '') return;

    document.getElementById(targetId)?.scrollIntoView();
  };

  private setNewUrl() {
    const visitUrl = Turbolinks.controller.currentVisit?.redirectedToLocation?.absoluteURL
      ?? Turbolinks.controller.currentVisit?.location.absoluteURL;

    window.newUrl = visitUrl == null ? document.location : new URL(visitUrl);
  }
}
