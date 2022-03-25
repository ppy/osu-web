// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { createAnnoucement } from 'chat/chat-api';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { debounce } from 'lodash';
import { action, computed, makeObservable, observable, runInAction } from 'mobx';
import core from 'osu-core-singleton';

interface Inputs {
  description: string;
  message: string;
  name: string;
  users: string;
}

export default class CreateAnnouncement {
  @observable busy = {
    create: false,
    lookupUsers: false,
  };

  debouncedLookupUsers = debounce(action(() => this.lookupUsers()), 1000);

  @observable inputs: Record<keyof Inputs, string> & Partial<Record<string, string>> = {
    description: '',
    message: '',
    name: '',
    users: '',
  };
  @observable validUsers = new Map<number, UserJson>();

  private uuid = osu.uuid();
  private xhr: Partial<Record<string, JQueryXHR>> = {};

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
    Object.keys(this.inputs).forEach((key) => this.inputs[key] = '');
    this.validUsers.clear();
  }

  @action
  create() {
    if (!this.isValid) return;

    const json = this.toJson();
    core.dataStore.chatState.waitJoinChannelUuid = json.uuid;

    return createAnnoucement(json)
      .done(action(() => this.clear()));
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
    this.xhr.lookupUsers?.abort();
    this.debouncedLookupUsers.cancel();

    const userIds = this.inputs.users.split(',').map((s) => osu.presence(s.trim())).filter(Boolean);
    if (userIds.length === 0) {
      this.busy.lookupUsers = false;
      return;
    }

    try {
      const response = await this.fetchUsers(userIds);
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
      if (user.username === userId) return true;
    }

    return false;
  }
}
