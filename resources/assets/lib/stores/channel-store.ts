// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import {
  ChatMessageSendAction,
} from 'actions/chat-message-send-action';
import { ChatNewConversationAdded } from 'actions/chat-new-conversation-added';
import DispatcherAction from 'actions/dispatcher-action';
import { dispatch, dispatchListener } from 'app-dispatcher';
import { markAsRead as apiMarkAsRead, newConversation, partChannel as apiPartChannel, sendMessage } from 'chat/chat-api';
import { ChatMessageNewEvent } from 'chat/chat-events';
import DispatchListener from 'dispatch-listener';
import ChannelJson, { ChannelType } from 'interfaces/chat/channel-json';
import ChatUpdatesJson from 'interfaces/chat/chat-updates-json';
import MessageJson from 'interfaces/chat/message-json';
import { groupBy, maxBy } from 'lodash';
import { action, comparer, computed, makeObservable, observable, runInAction } from 'mobx';
import Channel from 'models/chat/channel';
import Message from 'models/chat/message';
import core from 'osu-core-singleton';

const skippedChannelTypes = new Set<ChannelType>(['MULTIPLAYER', 'TEMPORARY']);

@dispatchListener
export default class ChannelStore implements DispatchListener {
  @observable channels = observable.map<number, Channel>();
  lastReceivedMessageId = 0;

  private markingAsRead: Partial<Record<number, number>> = {};

  @computed
  get channelList(): Channel[] {
    return [...this.nonPmChannels, ...this.pmChannels];
  }

  @computed({ equals: comparer.shallow })
  get nonPmChannels(): Channel[] {
    const sortedChannels: Channel[] = [];
    this.channels.forEach((channel) => {
      if (channel.type !== 'PM' && channel.isDisplayable) {
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

  @computed({ equals: comparer.shallow })
  get pmChannels(): Channel[] {
    const sortedChannels: Channel[] = [];
    this.channels.forEach((channel) => {
      if (channel.newPmChannel || (channel.type === 'PM' && channel.isDisplayable)) {
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

  constructor() {
    makeObservable(this);
  }

  @action
  addNewConversation(json: ChannelJson, message: MessageJson) {
    const channel = this.getOrCreate(json.channel_id);
    channel.updateWithJson(json);
    // TODO: need to handle user
    channel.addMessages([Message.fromJson(message)]);

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

  handleDispatchAction(event: DispatcherAction) {
    if (event instanceof ChatMessageNewEvent) {
      this.handleChatMessageNewEvent(event);
    } else if (event instanceof ChatMessageSendAction) {
      this.handleChatMessageSendAction(event);
    }
  }

  // TODO: load is async, needs to be reflected somewhere.
  @action
  loadChannel(channelId: number) {
    this.channels.get(channelId)?.load();
  }

  @action
  loadChannelEarlierMessages(channelId: number) {
    const channel = this.get(channelId);

    if (channel != null) {
      void channel.loadEarlierMessages();
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

    const currentTimeout = window.setTimeout(action(() => {
      // allow next debounce to be queued again
      if (this.markingAsRead[channelId] === currentTimeout) {
        delete this.markingAsRead[channelId];
      }

      // TODO: need to mark again in case the marker has moved?

      // We don't need to send mark-as-read for our own messages, as the cursor is automatically bumped forward server-side when sending messages.
      if (channel.lastMessage?.sender.id === window.currentUser.id) {
        return;
      }

      apiMarkAsRead(channel.channelId, channel.lastMessageId);
    }), 1000);

    this.markingAsRead[channelId] = currentTimeout;
  }

  @action
  partChannel(channelId: number, remote = true) {
    if (channelId > 0 && remote) {
      apiPartChannel(channelId, window.currentUser.id);
    }

    this.channels.delete(channelId);
  }

  @action
  updateWithJson(updateJson: ChatUpdatesJson) {
    if (updateJson.presence != null) {
      this.updateWithPresence(updateJson.presence);
    }

    if (updateJson.messages != null) {
      this.updateLastReceivedMessageId(updateJson.messages);

      const groups = groupBy(updateJson.messages, 'channel_id');
      for (const key of Object.keys(groups)) {
        const channelId = parseInt(key, 10);
        const messages = groups[channelId].map(Message.fromJson);
        this.channels.get(channelId)?.addMessages(messages);
      }
    }

    if (updateJson.silences != null) {
      // TODO: convert silence handling back to action when updating through websocket is figured out.
      const silencedUserIds = new Set<number>(updateJson.silences.map((json) => json.user_id));
      this.removePublicMessagesFromUserIds(silencedUserIds);
    }
  }

  @action
  updateWithPresence(presence: ChannelJson[]) {
    presence.forEach((json) => {
      if (!skippedChannelTypes.has(json.type)) {
        this.getOrCreate(json.channel_id).updatePresence(json);
      }
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
  private handleChatMessageNewEvent(event: ChatMessageNewEvent) {
    for (const message of event.json.messages) {
      const channel = this.channels.get(message.channel_id);
      if (channel == null) continue;

      channel.addMessage(message);
    }

    this.updateLastReceivedMessageId(event.json.messages);
  }

  @action
  private async handleChatMessageSendAction(event: ChatMessageSendAction) {
    const message = event.message;
    const channel = this.getOrCreate(message.channelId);
    channel.addSendingMessage(message);

    try {
      if (channel.newPmChannel) {
        const users = channel.users.slice();
        const userId = users.find((user) => user !== currentUser.id);

        if (userId == null) {
          console.debug('sendMessage:: userId not found?? this shouldn\'t happen');
          return;
        }

        const response = await newConversation(userId, message);
        runInAction(() => {
          this.channels.delete(message.channelId);
          const newChannel = this.addNewConversation(response.channel, response.message);
          dispatch(new ChatNewConversationAdded(newChannel.channelId));
        });
      } else {
        const response = await sendMessage(message);
        channel.afterSendMesssage(message, response);
      }
    } catch (error) {
      channel.afterSendMesssage(message, null);
      // FIXME: this seems like the wrong place to tigger an error popup.
      osu.ajaxError(error);
    }
  }

  @action
  private removePublicMessagesFromUserIds(userIds: Set<number>) {
    this.nonPmChannels.forEach((channel) => {
      channel.removeMessagesFromUserIds(userIds);
    });
  }

  @action
  private updateLastReceivedMessageId(json?: MessageJson[]) {
    if (json == null) return;

    this.lastReceivedMessageId = maxBy(json, 'message_id')?.message_id ?? this.lastReceivedMessageId;
  }
}
