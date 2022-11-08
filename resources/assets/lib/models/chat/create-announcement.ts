// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { FormWithErrors } from 'components/input-container';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { debounce } from 'lodash';
import { action, autorun, computed, makeObservable, observable, runInAction } from 'mobx';
import core from 'osu-core-singleton';
import { onError } from 'utils/ajax';
import { uuid } from 'utils/seq';

interface LocalStorageProps extends Record<InputKey, string> {
  validUsers: number[];
}

const inputKeys = ['description', 'message', 'name', 'users'] as const;
type InputKey = typeof inputKeys[number];

const localStorageKey = 'createAnnouncement';

export function isInputKey(key: string): key is InputKey {
  return (inputKeys as Readonly<string[]>).includes(key);
}

// This class is owned by ChatStateStore
export default class CreateAnnouncement implements FormWithErrors<InputKey> {
  @observable inputs: Record<InputKey, string>;
  @observable lookingUpUsers = false;
  @observable showError: Record<InputKey, boolean>;
  @observable validUsers = new Map<number, UserJson>();

  private debouncedLookupUsers = debounce(() => this.lookupUsers(), 1000);
  private initialized = false;
  private uuid = uuid();
  private xhrLookupUsers?: JQuery.jqXHR<{ users: UserJson[] }>;

  @computed
  get errors() {
    return {
      description: !osu.present(this.inputs.description),
      message: !osu.present(this.inputs.message),
      name: !osu.present(this.inputs.name),
      users: this.validUsers.size === 0
        || osu.present(this.inputs.users.trim()), // implies invalid ids left
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
    this.xhrLookupUsers?.abort();
    this.lookingUpUsers = false;
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

        if (osu.present(json.users.trim())) {
          userIds.push(...json.users.split(','));
        }

        this.inputs.description = json.description;
        this.inputs.message = json.message;
        this.inputs.name = json.name;

        if (userIds.length > 0) {
          this.updateUsers(userIds.join(','), true);
        }
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

  @action
  updateUsers(text: string, immediate: boolean) {
    this.debouncedLookupUsers.cancel();
    this.inputs.users = text;

    // TODO: check if change is only whitespace.
    if (text.trim().length === 0) {
      this.xhrLookupUsers?.abort();
      this.lookingUpUsers = false;

      return;
    }

    // spinner should trigger even before request is sent.
    this.lookingUpUsers = true;
    this.debouncedLookupUsers();

    if (immediate) {
      this.debouncedLookupUsers.flush();
    }
  }

  /**
   * Disassembles and extract valid users from the string.
   */
  @action
  private extractValidUsers(users: UserJson[]) {
    const userIds = this.inputs.users.split(',');

    for (const user of users) {
      this.validUsers.set(user.id, user);
    }

    const invalidUsers: string[] = [];

    for (const userId of userIds) {
      const trimmedUserId = osu.presence(userId.trim());

      if (!this.validUsersContains(trimmedUserId)) {
        invalidUsers.push(userId);
      }
    }

    this.inputs.users = invalidUsers.join(',');

    // current user is implicit, always remove.
    this.validUsers.delete(core.currentUserOrFail.id);
  }

  @action
  private async lookupUsers() {
    this.xhrLookupUsers?.abort();
    this.debouncedLookupUsers.cancel();

    const userIds = this.inputs.users.split(',').map((s) => osu.presence(s.trim())).filter(Boolean);
    if (userIds.length === 0) {
      this.lookingUpUsers = false;
      return;
    }

    try {
      this.xhrLookupUsers = $.getJSON(route('chat.users.index'), { ids: userIds });
      const response = await this.xhrLookupUsers;

      this.extractValidUsers(response.users);
    } catch (error) {
      onError(error);
    } finally {
      runInAction(() => this.lookingUpUsers = false);
    }
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

  private validUsersContains(userId?: string | null) {
    if (userId == null) return false;

    return this.validUsers.has(Number(userId))
      // maybe it's a username
      || [...this.validUsers.values()].some((user) => user.username.toLowerCase() === userId.toLowerCase());
  }
}
