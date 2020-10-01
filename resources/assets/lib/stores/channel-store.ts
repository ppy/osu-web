// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import {
  ChatChannelDeletedAction,
  ChatChannelLoadEarlierMessages,
  ChatChannelNewMessages,
  ChatChannelPartAction,
  ChatChannelSelectAction,
  ChatMessageAddAction,
  ChatMessageSendAction,
  ChatMessageUpdateAction,
  ChatPresenceUpdateAction,
} from 'actions/chat-actions';
import DispatcherAction from 'actions/dispatcher-action';
import { UserLogoutAction } from 'actions/user-login-actions';
import UserSilenceAction from 'actions/user-silence-action';
import { dispatch, dispatchListener } from 'app-dispatcher';
import ChatAPI from 'chat/chat-api';
import { ChannelJSON, MessageJSON, PresenceJSON } from 'chat/chat-api-responses';
import { maxBy } from 'lodash';
import { action, computed, observable, runInAction } from 'mobx';
import Channel from 'models/chat/channel';
import Message from 'models/chat/message';
import core from 'osu-core-singleton';
import UserStore from 'stores/user-store';

@dispatchListener
export default class ChannelStore {
  @observable channels = observable.map<number, Channel>();
  private api = new ChatAPI();
  private markingAsRead: Record<number, number> = {};

  @computed
  get channelList(): Channel[] {
    return [...this.nonPmChannels, ...this.pmChannels];
  }

  @computed
  get maxMessageId(): number {
    const channelArray = Array.from(this.channels.toJS().values());
    const max = maxBy(channelArray, 'lastMessageId');

    return max == null ? -1 : max.lastMessageId;
  }

  @computed
  get nonPmChannels(): Channel[] {
    const sortedChannels: Channel[] = [];
    this.channels.forEach((channel) => {
      if (channel.type !== 'PM' && channel.metaLoaded) {
        sortedChannels.push(channel);
      }
    });

    return sortedChannels.sort((a, b) => {
      if (a.name === b.name) {
        return 0;
      }

      return a.name > b.name ? -1 : 1;
    });
  }

  @computed
  get pmChannels(): Channel[] {
    const sortedChannels: Channel[] = [];
    this.channels.forEach((channel) => {
      if (channel.newPmChannel || (channel.type === 'PM' && channel.metaLoaded)) {
        sortedChannels.push(channel);
      }
    });

    return sortedChannels.sort((a, b) => {
      // so 'new' channels always end up on top
      if (a.newPmChannel) return -1;
      if (b.newPmChannel) return 1;

      if (a.lastMessageId === b.lastMessageId) {
        return 0;
      }

      return a.lastMessageId > b.lastMessageId ? -1 : 1;
    });
  }

  constructor(protected userStore: UserStore) {
  }

  @action
  addNewConversation(json: ChannelJSON, message: MessageJSON) {
    const channel = this.getOrCreate(json.channel_id);
    channel.updateWithJson(json);
    channel.lastReadId = message.message_id;

    return channel;
  }

  findPM(userId: number): Channel | null {
    if (userId === core.currentUser?.id) {
      return null;
    }

    for (const [, channel] of this.channels) {
      if (channel.type !== 'PM') {
        continue;
      }

      if (channel.users.includes(userId)) {
        return channel;
      }
    }

    return null;
  }

  @action
  flushStore() {
    this.channels.clear();
  }

  get(channelId: number): Channel | undefined {
    return this.channels.get(channelId);
  }

  @action
  getOrCreate(channelId: number): Channel {
    let channel = this.channels.get(channelId);

    if (!channel) {
      channel = new Channel(channelId);
      this.channels.set(channelId, channel);
    }

    return channel;
  }

  handleDispatchAction(dispatchedAction: DispatcherAction) {
    if (dispatchedAction instanceof ChatChannelLoadEarlierMessages) {
      this.handleChatChannelLoadEarlierMessages(dispatchedAction);
    } else if (dispatchedAction instanceof ChatChannelNewMessages) {
      this.handleChatChannelNewMessages(dispatchedAction);
    } else if (dispatchedAction instanceof ChatChannelPartAction) {
      this.handleChatChannelPartAction(dispatchedAction);
    } else if (dispatchedAction instanceof ChatMessageSendAction) {
      this.handleChatMessageSendAction(dispatchedAction);
    } else if (dispatchedAction instanceof ChatMessageAddAction) {
      this.getOrCreate(dispatchedAction.message.channelId).addMessages(dispatchedAction.message);
    } else if (dispatchedAction instanceof ChatMessageUpdateAction) {
      const channel: Channel = this.getOrCreate(dispatchedAction.message.channelId);
      channel.updateMessage(dispatchedAction.message, dispatchedAction.json);
      channel.resortMessages();
    } else if (dispatchedAction instanceof ChatPresenceUpdateAction) {
      this.updatePresence(dispatchedAction.presence);
    } else if (dispatchedAction instanceof UserSilenceAction) {
      this.removePublicMessagesFromUser(dispatchedAction.userIds);
    } else if (dispatchedAction instanceof UserLogoutAction) {
      this.flushStore();
    }
  }

