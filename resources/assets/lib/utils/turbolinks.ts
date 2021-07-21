// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
