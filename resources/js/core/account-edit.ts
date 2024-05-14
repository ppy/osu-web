// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import OsuCore from 'osu-core';
import AccountEditAutoSubmit from './account-edit-auto-submit';

type ContainerEvent = JQuery.TriggeredEvent<unknown, unknown, AccountEditHTMLElement, unknown>;

const containerClassSelector = '.js-account-edit';

interface AccountEditHTMLElement extends HTMLElement {
  autoSubmit?: AccountEditAutoSubmit;
}

export default class AccountEditBootstrap {
  constructor(private readonly core: OsuCore) {
    $(document).on('input change', containerClassSelector, this.handleInputChange);
    $(document).on('ajax:error', containerClassSelector, this.handleAjaxError);
    $(document).on('ajax:send', containerClassSelector, this.handleAjaxSend);
    $(document).on('ajax:success', containerClassSelector, this.handleAjaxSuccess);
  }

  private readonly handleAjaxError = (e: ContainerEvent) => {
    if (e.currentTarget.dataset.accountEditAutoSubmit === '1') return;

    e.currentTarget.autoSubmit?.errored();
  };

  private readonly handleAjaxSend = (e: ContainerEvent) => {
    const container = e.currentTarget;
    if (container.dataset.accountEditAutoSubmit === '1') return;

    container.autoSubmit ??= new AccountEditAutoSubmit(container, this.core);
    container.autoSubmit.saving();
  };

  private readonly handleAjaxSuccess = (e: ContainerEvent) => {
    if (e.currentTarget.dataset.accountEditAutoSubmit === '1') return;

    e.currentTarget.autoSubmit?.saved();
  };

  private readonly handleInputChange = (e: ContainerEvent) => {
    const container = e.currentTarget;

    if (container.dataset.accountEditAutoSubmit !== '1') {
      return;
    }

    container.autoSubmit ??= new AccountEditAutoSubmit(container, this.core);

    if (container.dataset.accountEditAutoSubmit === '1') {
      container.autoSubmit.onInput();
    }
  };
}
