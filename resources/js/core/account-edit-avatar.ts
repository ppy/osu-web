// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import CurrentUserJson from 'interfaces/current-user-json';
import { route } from 'laroute';
import OsuCore from 'osu-core';
import { fileuploadFailCallback } from 'utils/ajax';

const hoverClass = 'js-account-edit-avatar--hover';
const savingClass = 'js-account-edit-avatar--saving';
const startClass = 'js-account-edit-avatar--start';

export default class AccountEditAvatar {
  private dragging = false;
  private element: HTMLElement | null = null;
  private overlayLeaveTimeout?: number;

  constructor(private readonly core: OsuCore) {
    $(document).on('turbo:load', this.initialize);
    $(document).on('turbo:before-cache', this.rollback);

    $.subscribe('dragenterGlobal', this.overlayStart);
    $.subscribe('dragendGlobal', this.overlayEnd);
    $(document).on('dragenter', '.js-account-edit-avatar', this.overlayEnter);
    $(document).on('dragover', '.js-account-edit-avatar', this.overlayHover);
  }

  private readonly initialize = () => {
    this.element = document.querySelector('.js-account-edit-avatar');
    const element = this.element;
    if (element == null) return;

    $('.js-account-edit-avatar__button').fileupload({
      always: () => {
        element.classList.remove(savingClass);
      },
      dataType: 'json',
      done: (_e: unknown, data: { result: CurrentUserJson }) => {
        this.core.setCurrentUser(data.result);
      },
      dropZone: $(element),
      fail: fileuploadFailCallback,
      submit: () => {
        element.classList.add(savingClass);
        $.publish('dragendGlobal');
      },
      url: route('account.avatar'),
    });

    $('.js-account-edit-avatar--reset')
      .on('ajax:send', () => {
        element.classList.add(savingClass);
      }).on('ajax:complete', () => {
        element.classList.remove(savingClass);
      }).on('ajax:success', (_e: unknown, data: CurrentUserJson) => {
        this.core.setCurrentUser(data);
      });
  };

  private readonly overlayEnd = () => {
    this.element?.classList.remove(startClass);
  };

  private readonly overlayEnter = () => {
    this.dragging = true;
  };

  private readonly overlayHover = () => {
    if (!this.dragging) return;

    this.element?.classList.add(hoverClass);

    // see GlobalDrag
    window.clearTimeout(this.overlayLeaveTimeout);
    this.overlayLeaveTimeout = window.setTimeout(this.overlayLeave, 100);
  };

  private readonly overlayLeave = () => {
    this.dragging = false;
    this.element?.classList.remove(hoverClass);
  };

  private readonly overlayStart = () => {
    this.element?.classList.add(startClass);
  };

  private readonly rollback = () => {
    if (this.element == null) return;
    $('.js-account-edit-avatar__button').fileupload('destroy');
  };
}
