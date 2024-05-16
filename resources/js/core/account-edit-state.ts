// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import CurrentUserJson from 'interfaces/current-user-json';
import { route } from 'laroute';
import { debounce } from 'lodash';
import OsuCore from 'osu-core';
import { onError } from 'utils/ajax';

const inputSelector = '.js-account-edit__input';
const requiresName = new Set(['array', 'radio']) as Set<unknown>;

export default class AccountEditState {
  readonly debouncedUpdate;

  private timeout?: number;
  private xhr?: JQuery.jqXHR<CurrentUserJson | null>;

  constructor(private readonly container: HTMLElement, private readonly core: OsuCore) {
    this.debouncedUpdate = debounce(this.update, 1000);
    if (requiresName.has(this.dataset.accountEditType) && this.dataset.field == null) {
      throw new Error('data-field required');
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
    this.timeout = window.setTimeout(() => this.clear(), 3000);
  }

  saving() {
    window.clearTimeout(this.timeout);
    this.dataset.accountEditState = 'saving';
  }

  private getData() {
    let value: string | string[] | undefined;

    switch (this.dataset.accountEditType) {
      case 'multi': {
        const data: Partial<Record<string, boolean>> = {};

        for (const checkbox of this.container.querySelectorAll<HTMLInputElement>(inputSelector)) {
          data[checkbox.name] = checkbox.checked;
        }

        return data;
      }
      case 'array':
        value = [''];

        for (const checkbox of this.container.querySelectorAll('input')) {
          if (checkbox.checked) {
            value.push(checkbox.value);
          }
        }
        break;

      case 'radio':
        for (const checkbox of this.container.querySelectorAll<HTMLInputElement>('input[type="radio"]')) {
          if (checkbox.checked) {
            value = checkbox.value;
            break;
          }
        }
        break;

      default: {
        const input = this.container.querySelector<HTMLInputElement>(inputSelector);
        if (input == null) {
          throw new Error('missing input');
        }

        value = input.type === 'checkbox' ? String(input.checked) : input.value;
      }
    }

    if (value == null) {
      throw new Error('missing radio value');
    }

    return { [this.fieldName]: value };
  }

  private readonly update = () => {
    this.xhr = $.ajax(this.dataset.url ?? route('account.update'), {
      data: this.getData(),
      method: 'PUT',
    });

    this.xhr.done((response) => {
      if (this.dataset.userPreferencesUpdate === '1' && response != null) {
        this.core.setCurrentUser(response);
      }

      this.saved();
    }).fail((xhr) => {
      this.clear();
      onError(xhr);
    });
  };
}
