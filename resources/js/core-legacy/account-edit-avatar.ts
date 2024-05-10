// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { fileuploadFailCallback } from 'utils/ajax';

export default class AccountEditAvatar {
  private dragging = false;
  private readonly main = document.getElementsByClassName('js-account-edit-avatar');
  private overlayLeaveTimeout?: number;

  private get element() {
    const elem = this.main[0];

    return elem instanceof HTMLElement ? elem : null;
  }

  constructor() {
    $(document).on('turbolinks:load', this.initialize);
    $(document).on('turbolinks:before-cache', this.rollback);

    $.subscribe('dragenterGlobal', this.overlayStart);
    $.subscribe('dragendGlobal', this.overlayEnd);
    $(document).on('dragenter', '.js-account-edit-avatar', this.overlayEnter);
    $(document).on('dragover', '.js-account-edit-avatar', this.overlayHover);
  }

  initialize = () => {
    const element = this.element;
    if (element == null) return;

    $('.js-account-edit-avatar__button').fileupload({
      always: () => {
        element.classList.remove('js-account-edit-avatar--saving');
      },
      dataType: 'json',
      done: (_e, data) => {
        $.publish('user:update', data.result);
      },
      dropZone: $(element),
      fail: fileuploadFailCallback,
      submit: () => {
        element.classList.add('js-account-edit-avatar--saving');
        $.publish('dragendGlobal');
      },
      url: route('account.avatar'),
    });
  };

  overlayEnd = () => {
    this.element?.classList.remove('js-account-edit-avatar--start');
  };

  overlayEnter = () => {
    this.dragging = true;
  };

  overlayHover = () => {
    if (!this.dragging) return;

    this.element?.classList.add('js-account-edit-avatar--hover');

    // see GlobalDrag
    window.clearTimeout(this.overlayLeaveTimeout);
    this.overlayLeaveTimeout = window.setTimeout(this.overlayLeave, 100);
  };


  overlayLeave = () => {
    this.dragging = false;
    this.element?.classList.remove('js-account-edit-avatar--hover');
  };

  overlayStart = () => {
    this.element?.classList.add('js-account-edit-avatar--start');
  };

  rollback = () => {
    if (this.element == null) return;
    $('.js-account-edit-avatar__button').fileupload('destroy');
  };
}
