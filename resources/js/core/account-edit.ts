// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import OsuCore from 'osu-core';
import AccountEditState from './account-edit-state';

type ContainerEvent = JQuery.TriggeredEvent<unknown, unknown, AccountEditHTMLElement, unknown>;

const autoSubmitClassSelector = '.js-account-edit-auto-submit';
const classSelector = '.js-account-edit';

interface AccountEditHTMLElement extends HTMLElement {
  state?: AccountEditState;
}

export default class AccountEditBootstrap {
  constructor(private readonly core: OsuCore) {
    $(document).on('input change', autoSubmitClassSelector, this.handleInputChange);
    $(document).on('ajax:error', classSelector, this.handleAjaxError);
    $(document).on('ajax:send', classSelector, this.handleAjaxSend);
    $(document).on('ajax:success', classSelector, this.handleAjaxSuccess);
  }

  private readonly handleAjaxError = (e: ContainerEvent) => {
    e.currentTarget.state?.clear();
  };

  private readonly handleAjaxSend = (e: ContainerEvent) => {
    const container = e.currentTarget;

    container.state ??= new AccountEditState(container, this.core);
    container.state.saving();
  };

  private readonly handleAjaxSuccess = (e: ContainerEvent) => {
    e.currentTarget.state?.saved();
  };

  private readonly handleInputChange = (e: ContainerEvent) => {
    const container = e.currentTarget;

    container.state ??= new AccountEditState(container, this.core);
    container.state.onInput();
  };
}
