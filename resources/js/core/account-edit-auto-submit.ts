// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import CurrentUserJson from 'interfaces/current-user-json';
import { route } from 'laroute';
import { debounce } from 'lodash';
import OsuCore from 'osu-core';
import { onError } from 'utils/ajax';

export default class AccountEditAutoSubmit {
  readonly debouncedUpdate;
  private timeout?: number;
  private xhr?: JQuery.jqXHR<CurrentUserJson | null>;

  constructor(private readonly container: HTMLElement, private readonly core: OsuCore) {
    this.debouncedUpdate = debounce(this.update, 1000);
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

  onInput() {
    this.xhr?.abort();
    window.clearTimeout(this.timeout);

    this.dataset.accountEditState = 'saving';
    this.debouncedUpdate();
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

    if (this.dataset.accountEditType === 'array') {
      prevValue = undefined;
      value = [];

      for (const checkbox of this.container.querySelectorAll('input')) {
        if (checkbox.checked) {
          value.push(checkbox.value);
        }
      }
    } else if (this.dataset.accountEditType === 'radio') {
      prevValue = this.dataset.lastValue;

      // TODO: require name?
      for (const checkbox of this.container.querySelectorAll<HTMLInputElement>('input[type="radio"]')) {
        if (checkbox.checked) {
          value = checkbox.value;
          break;
        }
      }
    } else {
      prevValue = this.dataset.lastValue;

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

    if (this.dataset.accountEditType === 'multi') {
      data = this.getMultiValue();
    } else {
      const { prevValue, value } = this.getValue();

      if (value === prevValue) {
        this.dataset.accountEditState = '';
        return;
      }

      // dataset autoconverts to string but the typing doesn't accept array.
      this.dataset.lastValue = Array.isArray(value) ? value.join(',') : value;
      data = { [this.fieldName]: value };
    }

    const url = this.dataset.url ?? route('account.update');

    this.xhr = $.ajax(url, {
      data,
      method: 'PUT',
    });

    this.xhr.done((response) => {
      if (this.dataset.userPreferencesUpdate === '1' && response != null) {
        this.core.setCurrentUser(response);
      }

      window.clearTimeout(this.timeout);
      this.dataset.accountEditState = 'saved';
      this.timeout = window.setTimeout(() => {
        this.dataset.accountEditState = '';
      }, 3000);
    }).fail((xhr) => {
      this.dataset.accountEditState = '';
      onError(xhr);
    });
  };
}
