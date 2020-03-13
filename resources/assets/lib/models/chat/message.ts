// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { MessageJSON } from 'chat/chat-api-responses';
import * as _ from 'lodash';
import { action, computed, observable } from 'mobx';
import User from 'models/user';
import * as moment from 'moment';

export default class Message {
  @observable channelId: number = -1;
  @observable content: string = '';
  @observable errored: boolean = false;
  @observable isAction: boolean = false;
  @observable messageId: number | string = -1;
  @observable persisted: boolean = false;
  @observable sender: User;
  @observable timestamp: string = moment().toISOString();
  @observable uuid: string = osu.uuid();

  @computed
  get parsedContent(): string {
    return osu.linkify(_.escape(this.content), true);
  }

  constructor() {
    this.uuid = osu.uuid();
    this.sender = new User(-1); // placeholder user
  }

  static fromJSON(json: MessageJSON): Message {
    const message = Object.create(Message.prototype);
    return Object.assign(message, {
      channelId: json.channel_id,
      content: json.content,
      isAction: json.is_action,
      messageId: json.message_id,
      persisted: true,
      timestamp: json.timestamp,
      uuid: osu.uuid(),
    });
  }

  @action
  persist(): Message {
    this.persisted = true;

    return this;
  }

  @action
  update(message: Message): Message {
    this.messageId = message.messageId;
    this.channelId = message.channelId;
    this.content = message.content;
    this.timestamp = message.timestamp;
    this.isAction = message.isAction;
    this.errored = message.errored;
    this.sender = message.sender;

    return this;
  }
}
