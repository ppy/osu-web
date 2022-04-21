// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { createAnnoucement } from 'chat/chat-api';
import { FancyForm } from 'components/input-container';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { debounce } from 'lodash';
import { action, autorun, computed, makeObservable, observable, runInAction } from 'mobx';
import core from 'osu-core-singleton';

interface LocalStorageProps extends Record<InputKey, string> {
  validUsers: number[];
}

const inputKeys = ['description', 'message', 'name', 'users'] as const;
type InputKey = typeof inputKeys[number];

const localStorageKey = 'createAnnoucement';

export function isInputKey(key: string): key is InputKey {
  return (inputKeys as Readonly<string[]>).includes(key);
}

export default class CreateAnnouncement implements FancyForm<InputKey> {
  @observable busy = {
    create: false,
    lookupUsers: false,
  };

  @observable inputs: Record<InputKey, string> = {
    description: '',
    message: '',
    name: '',
    users: '',
  };
  @observable showError: Record<InputKey, boolean> = {
    description: false,
    message: false,
    name: false,
    users: false,
  };
  @observable validUsers = new Map<number, UserJson>();

  private debouncedLookupUsers = debounce(() => this.lookupUsers(), 1000);
  private uuid = osu.uuid();
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

    makeObservable(this);

    autorun(() => {
      const props: LocalStorageProps = {
        ...this.inputs,
        validUsers: [...this.validUsers.keys()],
      };

      // TODO: don't save if 'empty'?
      localStorage.setItem(localStorageKey, JSON.stringify(props));
    });
  }

  @action
  clear() {
    this.xhrLookupUsers?.abort();
    Object.keys(this.busy).forEach((key: keyof typeof this.busy) => this.busy[key] = false);
    Object.keys(this.inputs).forEach((key: keyof typeof this.inputs) => this.inputs[key] = '');
    this.validUsers.clear();
    // localStorage key not removed because the currently the autorun will fill it again with empty values.
  }

  @action
  create() {
    if (!this.isValid || this.busy.create) return;

    // busy state should remain active so the same model can't be used to send multiple requests
    // until the entire workflow is complete, including switching the channel.
    // TODO: need a cancel or timeout or something?
    this.busy.create = true;
    const json = this.toJson();
    core.dataStore.chatState.waitJoinChannelUuid = json.uuid;

    createAnnoucement(json)
      .fail(action((xhr: JQueryXHR) => {
        osu.ajaxError(xhr);
        this.busy.create = false;
      }));
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
      this.busy.lookupUsers = false;

      return;
    }

    this.busy.lookupUsers = true;
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

  private fetchUsers(ids: (string | null)[]) {
    return $.getJSON(route('chat.users.index'), { ids }) as JQuery.jqXHR<{ users: UserJson[] }>;
  }


  @action
  private async lookupUsers() {
    this.xhrLookupUsers?.abort();
    this.debouncedLookupUsers.cancel();

    const userIds = this.inputs.users.split(',').map((s) => osu.presence(s.trim())).filter(Boolean);
    if (userIds.length === 0) {
      this.busy.lookupUsers = false;
      return;
    }

    try {
      this.xhrLookupUsers = this.fetchUsers(userIds);
      const response = await this.xhrLookupUsers;

      this.extractValidUsers(response.users);
    } catch (error) {
      if (this.xhrLookupUsers?.readyState === 0 && this.xhrLookupUsers === error) {
        return;
      }

      osu.ajaxError(error);
    } finally {
      runInAction(() => this.busy.lookupUsers = false);
    }
  }

  private validUsersContains(userId?: string | null) {
    if (userId == null) return false;

    const userIdNumber = Number(userId);
    return (Number.isInteger(userIdNumber) && this.validUsers.has(userIdNumber))
      // maybe it's a username
      || [...this.validUsers.values()].some((user) => user.username.toLowerCase() === userId.toLowerCase());
  }
}
