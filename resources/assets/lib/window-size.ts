// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

function handleResize() {
  const vh = window.innerHeight * 0.01;
  document.documentElement.style.setProperty('--vh', `${vh}px`);
}

/**
 * This works around vh units being inconsistent across browsers (read: on mobile).
 * You can use this in less/css with calc/var, e.g.:
 * height: calc(var(--vh, 1vh) ~'*' 100);
 */
export default class WindowVHPatcher {
  constructor() {
    $(window).on('resize.windowVHPatch', handleResize);
    handleResize();
  }
}
