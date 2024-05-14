// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import CurrentUserJson from 'interfaces/current-user-json';
import { route } from 'laroute';
import { debounce } from 'lodash';
import OsuCore from 'osu-core';
import { onError } from 'utils/ajax';

const inputSelector = '.js-account-edit__input';

export default class AccountEditState {
  readonly debouncedUpdate;

  private defaultValue?: string;
  private timeout?: number;
  private xhr?: JQuery.jqXHR<CurrentUserJson | null>;

  constructor(private readonly container: HTMLElement, private readonly core: OsuCore) {
    this.debouncedUpdate = debounce(this.update, 1000);

    if (this.isSingleValue) {
      const input = this.inputElement;
      this.defaultValue = input.type === 'checkbox' ? String(input.checked) : input.defaultValue;
    }
  }

  private get inputElement() {
    const input = this.container.querySelector<HTMLInputElement>(inputSelector);
    if (input == null) {
      throw new Error('missing input');
    }

    return input;
  }

  private get isSingleValue() {
    return this.dataset.accountEditAutoSubmit === '1' && this.dataset.accountEditType == null;
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

    const input = this.container.querySelector<HTMLInputElement>(inputSelector);
    if (input == null) {
      throw new Error('missing input name');
    }

    return input.name;
  }

  clear() {
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

    for (const checkbox of this.container.querySelectorAll<HTMLInputElement>(inputSelector)) {
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
      const input = this.container.querySelector<HTMLInputElement>(inputSelector);
      if (input == null) {
        throw new Error('missing input');
      }

      value = input.type === 'checkbox' ? String(input.checked) : input.value;
    }

    return value;
  }

  private readonly update = () => {
    let value: string | string[] | undefined;

    if (this.isSingleValue) {
      value = this.getValue();
      if (this.xhr == null && this.defaultValue === value) {
        this.clear();
        return;
      }
    }

    const data = value != null
      ? { [this.fieldName]: this.getValue() }
      :  this.data;

    this.xhr = $.ajax(this.dataset.url ?? route('account.update'), {
      data,
      method: 'PUT',
    });

    this.xhr.done((response) => {
      if (this.dataset.userPreferencesUpdate === '1' && response != null) {
        this.core.setCurrentUser(response);
      }

      // update default initial value.
      if (this.isSingleValue && typeof value === 'string') {
        this.defaultValue = value;
      }

      this.saved();
      this.xhr = undefined;
    }).fail((xhr) => {
      this.clear();
      onError(xhr);
    });
  };
}
