/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import { action, observable} from 'mobx';
import User, { UserJSON } from 'models/user';
import Channel from './channel';

export interface MessageJSON {
  content: string;
  is_action: boolean;
  message_id: number;
  sender: UserJSON;
  sender_id: number;
  channel_id: number;
  timestamp: string;
}

export default class Message {
  @observable messageId: number;
  @observable uuid: string = osu.uuid();
  @observable channelId: number;
  @observable sender: User;
  @observable content: string;
  @observable timestamp: string = moment().toISOString();
  @observable isAction: boolean = false;

  @observable persisted: boolean = false;
  @observable errored: boolean = false;

  constructor() {
    this.uuid = osu.uuid();
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

  @action
  persist(): Message {
    this.persisted = true;

    return this;
  }

  @action
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

  static reviver(key: string, value: any): any {
    return key === '' ? Message.fromJSON(value) : value;
  }
}
