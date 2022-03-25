// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';
import { action, computed, makeObservable, observable } from 'mobx';

interface Inputs {
  description: string;
  message: string;
  name: string;
  users: string;
}

export default class CreateAnnouncement {
  @observable inputs: Record<keyof Inputs, string> & Partial<Record<string, string>> = {
    description: '',
    message: '',
    name: '',
    users: '',
  };
  @observable validUsers = new Map<number, UserJson>();
  private uuid = osu.uuid();

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

  constructor() {
    makeObservable(this);
  }

  @action
  clear() {
    Object.keys(this.inputs).forEach((key) => this.inputs[key] = '');
    this.validUsers.clear();
  }

  /**
   * Disassembles and extract valid users from the string.
   */
  @action
  extractValidUsers() {
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
