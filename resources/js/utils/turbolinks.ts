// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { VisitOptions } from '@hotwired/turbo';

export function currentUrl() {
  return window.newUrl ?? document.location;
}

export function currentUrlParams() {
  const url = currentUrl();

  if (url instanceof URL) {
    return url.searchParams;
  } else {
    return new URLSearchParams(url.search);
  }
}

export function currentUrlRelative() {
  const url = currentUrl();

  return `${url.pathname}${url.search}`;
}

function keepScrollOnLoad() {
  const { pageXOffset, pageYOffset } = window;
  $(document).one('turbo:load', () => window.scrollTo(pageXOffset, pageYOffset));
}

export function navigate(url: string, keepScroll = false, options?: VisitOptions) {
  if (keepScroll) {
    keepScrollOnLoad();
  }

  Turbo.visit(url, options);
}

export function reloadPage(keepScroll = true) {
  $(document).off('.ujsHideLoadingOverlay');
  Turbo.cache.clear();

  navigate(currentUrl().href, keepScroll, { action: 'replace' });
}

export function updateHistory(url: string, action: 'advance' | 'replace') {
  const currentLocation = currentUrl();

  if (url === currentLocation.href) {
    return;
  }
  if (action === 'advance') {
    Turbo.session.view.snapshotCache.put(
      currentLocation,
      Turbo.session.view.snapshot.clone(),
    );
  }

  const newLocation = new URL(url, document.baseURI);
  const methodName = action === 'advance' ? 'push' : 'replace';

  const callback = () => {
    Turbo.session.history[methodName](newLocation, crypto.randomUUID());
    Turbo.session.view.lastRenderedLocation = newLocation;
  };
  if (action === 'replace' && window.newUrl == null) {
    window.setTimeout(callback);
  } else {
    callback();
  }
}
