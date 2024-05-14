// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import CurrentUserJson from 'interfaces/current-user-json';
import { route } from 'laroute';
import { debounce } from 'lodash';
import OsuCore from 'osu-core';
import { onError } from 'utils/ajax';

export default class AccountEditState {
  readonly debouncedUpdate;
  private timeout?: number;
  private xhr?: JQuery.jqXHR<CurrentUserJson | null>;

  constructor(private readonly container: HTMLElement, private readonly core: OsuCore) {
    this.debouncedUpdate = debounce(this.update, 1000);
  }

  private get data() {
    if (this.dataset.accountEditType === 'multi') {
      return this.getMultiValue();
    } else {
      return { [this.fieldName]: this.getValue() };
    }
  }

  private get dataset() {
    return this.container.dataset;
  }

  private get fieldName() {
    if (this.dataset.field != null) {
      return this.dataset.field;
    }

    const input = this.container.querySelector<HTMLInputElement>('.js-account-edit__input');
    if (input == null) {
      throw new Error('missing input name');
    }

    return input.name;
  }

  errored() {
    window.clearTimeout(this.timeout);
    this.dataset.accountEditState = '';
  }

  onInput() {
    this.xhr?.abort();

    this.saving();
    this.debouncedUpdate();
  }

  saved() {
    window.clearTimeout(this.timeout);
    this.dataset.accountEditState = 'saved';
    this.timeout = window.setTimeout(() => {
      this.dataset.accountEditState = '';
    }, 3000);
  }

  saving() {
    window.clearTimeout(this.timeout);
    this.dataset.accountEditState = 'saving';
  }

  private getMultiValue() {
    const data: Partial<Record<string, boolean>> = {};

    for (const checkbox of this.container.querySelectorAll<HTMLInputElement>('.js-account-edit__input')) {
      data[checkbox.name] = checkbox.checked;
    }

    return data;
  }

  private getValue() {
    let value: string | string[] | undefined;

    if (this.dataset.accountEditType === 'array') {
      value = [];

      for (const checkbox of this.container.querySelectorAll('input')) {
        if (checkbox.checked) {
          value.push(checkbox.value);
        }
      }
    } else if (this.dataset.accountEditType === 'radio') {
      // TODO: require name?
      for (const checkbox of this.container.querySelectorAll<HTMLInputElement>('input[type="radio"]')) {
        if (checkbox.checked) {
          value = checkbox.value;
          break;
        }
      }
    } else {
      const input = this.container.querySelector<HTMLInputElement>('.js-account-edit__input');
      if (input == null) {
        throw new Error('missing input');
      }

      value = input.type === 'checkbox' ? String(input.checked) : input.value;
    }

    return value;
  }

  private readonly update = () => {
    this.xhr = $.ajax(this.dataset.url ?? route('account.update'), {
      data: this.data,
      method: 'PUT',
    });

    this.xhr.done((response) => {
      if (this.dataset.userPreferencesUpdate === '1' && response != null) {
        this.core.setCurrentUser(response);
      }

      this.saved();
    }).fail((xhr) => {
      this.errored();
      onError(xhr);
    });
  };
}