  async loadChannel(channelId: number) {
    const channel = this.getOrCreate(channelId);
    if (channel.loading || channel.newPmChannel) {
      return Promise.resolve();
    }

    if (!channel.metaLoaded) {
      console.debug(`loading metadata for channel ${channel.channelId}`);
      channel.loading = true;
      const json = await this.api.getChannel(channel.channelId);
      channel.updateWithJson(json);
    }

    if (channel.loaded) {
      return Promise.resolve();
    }

    channel.loading = true;

    try {
      const response = await this.api.getMessages(channelId);
      dispatch(new ChatChannelNewMessages(channelId, response));
    } finally {
      runInAction(() => {
        channel.loading = false;
      });
    }
  }

  @action
  markAsRead(channelId: number) {
    const channel = this.get(channelId);

    if (channel == null || !channel.isUnread) {
      return;
    }

    if (this.markingAsRead[channelId] != null) {
      return;
    }

    channel.markAsRead();

    const currentTimeout = window.setTimeout(() => {
      // allow next debounce to be queued again
      if (this.markingAsRead[channelId] === currentTimeout) {
        delete this.markingAsRead[channelId];
      }

      // TODO: need to mark again in case the marker has moved?

      // We don't need to send mark-as-read for our own messages, as the cursor is automatically bumped forward server-side when sending messages.
      const lastSentMessage = channel.messages[channel.messages.length - 1];
      if (lastSentMessage && lastSentMessage.sender.id === window.currentUser.id) {
        return;
      }

      this.api.markAsRead(channel.channelId, channel.lastMessageId);
    }, 1000);

    this.markingAsRead[channelId] = currentTimeout;
  }

  @action
  removePublicMessagesFromUser(userIds: Set<number>) {
    this.nonPmChannels.forEach((channel) => {
      channel.messages = channel.messages.filter((message) => !userIds.has(message.senderId));
    });
  }

  @action
  private delete(channelId: number) {
    if (this.channels.delete(channelId)) {
      dispatch(new ChatChannelDeletedAction(channelId));
    }
  }

  @action
  private async handleChatChannelLoadEarlierMessages(dispatchedAction: ChatChannelLoadEarlierMessages) {
    const channelId = dispatchedAction.channelId;
    const channel = this.get(channelId);

    if (channel == null || !channel.hasEarlierMessages || channel.loadingEarlierMessages) {
      return;
    }

    channel.loadingEarlierMessages = true;
    let until: number | undefined;
    // FIXME: nullable id instead?
    if (channel.minMessageId > 0) {
      until = channel.minMessageId;
    }

    try {
      const response = await this.api.getMessages(channel.channelId, { until });
      dispatch(new ChatChannelNewMessages(channelId, response));
    } finally {
      runInAction(() => {
        channel.loadingEarlierMessages = false;
      });
    }
  }

  @action
  private handleChatChannelNewMessages(dispatchedAction: ChatChannelNewMessages) {
    const messages = dispatchedAction.json.map((json) => {
      if (json.sender != null) this.userStore.getOrCreate(json.sender_id, json.sender);
      return Message.fromJSON(json);
    });

    if (messages.length === 0) return;

    const channel = this.getOrCreate(dispatchedAction.channelId);
    channel.addMessages(messages);
    channel.loaded = true;
  }

  @action
  private handleChatChannelPartAction(dispatchedAction: ChatChannelPartAction) {
    if (dispatchedAction.channelId !== -1) {
      this.api.partChannel(dispatchedAction.channelId, window.currentUser.id);
    }

    this.delete(dispatchedAction.channelId);
  }

  @action
  private async handleChatMessageSendAction(dispatchedAction: ChatMessageAddAction) {
    const message = dispatchedAction.message;
    const channel = this.getOrCreate(message.channelId);
    channel.addMessages(message, true);

    try {
      if (channel.newPmChannel) {
        const users = channel.users.slice();
        const userId = users.find((user) => {
          return user !== currentUser.id;
        });

        if (!userId) {
          console.debug('sendMessage:: userId not found?? this shouldn\'t happen');
          return;
        }

        const response = await this.api.newConversation(userId, message);

        runInAction(() => {
          this.channels.delete(message.channelId);
          const newChannel = this.addNewConversation(response.channel, response.message);
          dispatch(new ChatChannelSelectAction(newChannel.channelId));
        });
      } else {
        const response = await this.api.sendMessage(message);
        dispatch(new ChatMessageUpdateAction(message, response));
      }
    } catch {
      dispatch(new ChatMessageUpdateAction(message, null));
    }
  }

  @action
  private updatePresence(presence: PresenceJSON) {
    presence.forEach((json) => {
      this.getOrCreate(json.channel_id).updatePresence(json);
    });

    // remove parted channels
    this.channels.forEach((channel) => {
      if (channel.newPmChannel) {
        return;
      }

      if (!presence.find((json) => json.channel_id === channel.channelId)) {
        this.delete(channel.channelId);
      }
    });
  }
}
