// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { htmlElementOrNull } from 'utils/html';

function isVisible(el: HTMLElement) {
  const rect = el.getBoundingClientRect();
  if (rect.x === 0 && rect.y === 0 && rect.width === 0 && rect.height === 0) {
    return false;
  }

  const style = window.getComputedStyle(el);

  return style.pointerEvents !== 'none';
}

export default class Captcha {
  private sitekey = '';

  constructor() {
    $(document).on('turbo:load', this.renderAll);
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
      typeof(turnstile) === 'object' &&
      typeof(turnstile.render) === 'function' &&
      this.sitekey !== '';

  isLoaded = (container: HTMLDivElement) => container.innerHTML !== '';

  isTriggered = (container: HTMLDivElement) => container.dataset.captchaTriggered === '1';

  render = (container: HTMLDivElement) => {
    if (!isVisible(container)) {
      return;
    }
    if (this.isEnabled(container) && !this.isLoaded(container)) {
      const disableSubmit = () => this.disableSubmit(container);
      const id = turnstile.render(container, {
        callback: () => this.enableSubmit(container),
        'error-callback': disableSubmit,
        'expired-callback': disableSubmit,
        language: window.currentLocale,
        sitekey: this.sitekey,
        theme: 'dark',
      });
      if (id == null) {
        throw new Error('failed setting up turnstile widget');
      }
      container.dataset.captchaId = id;
      $(document).one('turbo:before-cache', () => this.remove(container));

      disableSubmit();
    }
  };

  reset = (container: HTMLDivElement) => {
    if (this.isEnabled(container)) {
      turnstile.reset(container.dataset.captchaId ?? '');
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

  private readonly remove = (container: HTMLDivElement) => {
    const id = container.dataset.captchaId;
    delete(container.dataset.captchaId);
    turnstile.remove(id ?? '');
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
