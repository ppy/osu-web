// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { createAnnoucement } from 'chat/chat-api';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { debounce } from 'lodash';
import { action, computed, makeObservable, observable, runInAction } from 'mobx';
import core from 'osu-core-singleton';

export const inputKeys = ['description', 'message', 'name', 'users'] as const;
export type InputKey = typeof inputKeys[number];
type Inputs = Record<InputKey, string>;

export function isInputKey(key: string): key is InputKey {
  return (inputKeys as Readonly<string[]>).includes(key);
}

export default class CreateAnnouncement {
  @observable busy = {
    create: false,
    lookupUsers: false,
  };

  debouncedLookupUsers = debounce(() => this.lookupUsers(), 1000);

  @observable inputs: Inputs = {
    description: '',
    message: '',
    name: '',
    users: '',
  };
  @observable invalidable: Record<InputKey, boolean> = {
    description: false,
    message: false,
    name: false,
    users: false,
  };
  @observable validUsers = new Map<number, UserJson>();

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
    makeObservable(this);
  }

  @action
  clear() {
    this.xhrLookupUsers?.abort();
    Object.keys(this.busy).forEach((key: keyof typeof this.busy) => this.busy[key] = false);
    Object.keys(this.inputs).forEach((key: keyof typeof this.inputs) => this.inputs[key] = '');
    this.validUsers.clear();
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
    if (text.length === 0) {
      this.xhrLookupUsers?.abort();
      this.debouncedLookupUsers.cancel();
      this.busy.lookupUsers = false;
      this.inputs.users = text;
      return;
    }

    this.busy.lookupUsers = true;
    this.debouncedLookupUsers.cancel();
    this.inputs.users = text;
    this.debouncedLookupUsers();

    if (immediate) {
      this.debouncedLookupUsers.flush();
    }
  }

  /**
   * Disassembles and extract valid users from the string.
   */
  @action
  private extractValidUsers() {
    const userIds = this.inputs.users.split(',');
    if (userIds.length === 0) return false;

    const invalidUsers: string[] = [];

    for (const userId of userIds) {
      const trimmedUserId = osu.presence(userId.trim());

      if (!this.validUsersContains(trimmedUserId)) {
        invalidUsers.push(userId);
      }
    }

    this.inputs.users = invalidUsers.join(',');
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
      runInAction(() => {
        for (const user of response.users) {
          this.validUsers.set(user.id, user);
        }

        this.extractValidUsers();
      });
    } finally {
      runInAction(() => this.busy.lookupUsers = false);
    }
  }

  private validUsersContains(userId?: string | null) {
    if (userId == null) return false;

    const userIdNumber = Number(userId);
    if (Number.isInteger(userIdNumber) && this.validUsers.has(userIdNumber)) return true;

    // maybe it's a username
    for (const user of this.validUsers.values()) {
      if (user.username.toLowerCase() === userId.toLowerCase()) return true;
    }

    return false;
  }
}
