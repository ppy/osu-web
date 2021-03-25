// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Fade from 'fade';
import { route } from 'laroute';

interface ReissueCodeJson {
  message: string;
}

export default class UserVerification {
  // Used as callback on original action (where verification was required)
  private clickAfterVerification?: HTMLElement;
  // set to true on turbolinks:visit so the box will be rendered on navigation
  private delayShow = false;
  // actual function to "store" the parameter original used for delayed show call
  private delayShowCallback?: () => void;

  private readonly inputBox = document.getElementsByClassName('js-user-verification--input');
  private readonly message = document.getElementsByClassName('js-user-verification--message');
  private readonly messageSpinner = document.getElementsByClassName('js-user-verification--message-spinner');
  private readonly messageText = document.getElementsByClassName('js-user-verification--message-text');
  private modal?: HTMLElement;
  private readonly reference = document.getElementsByClassName('js-user-verification--reference');
  private request?: JQuery.jqXHR;

  constructor() {
    $(document)
      .on('ajax:error', this.showOnError)
      .on('turbolinks:load', this.setModal)
      .on('turbolinks:load', this.showOnLoad)
      .on('turbolinks:visit', this.setDelayShow)
      .on('input', '.js-user-verification--input', this.autoSubmit)
      .on('click', '.js-user-verification--reissue', this.reissue);
    $.subscribe('user-verification:success', this.success);

    $(window).on('resize scroll', this.reposition);
  }

  showOnError = (e: { target: unknown }, xhr: JQuery.jqXHR) => {
    if (xhr.status !== 401 || xhr.responseJSON?.authentication !== 'verify') return false;

    const target = e.target instanceof HTMLElement ? e.target : undefined;
    this.show(target, xhr.responseJSON.box);

    return true;
  }

  private $modal() {
    return $('.js-user-verification');
  }

  private autoSubmit = () => {
    const target = this.inputBox[0];

    if (!(target instanceof HTMLInputElement)) return;

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
  }

  private error = (xhr: JQuery.jqXHR) => {
    this.setMessage(osu.xhrErrorMessage(xhr));
  }

  private float = (float: boolean, modal: HTMLElement, referenceBottom?: number) => {
    if (float) {
      modal.classList.add('js-user-verification--center');
      modal.style.paddingTop = '';
    } else {
      modal.classList.remove('js-user-verification--center');
      modal.style.paddingTop = `${referenceBottom ?? 0}px`;
    }
  }

  private isActive = () => {
    return this.modal?.classList.contains('js-user-verification--active');
  }

  private isVerificationPage() {
    return document.querySelector('.js-user-verification--on-load') != null;
  }

  private prepareForRequest = (type: string) => {
    this.request?.abort();
    this.setMessage(osu.trans(`user_verification.box.${type}`), true);
  }

  private reissue = (e: JQuery.Event) => {
    e.preventDefault();

    this.prepareForRequest('issuing');

    this.request = $
      .post(route('account.reissue-code'))
      .done((data: ReissueCodeJson) => {
        this.setMessage(data.message);
      })
      .fail(this.error);
  }

  private reposition = () => {
    if (!this.isActive() || this.modal == null) return;

    if (osu.isMobile()) {
      this.float(true, this.modal);
    } else {
      const referenceBottom = this.reference[0]?.getBoundingClientRect().bottom;

      this.float(referenceBottom < 0, this.modal, referenceBottom);
    }
  }

  private setDelayShow = () => {
    this.delayShow = true;
  }

  private setMessage = (text?: string, withSpinner: boolean = false) => {
    const message = this.message[0];
    if (!(message instanceof HTMLElement)) return;

    if (text == null || text.length === 0) {
      Fade.out(message);
      return;
    }

    const messageText = this.messageText[0];
    const spinner = this.messageSpinner[0];

    if (!(messageText instanceof HTMLElement) || !(spinner instanceof HTMLElement)) return;

    messageText.textContent = text;
    Fade.toggle(spinner, withSpinner);
    Fade.in(message);
  }

  private setModal = () => {
    const modal = document.querySelector('.js-user-verification');

    this.modal = modal instanceof HTMLElement ? modal : undefined;
  }

  private show = (target?: HTMLElement, html?: string) => {
    if (this.delayShow) {
      this.delayShowCallback = () => this.show(target, html);
      return;
    }

    this.clickAfterVerification = target;

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
  }

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
  }

  private success = () => {
    if (!this.isActive() || this.modal == null) return;

    const inputBox = this.inputBox[0];

    if (!(inputBox instanceof HTMLInputElement)) return;

    this.$modal().modal('hide');
    this.modal.classList.remove('js-user-verification--active');

    const toClick = this.clickAfterVerification;
    this.clickAfterVerification = undefined;
    this.setMessage();
    inputBox.value = '';
    inputBox.dataset.lastKey = '';

    if (this.isVerificationPage()) {
      return osu.reloadPage();
    }

    if (toClick != null) {
      osu.executeAction(toClick);
    }
  }
}
