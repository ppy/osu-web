// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

const className = 'js-extra-script';

interface ScriptList {
  [key: string]: boolean;
}

export default class TurbolinksReload {
  private loaded: ScriptList = {};

  constructor() {
    document.addEventListener('turbolinks:before-cache', this.cleanup);
  }

  cleanup = () => {
    $(`.${className}`).remove();
  }

  forget = (src: string) => {
    delete this.loaded[src];
  }

  load = (src: string, onload?: () => void) => {
    if (this.loaded[src]) {
      return;
    }

    const el = document.createElement('script');
    el.classList.add(className);
    el.onload = () => {
      // abort if the element has been removed (on navigation etc)
      if (el.parentElement == null) {
        return;
      }

      el.parentElement.removeChild(el);

      if (onload != null) {
        onload();
      }
    };

    el.src = src;
    document.body.appendChild(el);
    return this.loaded[src] = true;
  }
}
