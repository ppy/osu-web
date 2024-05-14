// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import OsuCore from 'osu-core';
import AccountEditState from './account-edit-state';

type ContainerEvent = JQuery.TriggeredEvent<unknown, unknown, AccountEditHTMLElement, unknown>;

const containerClassSelector = '.js-account-edit';

interface AccountEditHTMLElement extends HTMLElement {
  state?: AccountEditState;
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

    e.currentTarget.state?.errored();
  };

  private readonly handleAjaxSend = (e: ContainerEvent) => {
    const container = e.currentTarget;
    if (container.dataset.accountEditAutoSubmit === '1') return;

    container.state ??= new AccountEditState(container, this.core);
    container.state.saving();
  };

  private readonly handleAjaxSuccess = (e: ContainerEvent) => {
    if (e.currentTarget.dataset.accountEditAutoSubmit === '1') return;

    e.currentTarget.state?.saved();
  };

  private readonly handleInputChange = (e: ContainerEvent) => {
    const container = e.currentTarget;

    if (container.dataset.accountEditAutoSubmit !== '1') {
      return;
    }

    container.state ??= new AccountEditState(container, this.core);

    if (container.dataset.accountEditAutoSubmit === '1') {
      container.state.onInput();
    }
  };
}
