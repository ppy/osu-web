// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { htmlElementOrNull } from 'utils/html';

export default class Captcha {
  private sitekey = '';

  constructor() {
    $(document).on('turbolinks:load', this.renderAll);
    $(document).on('ajax:error', '.js-captcha--reset-on-error', this.resetOnError);
  }

  containers = () => document.querySelectorAll<HTMLDivElement>('.js-captcha--container');

  disableSubmit = (container: HTMLDivElement) => {
    const targetButton = this.submitButton(container);
    if (targetButton != null) {
      targetButton.disabled = true;
    }
  };

  enableSubmit = (container: HTMLDivElement) => {
    const targetButton = this.submitButton(container);
    if (targetButton != null) {
      targetButton.disabled = false;
    }
  };

  findContainer = (formInput: unknown) => htmlElementOrNull(
    htmlElementOrNull(formInput)?.closest('form'),
  )?.querySelector<HTMLDivElement>('.js-captcha--container');

  init = (sitekey: string) => {
    this.sitekey = sitekey;
    this.renderAll();
  };

  isEnabled = (container: HTMLDivElement) => this.isTriggered(container) &&
      typeof(grecaptcha) === 'object' &&
      typeof(grecaptcha.render) === 'function' &&
      this.sitekey !== '';

  isLoaded = (container: HTMLDivElement) => container.innerHTML !== '';

  isTriggered = (container: HTMLDivElement) => container.dataset.captchaTriggered === '1';

  render = (container: HTMLDivElement) => {
    if (this.isEnabled(container) && !this.isLoaded(container)) {
      const disableSubmit = () => this.disableSubmit(container);
      const id = grecaptcha.render(container, {
        callback: () => this.enableSubmit(container),
        'error-callback': disableSubmit,
        'expired-callback': disableSubmit,
        sitekey: this.sitekey,
        theme: 'dark',
      });
      container.dataset.captchaId = id.toString();

      disableSubmit();
    }
  };

  reset = (container: HTMLDivElement) => {
    if (this.isEnabled(container)) {
      grecaptcha.reset(+(container.dataset.captchaId ?? ''));
      this.disableSubmit(container);
    }
  };

  submitButton = (container: HTMLDivElement) => container.closest('form')?.querySelector<HTMLButtonElement>('.js-captcha--submit-button');

  trigger = (container: HTMLDivElement) => {
    if (this.isTriggered(container)) {
      return;
    }

    container.dataset.captchaTriggered = '1';
    this.render(container);
  };

  private readonly renderAll = () => {
    for (const container of this.containers()) {
      this.render(container);
    }
  };

  private readonly resetOnError = (e: JQuery.TriggeredEvent) => {
    const container = this.findContainer(htmlElementOrNull(e.target));

    if (container != null) {
      this.reset(container);
    }
  };
}
