// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ChannelJSON, ChannelType } from 'chat/chat-api-responses';
import * as _ from 'lodash';
import { action, computed, observable, transaction } from 'mobx';
import User from 'models/user';
import Message from './message';

export default class Channel {
  @observable channelId: number;
  @observable description?: string;
  firstMessageId: number = -1;
  @observable icon?: string;
  @observable lastMessageId: number = -1;
  @observable lastReadId?: number;
  @observable loaded: boolean = false;
  @observable loading: boolean = false;
  @observable loadingEarlierMessages: boolean = false;
  @observable messages: Message[] = observable([]);
  @observable metaLoaded: boolean = false;
  @observable moderated: boolean = false;
  @observable name: string = '';
  @observable newChannel: boolean = false;
  @observable type: ChannelType = 'NEW';
  @observable users: number[] = [];

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
  get hasEarlierMessages() {
    return this.firstMessageId !== this.minMessageId;
  }

  @computed
  get minMessageId() {
    const id = this.messages[0]?.messageId;

    return typeof id === 'number' ? id : -1;
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
      firstMessageId: json.first_message_id,
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
    this.messages = _(this.messages).sortBy('timestamp').uniqBy('messageId').value();
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
    this.lastMessageId = lastMessageId ?? -1;

    this.firstMessageId = presence.first_message_id ?? -1;

    this.users = presence.users;
    this.moderated = presence.moderated;
    this.metaLoaded = true;
  }
}
