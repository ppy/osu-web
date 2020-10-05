// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import {
  ChatChannelLoadEarlierMessages,
  ChatChannelPartAction,
  ChatMessageSendAction,
  ChatMessageUpdateAction,
} from 'actions/chat-actions';
import ChatNewConversationAdded from 'actions/chat-new-conversation-added';
import DispatcherAction from 'actions/dispatcher-action';
import { UserLogoutAction } from 'actions/user-login-actions';
import { dispatch, dispatchListener } from 'app-dispatcher';
import ChatAPI from 'chat/chat-api';
import { ChannelJSON, GetUpdatesJSON, MessageJSON, PresenceJSON } from 'chat/chat-api-responses';
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
  get channelList() {
    return [...this.nonPmChannels, ...this.pmChannels];
  }

  @computed
  get maxMessageId() {
    const channelArray = Array.from(this.channels.toJS().values());
    const max = maxBy(channelArray, 'lastMessageId');

    return max == null ? -1 : max.lastMessageId;
  }

  @computed
  get nonPmChannels() {
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
  get pmChannels() {
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

  findPM(userId: number) {
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

  get(channelId: number) {
    return this.channels.get(channelId);
  }

  @action
  getOrCreate(channelId: number) {
    let channel = this.channels.get(channelId);

    if (!channel) {
      channel = new Channel(channelId);
      this.channels.set(channelId, channel);
    }

    return channel;
  }

  handleDispatchAction(event: DispatcherAction) {
    if (event instanceof ChatChannelLoadEarlierMessages) {
      this.handleChatChannelLoadEarlierMessages(event);
    } else if (event instanceof ChatChannelPartAction) {
      this.handleChatChannelPartAction(event);
    } else if (event instanceof ChatMessageSendAction) {
      this.handleChatMessageSendAction(event);
    } else if (event instanceof ChatMessageUpdateAction) {
      this.handleChatMessageUpdateAction(event);
    } else if (event instanceof UserLogoutAction) {
      this.handleUserLogoutAction(event);
    }
  }

  async loadChannel(channelId: number) {
    const channel = this.getOrCreate(channelId);
    if (channel.loading || channel.newPmChannel) {
      return Promise.resolve();
    }

    // current imlementation should always have this loaded already,
    // but future versions may skip having all the initial metadata on chat load.
    if (!channel.metaLoaded) {
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
      this.handleChatChannelNewMessages(channelId, response);
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
      if (channel.lastMessage?.sender.id === window.currentUser.id) {
        return;
      }

      this.api.markAsRead(channel.channelId, channel.lastMessageId);
    }, 1000);

    this.markingAsRead[channelId] = currentTimeout;
  }

  @action
  updateWithJson(updateJson: GetUpdatesJSON) {
    this.updateWithPresence(updateJson.presence);

    const messages = Message.parseJSON(updateJson.messages);
    // messages for channels that have been left is a payload problem.
    messages.forEach((message) => this.get(message.channelId)?.addMessages(message));

    // TODO: convert silence handling back to action when updating through websocket is figured out.
    const silencedUserIds = new Set<number>(updateJson.silences.map((json) => json.user_id));
    this.removePublicMessagesFromUserIds(silencedUserIds);
  }

  @action
  updateWithPresence(presence: PresenceJSON) {
    // update channel list
    presence.forEach((json) => {
      this.getOrCreate(json.channel_id).updatePresence(json);
    });

    // remove parted channels
    this.channels.forEach((channel) => {
      if (channel.newPmChannel) {
        return;
      }

      if (!presence.find((json) => json.channel_id === channel.channelId)) {
        this.channels.delete(channel.channelId);
      }
    });
  }

  @action
  private async handleChatChannelLoadEarlierMessages(event: ChatChannelLoadEarlierMessages) {
    const channelId = event.channelId;
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
      this.handleChatChannelNewMessages(channelId, response);
    } finally {
      runInAction(() => {
        channel.loadingEarlierMessages = false;
      });
    }
  }

  @action
  private handleChatChannelNewMessages(channelId: number, json: MessageJSON[]) {
    const messages = json.map((messageJson) => {
      if (messageJson.sender != null) this.userStore.getOrCreate(messageJson.sender_id, messageJson.sender);
      return Message.fromJSON(messageJson);
    });

    if (messages.length === 0) return;

    const channel = this.getOrCreate(channelId);
    channel.addMessages(messages);
    channel.loaded = true;
  }

  @action
  private handleChatChannelPartAction(event: ChatChannelPartAction) {
    if (event.channelId !== -1) {
      this.api.partChannel(event.channelId, window.currentUser.id);
    }

    this.channels.delete(event.channelId);
  }

  @action
  private async handleChatMessageSendAction(event: ChatMessageSendAction) {
    const message = event.message;
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
          dispatch(new ChatNewConversationAdded(newChannel.channelId));
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
  private handleChatMessageUpdateAction(event: ChatMessageUpdateAction) {
    const channel = this.getOrCreate(event.message.channelId);
    channel.updateMessage(event.message, event.json);
    channel.resortMessages();
  }

  @action
  private handleUserLogoutAction(event: UserLogoutAction) {
    this.flushStore();
  }

  @action
  private removePublicMessagesFromUserIds(userIds: Set<number>) {
    this.nonPmChannels.forEach((channel) => {
      channel.removeMessagesFromUserIds(userIds);
    });
  }
}
