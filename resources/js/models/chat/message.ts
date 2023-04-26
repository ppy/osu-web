// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import MessageJson, { MessageType } from 'interfaces/chat/message-json';
import { action, computed, makeObservable, observable } from 'mobx';
import User from 'models/user';
import * as moment from 'moment';
import core from 'osu-core-singleton';
import { uuid } from 'utils/seq';

export const maxLength = 1024;

export default class Message {
  @observable channelId = -1;
  @observable content = '';
  @observable errored = false;
  @observable isAction = false;
  @observable messageId: number | string = uuid();
  @observable persisted = false;
  @observable senderId = -1;
  @observable timestamp: string = moment().toISOString();
  @observable type: MessageType = 'plain';
  @observable uuid = this.messageId;

  @computed
  get sender() {
    return core.dataStore.userStore.get(this.senderId) ?? new User(-1);
  }

  constructor() {
    makeObservable(this);
  }

  static fromJson(this: void, json: MessageJson): Message {
    const message = new Message();
    message.channelId = json.channel_id;
    message.content = json.content;
    message.isAction = json.is_action;
    message.messageId = json.message_id;
    message.persisted = true;
    message.senderId = json.sender_id;
    message.timestamp = json.timestamp;
    message.type = json.type;
    message.uuid = json.uuid ?? message.uuid;

    return message;
  }

  @action
  persist(json: MessageJson) {
    if (this.persisted) return;
    this.messageId = json.message_id;
    this.timestamp = json.timestamp;
    this.persisted = true;
  }
}
