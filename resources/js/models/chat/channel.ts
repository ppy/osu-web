// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { markAsRead, getChannel, getMessages } from 'chat/chat-api';
import ChannelJson, { ChannelType, SupportedChannelType, supportedTypeLookup } from 'interfaces/chat/channel-json';
import MessageJson from 'interfaces/chat/message-json';
import { minBy, sortBy, throttle } from 'lodash';
import { action, computed, makeObservable, observable, runInAction } from 'mobx';
import User, { usernameSortAscending } from 'models/user';
import core from 'osu-core-singleton';
import Message from './message';

const hideableChannelTypes: Set<ChannelType> = new Set(['ANNOUNCE', 'PM']);

export default class Channel {
  private static readonly defaultIcon = '/images/layout/chat/channel-default.png'; // TODO: update with channel-specific icons?

  @observable canMessageError: string | null = null;
  @observable channelId: number;
  @observable description?: string;
  @observable firstMessageId = -1;
  @observable icon?: string;
  @observable inputText = '';
  @observable lastReadId?: number;
  @observable loadingEarlierMessages = false;
  @observable loadingMessages = false;
  @observable name = '';
  needsRefresh = true;
  @observable newPmChannel = false;
  readonly throttledSendMarkAsRead = throttle(() => this.sendMarkAsRead(), 1000);
  @observable type: ChannelType = 'TEMPORARY'; // TODO: look at making this support channels only
  @observable uiState = {
    autoScroll: true,
    scrollY: 0,
  };
  @observable userIds: number[] = [];

  private markAsReadLastSent = 0;
  @observable private messagesMap = new Map<number | string, Message>();
  private serverLastMessageId?: number;
  @observable private usersLoaded = false;

  @computed
  get announcementUsers() {
    return this.usersLoaded
      ? this.userIds
        .map((userId) => core.dataStore.userStore.get(userId))
        .filter((u): u is User => u != null)
        .sort(usernameSortAscending)
      : null;
  }

  @computed
  get canMessage() {
    return this.canMessageError == null;
  }

  @computed
  get firstMessage() {
    return this.messages.length > 0 ? this.messages[0] : undefined;
  }

  @computed
  get hasEarlierMessages() {
    return this.firstMessageId !== this.minMessageId;
  }

  @computed
  get isDisplayable() {
    return this.name.length > 0 && this.icon != null;
  }

  get isHideable() {
    return hideableChannelTypes.has(this.type);
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
  get messages() {
    return sortBy([...this.messagesMap.values()], ['timestamp', 'channelId']);
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

    return this.userIds.find((userId: number) => userId !== core.currentUserOrFail.id);
  }

  @computed
  get supportedType() {
    return supportedTypeLookup.has(this.type) ? this.type as SupportedChannelType : null;
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
    channel.userIds = [core.currentUserOrFail.id, target.id];

    return channel;
  }

  /**
   * For handling messages that come over the socket.
   * May include relayed messages that are were just sent.
   */
  @action
  addMessage(json: MessageJson) {
    if (json.uuid != null && json.sender_id === core.currentUser?.id) {
      const existing = this.messagesMap.get(json.uuid);
      if (existing != null) {
        return this.persistMessage(existing, json);
      }
    }

    const message = Message.fromJson(json);
    this.messagesMap.set(message.messageId, message);
  }

  /**
   * Batch adding messages from updating channels.
   */
  @action
  addMessages(messages: Message[]) {
    messages.forEach((message) => this.messagesMap.set(message.messageId, message));
  }

  @action
  addSendingMessage(message: Message) {
    this.messagesMap.set(message.messageId, message);
    this.moveMarkAsReadMarker();
  }

  @action
  afterSendMesssage(message: Message, json: MessageJson | null) {
    if (json != null) {
      this.persistMessage(message, json);
      this.setLastReadId(json.message_id);
    } else {
      message.errored = true;
      // delay and retry?
    }
  }

  @action
  load() {
    // nothing to load
    if (this.newPmChannel) return;

    if (this.type === 'ANNOUNCE' && !this.usersLoaded) {
      this.loadMetadata();
    }

    this.loadRecentMessages();
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
        this.addMessages(messages);
        if (messages.length === 0) {
          // assume no more messages.
          this.firstMessageId = this.minMessageId;
        }
      });
    } finally {
      runInAction(() => {
        this.loadingEarlierMessages = false;
      });
    }
  }

  @action
  loadMetadata() {
    getChannel(this.channelId).done((json) => {
      runInAction(() => {
        this.updateWithJson(json);
        this.usersLoaded = true;
      });
    });
  }

  @action
  moveMarkAsReadMarker() {
    this.setLastReadId(this.lastMessageId);
  }

  @action
  removeMessagesFromUserIds(userIds: Set<number>) {
    for (const [, message] of this.messagesMap) {
      if (userIds.has(message.senderId)) {
        this.messagesMap.delete(message.messageId);
      }
    }
  }

  @action
  setInputText(message: string) {
    this.inputText = message;
  }

  @action
  updateWithJson(json: ChannelJson) {
    this.name = json.name;
    this.description = json.description;
    this.type = json.type;
    this.icon = json.icon ?? Channel.defaultIcon;
    this.userIds = json.users ?? this.userIds;

    this.serverLastMessageId = json.last_message_id;

    if (json.current_user_attributes != null) {
      this.canMessageError = json.current_user_attributes.can_message_error;
      const lastReadId = json.current_user_attributes.last_read_id ?? 0;
      this.setLastReadId(lastReadId);
      if (lastReadId > this.markAsReadLastSent) {
        this.markAsReadLastSent = lastReadId;
      }
    }
  }

  @action
  private async loadRecentMessages() {
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
          this.messagesMap.clear();
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
  private persistMessage(message: Message, json: MessageJson) {
    if (json.uuid != null) {
      this.messagesMap.delete(json.uuid);
    }

    message.persist(json);
    this.messagesMap.set(message.messageId, message);
  }

  @action
  private sendMarkAsRead() {
    const lastReadId = this.lastReadId ?? 0;
    if (this.markAsReadLastSent >= lastReadId) return;

    this.markAsReadLastSent = lastReadId;
    markAsRead(this.channelId, lastReadId);
  }

  @action
  private setLastReadId(id: number) {
    if (id > (this.lastReadId ?? 0)) {
      this.lastReadId = id;
    }
  }
}
