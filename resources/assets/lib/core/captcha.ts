// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default class Captcha {
  sitekey = '';
  triggered = false;

  constructor() {
    $(document).on('turbolinks:load', this.render);
  }

  container = () => document.querySelector<HTMLDivElement>('.js-captcha--container');

  disableSubmit = () => {
    const targetButton = this.submitButton();
    if (targetButton) {
      targetButton.disabled = true;
    }
  };

  enableSubmit = () => {
    const targetButton = this.submitButton();
    if (targetButton) {
      targetButton.disabled = false;
    }
  };

  init = (sitekey: string, triggered: boolean) => {
    this.sitekey = sitekey;
    this.triggered = triggered;
    this.render();
  };

  isEnabled = () => this.container() &&
      typeof(grecaptcha) === 'object' &&
      typeof(grecaptcha.render) === 'function' &&
      this.sitekey !== '' &&
      this.triggered;

  isLoaded = () => this.container()?.innerHTML !== '';

  render = () => {
    if (this.isEnabled() && !this.isLoaded()) {
      grecaptcha.render(this.container()!, {
        callback: this.enableSubmit,
        'error-callback': this.disableSubmit,
        'expired-callback': this.disableSubmit,
        sitekey: this.sitekey,
        theme: 'dark',
      });

      this.disableSubmit();
    }
  };

  reset = () => {
    if (this.isEnabled()) {
      grecaptcha.reset();
      this.disableSubmit();
    }
  };

  submitButton = () => document.querySelector<HTMLButtonElement>('.js-captcha--submit-button');

  trigger = () => {
    if (this.triggered) {
      return;
    }

    this.triggered = true;
    this.render();
  };

  untrigger = () => {
    if (!this.isEnabled()) {
      return;
    }

    this.triggered = false;
    this.container()!.innerHTML = '';
    this.enableSubmit();
  };
}
