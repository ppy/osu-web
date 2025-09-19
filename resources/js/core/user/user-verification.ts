// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { TurboBeforeFetchResponseEvent, type TurboSubmitEndEvent } from '@hotwired/turbo';
import { route } from 'laroute';
import { xhrErrorMessage } from 'utils/ajax';
import { fadeIn, fadeOut, fadeToggle } from 'utils/fade';
import { createClickCallback, htmlElementOrNull } from 'utils/html';
import { trans } from 'utils/lang';
import { reloadPage } from 'utils/turbolinks';

interface ReissueCodeJson {
  message: string;
}

interface UserVerificationJson {
  authentication: 'verify';
  box: string;
}

interface UserVerificationXhr extends JQuery.jqXHR {
  responseJSON: UserVerificationJson;
  status: 401;
}

function isUserVerificationJson(arg: unknown): arg is UserVerificationJson {
  return typeof arg === 'object'
    && arg != null
    && 'authentication' in arg
    && arg.authentication === 'verify'
    && 'box' in arg
    && typeof arg.box === 'string';
}

export function isUserVerificationXhr(arg: JQuery.jqXHR<unknown>): arg is UserVerificationXhr {
  return arg.status === 401 && isUserVerificationJson(arg.responseJSON);
}

export default class UserVerification {
  // Used as callback on original action (where verification was required)
  private callback?: () => void;
  // set to true on turbo:visit so the box will be rendered on navigation
  private delayShow = false;
  // actual function to "store" the parameter original used for delayed show call
  private delayShowCallback?: () => void;

  private modal?: HTMLElement;
  private request?: JQuery.jqXHR;

  private get inputBox() {
    return document.querySelector<HTMLInputElement>('.js-user-verification--input');
  }

  private get message() {
    return document.querySelector<HTMLElement>('.js-user-verification--message');
  }

  private get messageSpinner() {
    return document.querySelector<HTMLElement>('.js-user-verification--message-spinner');
  }

  private get messageText() {
    return document.querySelector<HTMLElement>('.js-user-verification--message-text');
  }

  constructor() {
    $(document)
      .on('ajax:error', this.onError)
      .on('turbo:load', this.setModal)
      .on('turbo:load', this.showOnLoad)
      .on('turbo:visit', this.setDelayShow)
      .on('input', '.js-user-verification--input', this.autoSubmit)
      .on('click', '.js-user-verification--reissue', this.reissue);
    $.subscribe('user-verification:success', this.success);

    document.addEventListener('turbo:submit-end', this.onErrorTurbo);
    document.addEventListener('turbo:before-fetch-response', this.onMailFallbackMethod);
  }

  showOnError = (xhr: JQuery.jqXHR, callback?: () => void) => {
    if (!isUserVerificationXhr(xhr)) return false;

    this.show(xhr.responseJSON.box, callback);

    return true;
  };

  private $modal() {
    return $('.js-user-verification');
  }

  private readonly autoSubmit = () => {
    const target = this.inputBox;

    if (target == null) return;

    const inputKey = target.value.replace(/\s/g, '');
    const lastKey = target.dataset.lastKey;
    const keyLength = parseInt(target.dataset.verificationKeyLength ?? '', 10);

    if (inputKey.length === 0) this.setMessage();

    if (keyLength !== inputKey.length) return;
    if (inputKey === lastKey) return;

    target.dataset.lastKey = inputKey;

    this.prepareForRequest('verifying');

    this.request = $
      .post(route('account.verify'), { verification_key: inputKey })
      .done(this.success)
      .fail(this.error);
  };

  private readonly error = (xhr: JQuery.jqXHR) => {
    if (xhr.getResponseHeader('x-turbo-action') === 'session-verification-mail-fallback') {
      const json = xhr.responseJSON as UserVerificationJson;

      const box = this.setBoxContent(json.box);
      htmlElementOrNull(box?.querySelector('.modal-af'))?.focus();
    } else {
      this.setMessage(xhrErrorMessage(xhr));
    }
  };

