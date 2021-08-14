// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { fadeToggle } from 'utils/fade';

const Blackout = {
  hide: () => Blackout.toggle(false),

  show: () => Blackout.toggle(true),

  toggle: (state: boolean, opacity?: number) => {
    const el = document.querySelector('.js-blackout');

    if (el instanceof HTMLElement) {
      el.style.opacity = !state || opacity == null ? '' : String(opacity);
      fadeToggle(el, state);
    }
  },
};

export default Blackout;
