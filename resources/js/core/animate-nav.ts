// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default class AnimateNav {
  constructor() {
    $(document)
      .on('turbo:before-cache', () => {
        document.body.classList.remove('js-animate-nav');
      }).on('turbo:load', () => {
        window.setTimeout(() => {
          document.body.classList.add('js-animate-nav');
        }, 0);
      });
  }
}
