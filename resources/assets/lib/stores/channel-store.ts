// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import {
  ChatChannelDeletedAction,
  ChatChannelPartAction,
  ChatChannelSwitchAction,
  ChatMessageAddAction,
  ChatMessageSendAction,
  ChatMessageUpdateAction,
  ChatNewConversation,
  ChatPresenceUpdateAction,
} from 'actions/chat-actions';
import DispatcherAction from 'actions/dispatcher-action';
import { UserLogoutAction } from 'actions/user-login-actions';
import UserSilenceAction from 'actions/user-silence-action';
import { dispatch, dispatchListener } from 'app-dispatcher';
import ChatAPI from 'chat/chat-api';
import { ChannelJSON, MessageJSON, PresenceJSON } from 'chat/chat-api-responses';
import { maxBy } from 'lodash';
import { action, computed, observable } from 'mobx';
import Channel from 'models/chat/channel';
import Message from 'models/chat/message';
import core from 'osu-core-singleton';
import Store from 'stores/store';

@dispatchListener
export default class ChannelStore extends Store {
  @observable channels = observable.map<number, Channel>();
  private api = new ChatAPI();

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

  @action
  addMessages(channelId: number, messages: Message[]) {
    if (messages.length === 0) {
      return;
    }

    this.getOrCreate(channelId).addMessages(messages);
  }

  @action
  addNewConversation(json: ChannelJSON, message: MessageJSON) {
    const channel = this.getOrCreate(json.channel_id);
    channel.updateWithJson(json);
    channel.lastReadId = message.message_id;
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
    if (dispatchedAction instanceof ChatChannelPartAction) {
      this.handleChatChannelPartAction(dispatchedAction);
    } else if (dispatchedAction instanceof ChatMessageSendAction) {
      this.handleChatMessageSendAction(dispatchedAction);
    } else if (dispatchedAction instanceof ChatMessageAddAction) {
      this.getOrCreate(dispatchedAction.message.channelId).addMessages(dispatchedAction.message);
    } else if (dispatchedAction instanceof ChatMessageUpdateAction) {
      const channel: Channel = this.getOrCreate(dispatchedAction.message.channelId);
      channel.updateMessage(dispatchedAction.message, dispatchedAction.json);
      channel.resortMessages();
    } else if (dispatchedAction instanceof ChatNewConversation) {
      this.handleChatNewConversation(dispatchedAction);
    } else if (dispatchedAction instanceof ChatPresenceUpdateAction) {
      this.updatePresence(dispatchedAction.presence);
    } else if (dispatchedAction instanceof UserSilenceAction) {
      this.removePublicMessagesFromUser(dispatchedAction.userIds);
    } else if (dispatchedAction instanceof UserLogoutAction) {
      this.flushStore();
    }
  }

  @action
  partChannel(channelId: number) {
    this.channels.delete(channelId);
  }

  @action
  removePublicMessagesFromUser(userIds: Set<number>) {
    this.nonPmChannels.forEach((channel) => {
      channel.messages = channel.messages.filter((message) => !userIds.has(message.senderId));
    });
  }

  @action
  private handleChatChannelPartAction(dispatchedAction: ChatChannelPartAction) {
    if (this.channels.delete(dispatchedAction.channelId)) {
      dispatch(new ChatChannelDeletedAction(dispatchedAction.channelId));
    }
  }

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
        dispatch(new ChatNewConversation(response.channel, response.message, message.channelId));
      } else {
        const response = await this.api.sendMessage(message);
        dispatch(new ChatMessageUpdateAction(message, response));
      }
    } catch {
      dispatch(new ChatMessageUpdateAction(message, null));
    }
  }

  @action
  private handleChatNewConversation(dispatchedAction: ChatNewConversation) {
    this.channels.delete(dispatchedAction.tempChannelId);
    this.addNewConversation(dispatchedAction.channel, dispatchedAction.message);
    dispatch(new ChatChannelSwitchAction(dispatchedAction.channel.channel_id));
    dispatch(new ChatChannelPartAction(dispatchedAction.tempChannelId));
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
        dispatch(new ChatChannelPartAction(channel.channelId, false));
      }
    });
  }
}
