/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

// This works around vh units being inconsistent across browsers (read: on mobile).
// You can use this in less/css with calc/var, e.g.:
// height: calc(var(--vh, 1vh) ~'*' 100);
export default class WindowVHPatcher {
  private window: Window;

  constructor(window: Window) {
    this.window = window;
    $(this.window).on('throttled-resize.windowVHPatch', this.handleResize);
  }

  handleResize = () => {
    const vh = this.window.innerHeight * 0.01;
    if (this.window.document.documentElement !== null) {
      this.window.document.documentElement.style.setProperty('--vh', `${vh}px`);
    }
  }
}
