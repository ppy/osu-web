// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ChannelJson, ChannelJsonExtended, ChannelType, MessageJson } from 'chat/chat-api-responses';
import * as _ from 'lodash';
import { action, computed, observable } from 'mobx';
import User from 'models/user';
import Message from './message';

export default class Channel {
  @observable channelId: number;
  @observable description?: string;
  firstMessageId: number = -1;
  @observable icon?: string;
  @observable inputText: string = '';
  @observable lastMessageId: number = -1;
  @observable lastReadId?: number;
  @observable loaded: boolean = false;
  @observable loading: boolean = false;
  @observable loadingEarlierMessages: boolean = false;
  @observable messages: Message[] = observable([]);
  @observable metaLoaded: boolean = false;
  @observable moderated: boolean = false;
  @observable name: string = '';
  @observable newPmChannel = false;
  @observable type: ChannelType = 'NEW';
  @observable users: number[] = [];

  @computed
  get firstMessage() {
    return this.messages.length > 0 ? this.messages[0] : undefined;
  }

  @computed
  get hasEarlierMessages() {
    return this.firstMessageId !== this.minMessageId;
  }

  @computed
  get isUnread(): boolean {
    if (this.lastReadId != null) {
      return this.lastMessageId > this.lastReadId;
    } else {
      return this.lastMessageId > -1;
    }
  }

  @computed
  get lastMessage(): Message | undefined {
    return this.messages[this.messages.length - 1];
  }

  @computed
  get minMessageId() {
    const id = this.messages.length > 0 ? this.messages[0].messageId : undefined;

    return typeof id === 'number' ? id : -1;
  }

  @computed
  get pmTarget(): number | undefined {
    if (this.type !== 'PM') {
      return;
    }

    return this.users.find((userId: number) => userId !== currentUser.id);
  }

  @computed
  get transient() {
    return this.type === 'NEW';
  }

  constructor(channelId: number) {
    this.channelId = channelId;
  }

  static fromJson(json: ChannelJsonExtended): Channel {
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
    channel.newPmChannel = true;
    channel.type = 'PM';
    channel.name = target.username;
    channel.icon = target.avatarUrl;
    channel.users = [currentUser.id, target.id];

    return channel;
  }

  @action
  addMessages(messages: Message[], skipSort: boolean = false) {
    this.messages.push(...messages);

    if (!skipSort) {
      this.resortMessages();
    }

    const lastMessage = _(messages)
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
  }

  @action
  afterSendMesssage(message: Message, json: MessageJson | null) {
    if (json != null) {
      message.messageId = json.message_id;
      message.timestamp = json.timestamp;
      message.persist();
    } else {
      message.errored = true;
      // delay and retry?
    }

    this.resortMessages();
  }

  @action
  markAsRead() {
    this.lastReadId = this.lastMessageId;
  }

  @action
  removeMessagesFromUserIds(userIds: Set<number>) {
    this.messages = this.messages.filter((message) => !userIds.has(message.senderId));
  }

  @action
  setInputText(message: string) {
    this.inputText = message;
  }

  @action
  unload() {
    this.messages = observable([]);
  }

  @action
  updatePresence = (json: ChannelJsonExtended) => {
    this.updateWithJson(json);
    this.lastReadId = json.last_read_id;
  }

  @action
  updateWithJson(json: ChannelJson) {
    this.name = json.name;
    this.description = json.description;
    this.type = json.type;
    this.icon = json?.icon ?? '/images/layout/chat/channel-default.png'; // TODO: update with channel-specific icons?
    this.moderated = json.moderated;
    this.users = json.users;

    this.firstMessageId = json.first_message_id ?? this.firstMessageId;
    // ?? -1 is just there for typing, lastMessageId initializes with -1.
    this.lastMessageId = _.max([this.lastMessageId, json.last_message_id]) ?? -1;

    this.metaLoaded = true;
  }

  @action
  private resortMessages() {
    this.messages = _(this.messages).sortBy('timestamp').uniqBy('messageId').value();
  }
}
