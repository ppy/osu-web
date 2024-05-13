// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import OsuCore from 'osu-core';
import AccountEditAutoSubmit from './account-edit-auto-submit';

interface AccountEditHTMLElement extends HTMLElement {
  autoSubmit?: AccountEditAutoSubmit;
}

export default class AccountEditBootstrap {
  constructor(private readonly core: OsuCore) {
    $(document).on('input change', '.js-account-edit', this.handleInputChange);
  }

  private readonly handleInputChange = (e: JQuery.TriggeredEvent<unknown, unknown, AccountEditHTMLElement, unknown>) => {
    const container = e.currentTarget;

    if (container.dataset.accountEditAutoSubmit !== '1') {
      return;
    }

    container.autoSubmit ??= new AccountEditAutoSubmit(container, this.core);
    container.autoSubmit.onInput();
  };
}
