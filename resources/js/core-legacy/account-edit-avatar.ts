// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import CurrentUserJson from 'interfaces/current-user-json';
import { route } from 'laroute';
import core from 'osu-core-singleton';
import { fileuploadFailCallback } from 'utils/ajax';

const hoverClass = 'js-account-edit-avatar--hover';
const savingClass = 'js-account-edit-avatar--saving';
const startClass = 'js-account-edit-avatar--start';

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
        element.classList.remove(savingClass);
      },
      dataType: 'json',
      done: (_e, data) => {
        const json = data.result as CurrentUserJson;
        core.setCurrentUser(json);
      },
      dropZone: $(element),
      fail: fileuploadFailCallback,
      submit: () => {
        element.classList.add(savingClass);
        $.publish('dragendGlobal');
      },
      url: route('account.avatar'),
    });
  };

  overlayEnd = () => {
    this.element?.classList.remove(startClass);
  };

  overlayEnter = () => {
    this.dragging = true;
  };

  overlayHover = () => {
    if (!this.dragging) return;

    this.element?.classList.add(hoverClass);

    // see GlobalDrag
    window.clearTimeout(this.overlayLeaveTimeout);
    this.overlayLeaveTimeout = window.setTimeout(this.overlayLeave, 100);
  };

  overlayLeave = () => {
    this.dragging = false;
    this.element?.classList.remove(hoverClass);
  };

  overlayStart = () => {
    this.element?.classList.add(startClass);
  };

  rollback = () => {
    if (this.element == null) return;
    $('.js-account-edit-avatar__button').fileupload('destroy');
  };
}
