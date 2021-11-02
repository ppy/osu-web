// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Captcha from 'core/captcha';
import UserJson from 'interfaces/user-json';
import * as Cookies from 'js-cookie';
import { createClickCallback } from 'utils/html';

declare global {
  interface Window {
    showLoginModal?: boolean;
  }
}

interface LoginSuccessJson {
  header: string;
  header_popup: string;
  user: UserJson;
}

export default class UserLogin {
  // Used as callback on original action (where login was required)
  private callback?: () => void;

  constructor(private readonly captcha: Captcha) {
    $(document)
      .on('ajax:success', '.js-login-form', this.loginSuccess)
      .on('ajax:error', '.js-login-form', this.loginError)
      .on('submit', '.js-login-form', this.clearError)
      .on('input', '.js-login-form-input', this.clearError)
      .on('click', '.js-user-link', this.showOnClick)
      .on('click', '.js-login-required--click', this.showToContinue)
      .on('ajax:before', '.js-login-required--click', () => currentUser.id != null)
      .on('ajax:error', this.onError)
      .on('turbolinks:load', this.showOnLoad);
    $.subscribe('nav:popup:hidden', this.reset);
  }

  show = (callback?: () => void) => {
    this.callback = callback;

    window.setTimeout(() => {
      $(document).trigger('gallery:close');
      $('.js-user-login--menu')[0]?.click();
    }, 0);
  };

  showIfGuest = (callback?: () => void) => {
    if (currentUser.id != null) {
      return false;
    }

    this.show(callback);

    return true;
  };

  showOnError = (xhr: JQuery.jqXHR, callback?: () => void) => {
    if (xhr.status !== 401 || xhr.responseJSON?.authentication !== 'basic') {
      return false;
    }

    if (currentUser.id != null) {
      // broken page state
      osu.reloadPage();
    } else {
      this.show(callback);
    }

    return true;
  };

  private clearError = () => {
    $('.js-login-form--error').text('');
  };

  private loginError = (e: JQuery.Event, xhr: JQuery.jqXHR) => {
    e.preventDefault();
    e.stopPropagation();
    $('.js-login-form--error').text(osu.xhrErrorMessage(xhr));

    // Timeout here is to let ujs events fire first, so that the disabling of the submit button
    // in captcha.reset() happens _after_ the button has been re-enabled
    window.setTimeout(() => {
      if (xhr?.responseJSON?.captcha_triggered) {
        this.captcha.trigger();
      }
      this.captcha.reset();
    }, 0);
  };

  private loginSuccess = (event: unknown, data: LoginSuccessJson) => {
    const callback = this.callback;
    this.reset();

    this.refreshToken();

    $.publish('user:update', data.user);

    // To allow other ajax:* events attached to header menu
    // to be triggered before the element is removed.
    window.setTimeout(() => {
      $('.js-user-login--menu')[0]?.click();
      $('.js-user-header').replaceWith(data.header);
      $('.js-user-header-popup').html(data.header_popup);
      this.captcha.untrigger();

      (callback ?? osu.reloadPage)();
    }, 0);
  };

  private onError = (e: { target: unknown }, xhr: JQuery.jqXHR) => {
    this.showOnError(xhr, createClickCallback(e.target));
  };

  private refreshToken = () => {
    const token = Cookies.get('XSRF-TOKEN') ?? null;
    $('[name="_token"]').attr('value', token);
    $('[name="csrf-token"]').attr('content', token);
  };

  private reset = () => {
    this.callback = undefined;
  };

  private showOnClick = (e: JQuery.Event) => {
    e.preventDefault();
    this.show();
  };

  // for pages which require authentication
  // and being visited directly from outside
  private showOnLoad = () => {
    if (!window.showLoginModal) {
      return;
    }

    window.showLoginModal = undefined;
    this.show();
  };

  private showToContinue = (e: JQuery.ClickEvent) => {
    if (currentUser.id != null) {
      return;
    }

    e.preventDefault();
    const callback = createClickCallback(e.target);
    window.setTimeout(() => {
      this.show(callback);
    }, 0);
  };
}
