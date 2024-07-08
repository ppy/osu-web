// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { FormWithErrors } from 'components/input-container';
import UserJson from 'interfaces/user-json';
import { action, autorun, computed, makeObservable, observable } from 'mobx';
import { uuid } from 'utils/seq';
import { present } from 'utils/string';
import { maxMessageLength } from './channel';

interface LocalStorageProps extends Record<InputKey, string> {
  validUsers: number[];
}

const inputKeys = ['description', 'message', 'name', 'users'] as const;
type InputKey = typeof inputKeys[number];

const localStorageKey = 'createAnnouncement';

export const maxLengths = Object.freeze({
  description: 255,
  message: maxMessageLength,
  name: 50,
});

export function isInputKey(key: string): key is InputKey {
  return (inputKeys as Readonly<string[]>).includes(key);
}

// This class is owned by ChatStateStore
export default class CreateAnnouncement implements FormWithErrors<InputKey> {
  @observable inputs: Record<InputKey, string>;
  @observable showError: Record<InputKey, boolean>;
  @observable validUsers = new Map<number, UserJson>();

  private initialized = false;
  private readonly uuid = uuid();

  @computed
  get allUsers() {
    return [...this.validUsers.keys(), this.inputs.users].join(',');
  }

  @computed
  get errors() {
    return {
      description: !this.isValidLength('description', true),
      message: !this.isValidLength('message'),
      name: !this.isValidLength('name'),
      users: this.validUsers.size === 0
        || present(this.inputs.users.trim()), // implies invalid ids left
    };
  }

  @computed
  get isValid() {
    return !Object.values(this.errors).some(Boolean);
  }

  constructor() {
    this.inputs = this.resetInputs();
    this.showError = this.resetErrors();

    makeObservable(this);
  }

  @action
  clear() {
    this.resetErrors();
    this.resetInputs();
    this.validUsers.clear();
    // localStorage key not removed because the currently the autorun will fill it again with empty values.
  }

  @action
  initialize() {
    if (this.initialized) return;

    const saved = localStorage.getItem(localStorageKey);
    if (saved != null) {
      try {
        // TODO: validate props
        const json = JSON.parse(saved) as LocalStorageProps;

        const userIds: (string | number)[] = [];
        if (json.validUsers.length > 0) {
          userIds.push(...json.validUsers);
        }

        if (present(json.users.trim())) {
          userIds.push(...json.users.split(','));
        }

        this.inputs.description = json.description;
        this.inputs.message = json.message;
        this.inputs.name = json.name;
        this.inputs.users = userIds.join(',');
      } catch (error) {
        console.error('invalid json in localStorage');
        localStorage.removeItem(localStorageKey);
      }
    }

    autorun(() => {
      const props: LocalStorageProps = {
        ...this.inputs,
        validUsers: [...this.validUsers.keys()],
      };

      // TODO: don't save if 'empty'?
      localStorage.setItem(localStorageKey, JSON.stringify(props));
    });

    this.initialized = true;
  }

  toJson() {
    const { description, message, name } = this.inputs;

    return {
      channel: { description, name },
      message,
      target_ids: [...this.validUsers.keys()],
      type: 'ANNOUNCE' as const,
      uuid: this.uuid,
    };
  }

  private isValidLength(key: Exclude<InputKey, 'users'>, allowEmpty = false) {
    return (allowEmpty || present(this.inputs[key])) && this.inputs[key].length <= maxLengths[key];
  }

  @action
  private resetErrors() {
    return this.showError = {
      description: false,
      message: false,
      name: false,
      users: false,
    };
  }

  @action
  private resetInputs() {
    return this.inputs = {
      description: '',
      message: '',
      name: '',
      users: '',
    };
  }
}
