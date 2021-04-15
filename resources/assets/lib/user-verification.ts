// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Fade from 'fade';
import { route } from 'laroute';
import { createClickCallback } from 'utils/html';

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

const isUserVerificationXhr = (arg: JQuery.jqXHR): arg is UserVerificationXhr => (
  arg.status === 401 && arg.responseJSON?.authentication === 'verify'
);

export default class UserVerification {
  // Used as callback on original action (where verification was required)
  private callback?: () => void;
  // set to true on turbolinks:visit so the box will be rendered on navigation
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

  private get reference() {
    return document.querySelector<HTMLElement>('.js-user-verification--reference');
  }

  constructor() {
    $(document)
      .on('ajax:error', this.onError)
      .on('turbolinks:load', this.setModal)
      .on('turbolinks:load', this.showOnLoad)
      .on('turbolinks:visit', this.setDelayShow)
      .on('input', '.js-user-verification--input', this.autoSubmit)
      .on('click', '.js-user-verification--reissue', this.reissue);
    $.subscribe('user-verification:success', this.success);

    $(window).on('resize scroll', this.reposition);
  }

  showOnError = (xhr: JQuery.jqXHR, callback?: () => void) => {
    if (!isUserVerificationXhr(xhr)) return false;

    this.show(xhr.responseJSON.box, callback);

    return true;
  };

  private $modal() {
    return $('.js-user-verification');
  }

  private autoSubmit = () => {
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

  private error = (xhr: JQuery.jqXHR) => {
    this.setMessage(osu.xhrErrorMessage(xhr));
  };

  private float = (float: boolean, modal: HTMLElement, referenceBottom?: number) => {
    if (float) {
      modal.classList.add('js-user-verification--center');
      modal.style.paddingTop = '';
    } else {
      modal.classList.remove('js-user-verification--center');
      modal.style.paddingTop = `${referenceBottom ?? 0}px`;
    }
  };

  private isActive = () => this.modal?.classList.contains('js-user-verification--active');

  private isVerificationPage() {
    return document.querySelector('.js-user-verification--on-load') != null;
  }

  private onError = (e: { target: unknown }, xhr: JQuery.jqXHR) => (
    this.showOnError(xhr, createClickCallback(e.target))
  );

  private prepareForRequest = (type: string) => {
    this.request?.abort();
    this.setMessage(osu.trans(`user_verification.box.${type}`), true);
  };

  private reissue = (e: JQuery.Event) => {
    e.preventDefault();

    this.prepareForRequest('issuing');

    this.request = $
      .post(route('account.reissue-code'))
      .done((data: ReissueCodeJson) => {
        this.setMessage(data.message);
      })
      .fail(this.error);
  };

  private reposition = () => {
    if (!this.isActive() || this.modal == null) return;

    if (osu.isMobile()) {
      this.float(true, this.modal);
    } else {
      const referenceBottom = this.reference?.getBoundingClientRect().bottom ?? 0;

      this.float(referenceBottom < 0, this.modal, referenceBottom);
    }
  };

  private setDelayShow = () => {
    this.delayShow = true;
  };

  private setMessage = (text?: string, withSpinner = false) => {
    const message = this.message;
    if (message == null) return;

    if (text == null || text.length === 0) {
      Fade.out(message);
      return;
    }

    const messageText = this.messageText;
    const spinner = this.messageSpinner;

    if (messageText == null || spinner == null) return;

    messageText.textContent = text;
    Fade.toggle(spinner, withSpinner);
    Fade.in(message);
  };

  private setModal = () => {
    const modal = document.querySelector('.js-user-verification');

    this.modal = modal instanceof HTMLElement ? modal : undefined;
  };

  private show = (html?: string, callback?: () => void) => {
    if (this.delayShow) {
      this.delayShowCallback = () => this.show(html, callback);
      return;
    }

    this.callback = callback;

    if (html != null) {
      $('.js-user-verification--box').html(html);
    }

    this.$modal()
      .modal({
        backdrop: 'static',
        keyboard: false,
        show: true,
      })
      .addClass('js-user-verification--active');

    this.reposition();
  };

  // for pages which require authentication
  // and being visited directly from outside
  private showOnLoad = () => {
    this.delayShow = false;

    if (this.delayShowCallback != null) {
      this.delayShowCallback();
      this.delayShowCallback = undefined;
    } else if (this.isVerificationPage()) {
      this.show();
    }
  };

  private success = () => {
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
      return osu.reloadPage();
    }

    callback?.();
  };
}
