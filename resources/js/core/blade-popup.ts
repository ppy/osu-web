// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { applyPopupEffects } from 'utils/popup';

function applyEffects() {
  for (const popup of document.querySelectorAll('.popup-active')) {
    if (popup instanceof HTMLElement) {
      applyPopupEffects(popup);
    }
  }
}

export default class BladePopup {
  constructor() {
    document.addEventListener('turbo:load', applyEffects);
  }
}
