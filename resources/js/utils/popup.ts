// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { htmlElementOrNull } from './html';

type PopupType = 'danger' | 'info' | 'warning';
const persistentPopups: PopupType[] = ['danger', 'warning'];

export function popup(message: string, type: PopupType = 'info') {
  const $popup = $('#popup-container');
  const $alert = $('.popup-clone').clone();

  const closeAlert = () => $alert.trigger('click');

  // handle types of alerts by changing the colour
  $alert
    .addClass(`alert-${type} popup-active`)
    .removeClass('popup-clone');

  $alert.find('.popup-text').html(message);

  // warning/danger messages stay forever until clicked
  if (persistentPopups.includes(type)) {
    $('#overlay')
      .off('click.close-alert')
      .one('click.close-alert', closeAlert)
      .fadeIn();
  } else {
    setTimeout(closeAlert, 5000);
  }

  htmlElementOrNull(document.activeElement)?.blur();

  $alert.appendTo($popup).fadeIn();
}
