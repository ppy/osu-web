// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { getMessages } from 'chat/chat-api';
import ChannelJson, { ChannelType } from 'interfaces/chat/channel-json';
import MessageJson from 'interfaces/chat/message-json';
import * as _ from 'lodash';
import { minBy } from 'lodash';
import { action, computed, makeObservable, observable, runInAction } from 'mobx';
import Message from 'models/chat/message';
import User from 'models/user';
import core from 'osu-core-singleton';

export default class Channel {
  private static readonly defaultIcon = '/images/layout/chat/channel-default.png'; // TODO: update with channel-specific icons?

  @observable canMessage = true;
  @observable channelId: number;
  @observable description?: string;
  @observable firstMessageId = -1;
  @observable icon?: string;
  @observable inputText = '';
  @observable lastReadId?: number;
  @observable loadingEarlierMessages = false;
  @observable loadingMessages = false;
  @observable messages: Message[] = observable([]);
  @observable name = '';
  needsRefresh = true;
  @observable newPmChannel = false;
  @observable type: ChannelType = 'NEW';
  @observable users: number[] = [];

  private serverLastMessageId?: number;

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
  get lastMessageId() {
    for (let i = this.messages.length - 1; i >= 0; i--) {
      if (typeof this.messages[i].messageId === 'number') {
        return this.messages[i].messageId as number;
      }
    }

    return this.serverLastMessageId ?? -1;
  }

  @computed
  get isDisplayable() {
    return this.name.length > 0 && this.icon != null;
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

    makeObservable(this);
  }

  static newPM(target: User, channelId: number | null): Channel {
    const channel = new Channel(channelId ?? -1);
    channel.newPmChannel = channelId == null;
    channel.type = 'PM';
    channel.name = target.username;
    channel.icon = target.avatarUrl;
    channel.users = [currentUser.id, target.id];

    return channel;
  }

  /**
   * For handling messages that come over the socket.
   * May include relayed messages that are were just sent.
   */
  @action
  addMessage(json: MessageJson) {
    // find any pending message being sent.
    if (json.uuid != null && json.sender_id === core.currentUser?.id) {
      // TODO: limit the extent of back searching (because current tab might not be the sender)
      for (let i = this.messages.length; i > 0; i--) {
        const message = this.messages[i - 1];
        if (message.uuid === json.uuid) {
          message.persist(json);
          return;
        }
      }
    }

    this.messages.push(Message.fromJson(json));
  }

  /**
   * Batch adding messages from updating channels.
   */
  @action
  addMessages(messages: Message[]) {
    this.messages.push(...messages);
    this.resortMessages();
  }

  @action
  addSendingMessage(message: Message) {
    this.messages.push(message);
    this.markAsRead();
  }

  @action
  afterSendMesssage(message: Message, json: MessageJson | null) {
    if (json != null) {
      message.persist(json);
      this.setLastReadId(json.message_id);
    } else {
      message.errored = true;
      // delay and retry?
    }

    this.resortMessages();
  }

  @action
  load() {
    // nothing to load
    if (this.newPmChannel) return;

    this.refreshMessages();
  }

  @action
  async loadEarlierMessages() {
    if (!this.hasEarlierMessages || this.loadingEarlierMessages) {
      return;
    }

    this.loadingEarlierMessages = true;
    let until: number | undefined;
    // FIXME: nullable id instead?
    if (this.minMessageId > 0) {
      until = this.minMessageId;
    }

    try {
      const messages = await getMessages(this.channelId, { until });

      runInAction(() => {
        if (messages.length === 0) {
          // assume no more messages.
          this.firstMessageId = this.minMessageId;
          return;
        }

        this.addMessages(messages);
      });
    } finally {
      runInAction(() => {
        this.loadingEarlierMessages = false;
      });
    }
  }

  @action
  markAsRead() {
    this.setLastReadId(this.lastMessageId);
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
  updatePresence = (json: ChannelJson) => {
    this.updateWithJson(json);

    if (json.current_user_attributes != null) {
      this.setLastReadId(json.current_user_attributes.last_read_id);
    }
  };

  @action
  updateWithJson(json: ChannelJson) {
    this.name = json.name;
    this.description = json.description;
    this.type = json.type;
    this.icon = json.icon ?? Channel.defaultIcon;
    this.users = json.users ?? this.users;

    this.serverLastMessageId = json.last_message_id;

    if (json.current_user_attributes != null) {
      this.canMessage = json.current_user_attributes.can_message;
    }
  }

  @action
  private async refreshMessages() {
    if (!this.needsRefresh || this.loadingMessages) return;

    this.loadingMessages = true;

    let since: number | undefined;
    if (this.messages.length > 0 && this.lastMessageId > 0) {
      since = this.lastMessageId;
    }

    try {
      const messages = await getMessages(this.channelId);

      runInAction(() => {
        // gap in messages, just clear all messages instead of dealing with the gap.
        const minMessageId = minBy(messages, 'messageId')?.messageId ?? -1;
        if (minMessageId > this.lastMessageId) {
          // TODO: force scroll to the end.
          this.messages.length = 0;
        }

        this.addMessages(messages);

        this.needsRefresh = false;
        this.loadingMessages = false;

        if (messages.length === 0 && since == null) {
          // assume no more messages.
          this.firstMessageId = this.minMessageId;
          return;
        }
      });
    } catch {
      runInAction(() => this.loadingMessages = false);
    }
  }

  @action
  private resortMessages() {
    this.messages = _(this.messages).sortBy('timestamp').value();
  }

  @action
  private setLastReadId(id: number) {
    if (id > (this.lastReadId ?? 0)) {
      this.lastReadId = id;
    }
  }
}
