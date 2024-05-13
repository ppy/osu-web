// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import CurrentUserJson from 'interfaces/current-user-json';
import { route } from 'laroute';
import { debounce } from 'lodash';
import OsuCore from 'osu-core';
import { onError } from 'utils/ajax';

export default class AccountEditAutoSubmit {
  readonly debouncedUpdate;
  private savedTimeout?: number;
  private updating?: JQuery.jqXHR<CurrentUserJson | null>;

  constructor(private readonly container: HTMLElement, private readonly core: OsuCore) {
    this.debouncedUpdate = debounce(this.update, 1000);
  }

  abortUpdate() {
    if (this.updating != null) {
      this.updating.abort();
    }

    this.clearState();
  }

  saving() {
    this.container.dataset.accountEditState = 'saving';
  }

  private clearState() {
    window.clearTimeout(this.savedTimeout);
    this.container.dataset.accountEditState = '';
  }

  private getFieldName() {
    if (this.container.dataset.field != null) {
      return this.container.dataset.field;
    }

    const input = this.container.querySelector<HTMLInputElement>('.js-account-edit__input');
    if (input == null) {
      throw new Error('missing input name');
    }

    return input.name;
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
    let prevValue: string | undefined;

    if (this.container.dataset.accountEditType === 'array') {
      prevValue = undefined;
      value = [];

      for (const checkbox of this.container.querySelectorAll('input')) {
        if (checkbox.checked) {
          value.push(checkbox.value);
        }
      }
    } else if (this.container.dataset.accountEditType === 'radio') {
      prevValue = this.container.dataset.lastValue;

      // TODO: require name?
      for (const checkbox of this.container.querySelectorAll<HTMLInputElement>('input[type="radio"]')) {
        if (checkbox.checked) {
          value = checkbox.value;
          break;
        }
      }
    } else {
      prevValue = this.container.dataset.lastValue;

      const input = this.container.querySelector<HTMLInputElement>('.js-account-edit__input');
      if (input == null) {
        throw new Error('missing input');
      }

      value = input.type === 'checkbox' ? String(input.checked) : input.value;
    }

    return { prevValue, value };
  }

  private readonly update = () => {
    let data: Partial<Record<string, boolean | string | string[]>>;

    if (this.container.dataset.accountEditType === 'multi') {
      data = this.getMultiValue();
    } else {
      const { prevValue, value } = this.getValue();

      if (value === prevValue) {
        return;
      }

      const field = this.getFieldName();

      // dataset autoconverts to string but the typing doesn't accept array.
      this.container.dataset.lastValue = Array.isArray(value) ? value.join(',') : value;
      data = { [field]: value };
    }

    const url = this.container.dataset.url ?? route('account.update');

    this.updating = $.ajax(url, {
      data,
      method: 'PUT',
    }).done((response: CurrentUserJson | null) => {
      if (this.container.dataset.userPreferencesUpdate === '1' && response != null) {
        this.core.setCurrentUser(response);
      }

      window.clearTimeout(this.savedTimeout);
      this.container.dataset.accountEditState = 'saved';
      this.savedTimeout = window.setTimeout(() => this.clearState(), 3000);
    }).fail((xhr) => {
      this.clearState();
      onError(xhr);
    });
  };
}
