// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { htmlElementOrNull } from './html';

type PopupType = 'danger' | 'info' | 'warning';
const persistentPopupClasses: `alert-${PopupType}`[] = ['alert-danger', 'alert-warning'];

export function applyPopupEffects(popupEl: HTMLElement) {
  const $overlay = $('#overlay');
  $overlay.fadeIn();
  // warning/danger messages stay forever until clicked
  const persistent = persistentPopupClasses.some((className) => popupEl.classList.contains(className));
  if (!persistent) {
    setTimeout(() => {
      $overlay.click();
    }, 5000);
  }

  htmlElementOrNull(document.activeElement)?.blur();
}

export function popup(message: string, type: PopupType = 'info') {
  const $popup = $('#popup-container');
  const $alert = $('.popup-clone').clone();

  // handle types of alerts by changing the colour
  $alert
    .addClass(`alert-${type} popup-active`)
    .removeClass('popup-clone');
  $alert.find('.popup-text').html(message);
  $alert.appendTo($popup).fadeIn();

  applyPopupEffects($alert[0]);
}
