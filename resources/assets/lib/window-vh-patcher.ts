// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

/**
 * This works around vh units being inconsistent across browsers (read: on mobile).
 * You can use this in less/css with calc/var, e.g.:
 * height: calc(var(--vh, 1vh) ~'*' 100);
 */
export default class WindowVHPatcher {
  private static instance: WindowVHPatcher;
  private window: Window;

  private constructor(window: Window) {
    this.window = window;
    $(this.window).on('resize.windowVHPatch', this.handleResize);
    this.handleResize();
  }

  static init(window: Window) {
    if (this.instance != null) {
      return this.instance;
    }

    this.instance = new WindowVHPatcher(window);

    return this.instance;
  }

  private handleResize() {
    const vh = this.window.innerHeight * 0.01;
    if (this.window.document.documentElement !== null) {
      this.window.document.documentElement.style.setProperty('--vh', `${vh}px`);
    }
  }
}
