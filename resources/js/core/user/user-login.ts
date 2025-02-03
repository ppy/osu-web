// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Captcha from 'core/captcha';
import UserJson from 'interfaces/user-json';
import core from 'osu-core-singleton';
import { xhrErrorMessage } from 'utils/ajax';
import { createClickCallback } from 'utils/html';
import { reloadPage } from 'utils/turbolinks';

declare global {
  interface Window {
    showLoginModal?: boolean;
  }
}

interface CaptchaTriggeredResponse {
  captcha_triggered: true;
  error: string;
}

interface LoginSuccessJson {
  csrf_token: string;
  header: string;
  header_popup: string;
  user: UserJson;
}

function isCaptchaTriggeredResponse(arg: unknown): arg is CaptchaTriggeredResponse {
  return typeof arg === 'object'
    && arg != null
    && 'captcha_triggered' in arg;
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
      .on('ajax:before', '.js-login-required--click', () => core.currentUser != null)
      .on('ajax:error', this.onError)
      .on('turbo:load', this.showOnLoad);
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
    if (core.currentUser != null) {
      return false;
    }

    this.show(callback);

    return true;
  };

  showOnError = (xhr: JQuery.jqXHR, callback?: () => void) => {
    if (xhr.status !== 401 || xhr.responseJSON?.authentication !== 'basic') {
      return false;
    }

    if (core.currentUser != null) {
      // broken page state
      reloadPage();
    } else {
      this.show(callback);
    }

    return true;
  };

  private readonly clearError = () => {
    $('.js-login-form--error').text('');
  };

  private readonly loginError = (e: JQuery.TriggeredEvent, xhr: JQuery.jqXHR<unknown>) => {
    e.preventDefault();
    e.stopPropagation();
    $('.js-login-form--error').text(xhrErrorMessage(xhr));
    const captchaContainer = this.captcha.findContainer(e.currentTarget);

    if (captchaContainer != null) {
      // Timeout here is to let ujs events fire first, so that the disabling of the submit button
      // in captcha.reset() happens _after_ the button has been re-enabled
      window.setTimeout(() => {
        const json = xhr.responseJSON as unknown;
        if (isCaptchaTriggeredResponse(json) && json.captcha_triggered) {
          this.captcha.trigger(captchaContainer);
        }
        this.captcha.reset(captchaContainer);
      }, 0);
    }
  };

  private readonly loginSuccess = (event: unknown, data: LoginSuccessJson, status: string, xhr: JQuery.jqXHR<unknown>) => {
    // check if it's a js callback response and should be run instead
    if (xhr.getResponseHeader('content-type') === 'application/javascript') {
      return;
    }
    const callback = this.callback;

    if (callback == null) {
      reloadPage();
      return;
    }

    this.reset();

    this.refreshToken(data.csrf_token);

    $.publish('user:update', data.user);

    // To allow other ajax:* events attached to header menu
    // to be triggered before the element is removed.
    window.setTimeout(() => {
      $('.js-user-login--menu')[0]?.click();
      $('.js-user-header').replaceWith(data.header);
      $('.js-user-header-popup').html(data.header_popup);
      callback();
    }, 0);
  };

  private readonly onError = (e: { target: unknown }, xhr: JQuery.jqXHR) => {
    this.showOnError(xhr, createClickCallback(e.target));
  };

  private readonly refreshToken = (token: string) => {
    $('[name="_token"]').attr('value', token);
    $('[name="csrf-token"]').attr('content', token);
  };

  private readonly reset = () => {
    this.callback = undefined;
  };

  private readonly showOnClick = (e: JQuery.Event) => {
    e.preventDefault();
    this.show();
  };

  // for pages which require authentication
  // and being visited directly from outside
  private readonly showOnLoad = () => {
    if (!window.showLoginModal) {
      return;
    }

    window.showLoginModal = undefined;
    this.show();
  };

  private readonly showToContinue = (e: JQuery.ClickEvent) => {
    if (core.currentUser != null) {
      return;
    }

    e.preventDefault();
    const callback = createClickCallback(e.target);
    window.setTimeout(() => {
      this.show(callback);
    }, 0);
  };
}
