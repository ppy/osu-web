// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { debounce } from 'lodash';

function getOverlayElement() {
  const el = document.querySelector('.js-loading-overlay');

  if (el instanceof HTMLElement) {
    return el;
  }
}

export function showImmediateLoadingOverlay() {
  const el = getOverlayElement();

  if (el == null) return;

  el.classList.add('loading-overlay--visible');
}

export const showLoadingOverlay = debounce(showImmediateLoadingOverlay, 5000, { maxWait: 5000 });

export function hideLoadingOverlay() {
  showLoadingOverlay.cancel();

  const el = getOverlayElement();

  if (el == null) return;

  el.classList.remove('loading-overlay--visible');
}
