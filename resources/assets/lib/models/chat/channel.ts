// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.


import ChatApi from 'chat/chat-api';
import ChannelJson, { ChannelType } from 'interfaces/chat/channel-json';
import MessageJson from 'interfaces/chat/message-json';
import * as _ from 'lodash';
import { action, computed, makeObservable, observable, runInAction } from 'mobx';
import Message from 'models/chat/message';
import User from 'models/user';

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
  @observable loadingState = {
    // null: not loaded
    // false: loading
    // true: loaded
    messages: null as boolean | null,
    metadata: null as boolean | null,
  };
  @observable messages: Message[] = observable([]);
  @observable name = '';
  needsRefresh = false;
  @observable newPmChannel = false;
  newPmChannelTransient = false;
  @observable type: ChannelType = 'NEW';
  @observable users: number[] = [];

  private initialLastMessageId?: number;

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

    return this.initialLastMessageId ?? -1;
  }

  @computed
  get isDisplayable() {
    return this.name.length > 0 && this.icon != null;
  }

  @computed
  get loaded() {
    return this.loadingState.metadata;
    // return this.loadingState.messages && this.loadingState.metadata;
  }

  get loading() {
    return this.loadingState.messages === false || this.loadingState.metadata === false;
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

  @action
  addMessages(messages: Message[], skipSort = false) {
    this.messages.push(...messages);

    if (!skipSort) {
      this.resortMessages();
    }
  }

  @action
  afterSendMesssage(message: Message, json: MessageJson | null) {
    if (json != null) {
      message.messageId = json.message_id;
      message.timestamp = json.timestamp;
      message.persist();
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
    if (this.newPmChannel || this.loading) return;

    // call load and then wait for ChatChannelJoin to arrive over the websocket.
    void this.loadMetadata();

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
      const response = await ChatApi.getMessages(this.channelId, { until });

      runInAction(() => {
        // TODO: something about User; map in api? or lazy load?
        const messages = response.map((messageJson) => Message.fromJson(messageJson));

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
  async loadMetadata() {
    if (this.loadingState.metadata != null) return;

    this.loadingState.metadata = false;

    try {
      const response = await ChatApi.getChannel(this.channelId);

      runInAction(() => {
        this.updateWithJson(response.channel);
        this.loadingState.metadata = true;
      });
    } catch {
      // TODO: revert state
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
  unload() {
    this.messages = observable([]);
  }

  @action
  updatePresence = (json: ChannelJson) => {
    this.updateWithJson(json);
    // clear flag otherwise presence updates might not close the channel when closed in a different window.
    if (this.newPmChannelTransient) {
      this.newPmChannelTransient = false;
    }

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

    this.initialLastMessageId = json.last_message_id ?? this.lastMessageId;

    if (json.current_user_attributes != null) {
      this.canMessage = json.current_user_attributes.can_message;
    }
  }

  @action
  private async refreshMessages() {
    if (!this.needsRefresh) return;

    this.loadingState.messages = false;

    let since: number | undefined;
    // no messages loaded but we know there's more
    // messages loaded but not enough
    if (this.messages.length > 0 && this.lastMessageId > 0) {
      since = this.lastMessageId;
    }

    try {
      const response = await ChatApi.getMessages(this.channelId, { since });

      runInAction(() => {
        // TODO: something about User; map in api? or lazy load?
        const messages = response.map((messageJson) => Message.fromJson(messageJson));
        this.addMessages(messages);

        this.needsRefresh = false;
        this.loadingState.messages = true;

        if (messages.length === 0 && since == null) {
          // assume no more messages.
          this.firstMessageId = this.minMessageId;
          return;
        }
      });
    } catch {
      // TODO: revert state
    }
  }

  @action
  private resortMessages() {
    this.messages = _(this.messages).sortBy('timestamp').uniqBy('messageId').value();
  }

  @action
  private setLastReadId(id: number) {
    if (id > (this.lastReadId ?? 0)) {
      this.lastReadId = id;
    }
  }
}
