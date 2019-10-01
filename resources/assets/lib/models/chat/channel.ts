/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

import { ChannelJSON, ChannelType } from 'chat/chat-api-responses';
import * as _ from 'lodash';
import { action, computed, observable, transaction } from 'mobx';
import User from 'models/user';
import Message from './message';

export default class Channel {
  @observable channelId: number;
  @observable description?: string;
  @observable icon?: string;
  @observable lastMessageId: number = -1;
  @observable lastReadId?: number;
  @observable loaded: boolean = false;
  @observable loading: boolean = false;
  @observable messages: Message[] = observable([]);
  @observable metaLoaded: boolean = false;
  @observable moderated: boolean = false;
  @observable name: string = '';
  @observable newChannel: boolean = false;
  @observable type: ChannelType = 'NEW';
  @observable users: number[] = [];
  private backlogSize: number = 100;

  @computed
  get isUnread(): boolean {
    if (this.lastReadId != null) {
      return this.lastMessageId > this.lastReadId;
    } else {
      return this.lastMessageId > -1;
    }
  }

  @computed
  get exists(): boolean {
    return this.channelId > 0;
  }

  @computed
  get pmTarget(): number | undefined {
    if (this.type !== 'PM') {
      return;
    }

    return this.users.find((userId: number) => userId !== currentUser.id);
  }

  constructor(channelId: number) {
    this.channelId = channelId;
  }

  static fromJSON(json: ChannelJSON): Channel {
    const channel = Object.create(Channel.prototype);
    return Object.assign(channel, {
      channelId: json.channel_id,
      name: json.name,
      type: json.type,

      description: json.description,
      icon: json.icon,
      lastMessageId: json.last_message_id,
      lastReadId: json.last_read_id,
    });
  }

  static newPM(target: User): Channel {
    const channel = new Channel(-1);
    channel.newChannel = true;
    channel.type = 'PM';
    channel.name = target.username;
    channel.icon = target.avatarUrl;
    channel.users = [currentUser.id, target.id];

    return channel;
  }

  @action
  addMessages(messages: Message | Message[], skipSort: boolean = false) {
    transaction(() => {
      this.messages = this.messages.concat(messages);

      if (!skipSort) {
        this.resortMessages();
      }

      if (this.messages.length > this.backlogSize) {
        this.messages = _.drop(this.messages, this.messages.length - this.backlogSize);
      }

      const lastMessage = _(([] as Message[]).concat(messages))
        .filter((message) => typeof message.messageId === 'number')
        .maxBy('messageId');
      let lastMessageId;

      // The type check is redundant due to the filter above.
      if (lastMessage != null && typeof lastMessage.messageId === 'number') {
        lastMessageId = lastMessage.messageId;
      } else {
        lastMessageId = -1;
      }
      if (lastMessageId > this.lastMessageId) {
        this.lastMessageId = lastMessageId;
      }
    });
  }

  @action
  resortMessages() {
    let newMessages = this.messages.slice();
    newMessages = _.sortBy(newMessages, 'timestamp');
    newMessages = _.uniqBy(newMessages, 'messageId');

    this.messages = newMessages;
  }

  @action
  unload() {
    this.messages = observable([]);
  }

  @action
  updateMessage(message: Message) {
    const messageObject = _.find(this.messages, {uuid: message.uuid});
    if (messageObject) {
      messageObject.update(message);
      if (messageObject.errored) {
        messageObject.messageId = messageObject.uuid; // prevent from being culled by uniq sort thing
      } else {
        messageObject.persist();
      }
    } else {
      // delay and retry?
    }
  }

  @action
  updatePresence = (presence: ChannelJSON) => {
    this.name = presence.name;
    this.description = presence.description;
    this.type = presence.type;
    this.icon = presence.icon || '/images/layout/chat/channel-default.png'; // TODO: update with channel-specific icons?
    this.lastReadId = presence.last_read_id;

    const lastMessageId = _.max([this.lastMessageId, presence.last_message_id]);
    this.lastMessageId = lastMessageId == null ? -1 : lastMessageId;

    this.users = presence.users;
    this.metaLoaded = true;
  }
}