  private readonly isActive = () => this.modal?.classList.contains('js-user-verification--active');

  private isVerificationPage() {
    return document.querySelector('.js-user-verification--on-load') != null;
  }

  private readonly onError = (e: { target: unknown }, xhr: JQuery.jqXHR) => (
    this.showOnError(xhr, createClickCallback(e.target))
  );

  private readonly onErrorTurbo = (e: TurboSubmitEndEvent) => {
    const fetchResponse = e.detail.fetchResponse;
    if (fetchResponse == null || fetchResponse.header('x-turbo-action') !== 'session-verification') {
      return;
    }

    e.preventDefault();
    const form = e.detail.formSubmission.formElement;
    fetchResponse.responseText.then((jsonString: string) => {
      const json = JSON.parse(jsonString) as UserVerificationJson;
      this.show(json.box, () => {
        form.requestSubmit();
      });
    });
  };

  private readonly onMailFallbackMethod = (e: TurboBeforeFetchResponseEvent) => {
    const fetchResponse = e.detail.fetchResponse;
    if (fetchResponse.header('x-turbo-action') !== 'session-verification-mail-fallback') {
      return;
    }

    e.preventDefault();
    fetchResponse.responseText.then((jsonString: string) => {
      const json = JSON.parse(jsonString) as UserVerificationJson;

      const box = this.setBoxContent(json.box);
      htmlElementOrNull(box?.querySelector('.modal-af'))?.focus();
    });
  };

  private readonly prepareForRequest = (type: string) => {
    this.request?.abort();
    this.setMessage(trans(`user_verification.box.${type}`), true);
  };

  private readonly reissue = (e: JQuery.Event) => {
    e.preventDefault();

    this.prepareForRequest('issuing');

    this.request = $
      .post(route('account.reissue-code'))
      .done((data: ReissueCodeJson) => {
        this.setMessage(data.message);
      })
      .fail(this.error);
  };

  private setBoxContent(html: string) {
    const box = htmlElementOrNull(document.querySelector('.js-user-verification--box'));
    if (box != null) {
      box.innerHTML = html;
    }

    return box;
  }

  private readonly setDelayShow = () => {
    this.delayShow = true;
  };

  private readonly setMessage = (text?: string, withSpinner = false) => {
    const message = this.message;
    if (message == null) return;

    if (text == null || text.length === 0) {
      fadeOut(message);
      return;
    }

    const messageText = this.messageText;
    const spinner = this.messageSpinner;

    if (messageText == null || spinner == null) return;

    messageText.textContent = text;
    fadeToggle(spinner, withSpinner);
    fadeIn(message);
  };

  private readonly setModal = () => {
    const modal = document.querySelector('.js-user-verification');

    this.modal = modal instanceof HTMLElement ? modal : undefined;
  };

  private readonly show = (html?: string, callback?: () => void) => {
    if (this.delayShow) {
      this.delayShowCallback = () => this.show(html, callback);
      return;
    }

    this.callback = callback;

    if (html != null) {
      this.setBoxContent(html);
    }

    this.$modal()
      .modal({
        backdrop: 'static',
        keyboard: false,
        show: true,
      })
      .addClass('js-user-verification--active');
  };

  // for pages which require authentication
  // and being visited directly from outside
  private readonly showOnLoad = () => {
    this.delayShow = false;

    if (this.delayShowCallback != null) {
      this.delayShowCallback();
      this.delayShowCallback = undefined;
    } else if (this.isVerificationPage()) {
      this.show();
    }
  };

  private readonly success = () => {
    if (!this.isActive() || this.modal == null) return;

    const inputBox = this.inputBox;

    if (inputBox == null) return;

    this.$modal().modal('hide');
    this.modal.classList.remove('js-user-verification--active');

    const callback = this.callback;
    this.callback = undefined;
    this.setMessage();
    inputBox.value = '';
    inputBox.dataset.lastKey = '';

    if (this.isVerificationPage()) {
      return reloadPage();
    }

    callback?.();
  };
}
