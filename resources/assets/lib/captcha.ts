// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default class Captcha {
  sitekey = '';

  constructor() {
    $(document).on('turbolinks:load', this.render);
  }

  disableSubmit = () => {
    const targetButton = this.submitButton();
    if (targetButton) {
      targetButton.disabled = true;
    }
  }

  enableSubmit = () => {
    const targetButton = this.submitButton();
    if (targetButton) {
      targetButton.disabled = false;
    }
  }

  init = (sitekey: string) => {
    this.sitekey = sitekey;
    this.render();
  }

  isEnabled = () => {
    return this.renderContainer() &&
      typeof(grecaptcha) === 'object' &&
      typeof(grecaptcha.render) === 'function' &&
      this.sitekey !== '';
  }

  render = () => {
    if (this.isEnabled()) {
      grecaptcha.render(this.renderContainer(), {
        'callback': this.enableSubmit,
        'error-callback': this.disableSubmit,
        'expired-callback': this.disableSubmit,
        'sitekey': this.sitekey,
        'theme': 'dark',
      });

      this.disableSubmit();
    }
  }

  renderContainer = () => document.getElementsByClassName('js-recaptcha-container')[0] as HTMLDivElement;

  reset = () => {
    if (this.isEnabled()) {
      grecaptcha.reset();
    }
  }

  submitButton = () => document.getElementsByClassName('js-login-form-submit')[0] as HTMLButtonElement;
}
