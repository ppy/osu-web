// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ChatMessageSendAction } from 'actions/chat-message-send-action';
import { ChatNewConversationAdded } from 'actions/chat-new-conversation-added';
import ChatUpdateSilences from 'actions/chat-update-silences';
import DispatcherAction from 'actions/dispatcher-action';
import { dispatch, dispatchListener } from 'app-dispatcher';
import { getChannel, newConversation, partChannel as apiPartChannel, sendMessage } from 'chat/chat-api';
import MessageNewEvent from 'chat/message-new-event';
import DispatchListener from 'dispatch-listener';
import ChannelJson, { filterSupportedChannelTypes, SupportedChannelType, supportedChannelTypes } from 'interfaces/chat/channel-json';
import ChatUpdatesJson from 'interfaces/chat/chat-updates-json';
import MessageJson from 'interfaces/chat/message-json';
import { groupBy, maxBy } from 'lodash';
import { action, computed, makeObservable, observable, runInAction } from 'mobx';
import Channel from 'models/chat/channel';
import Message from 'models/chat/message';
import core from 'osu-core-singleton';
import { isJqXHR, onError } from 'utils/ajax';

function alphabeticalSort(a: Channel, b: Channel) {
  return a.name.localeCompare(b.name);
}

function makeEmptyGroupedChannels() {
  const empty: Partial<Record<SupportedChannelType, Channel[]>> = {};
  for (const type of supportedChannelTypes) {
    empty[type] = [];
  }

  return empty as Record<SupportedChannelType, Channel[]>;
}

const channelSorts = {
  ANNOUNCE: alphabeticalSort,
  GROUP: alphabeticalSort,
  PM: (a: Channel, b: Channel) => {
    // so 'new' channels always end up on top
    if (a.newPmChannel) return -1;
    if (b.newPmChannel) return 1;

    if (a.lastMessageId === b.lastMessageId) {
      return 0;
    }

    return a.lastMessageId > b.lastMessageId ? -1 : 1;
  },
  PUBLIC: alphabeticalSort,
};

@dispatchListener
export default class ChannelStore implements DispatchListener {
  @observable channels = observable.map<number, Channel>();
  lastReceivedMessageId = 0;

  // list of channels to temporarily ignore incoming messages from because we just left them.
  private ignoredChannels = new Set<number>();

  @computed
  get groupedChannels() {
    const grouped = makeEmptyGroupedChannels();
    // fill
    for (const channel of this.channels.values()) {
      if (channel.supportedType != null) {
        grouped[channel.supportedType].push(channel);
      }
    }

    // sort
    for (const key of supportedChannelTypes) {
      grouped[key] = grouped[key].sort(channelSorts[key]);
    }

    return grouped;
  }

  constructor() {
    makeObservable(this);
  }

  @action
  addNewConversation(json: ChannelJson, message: MessageJson) {
    const channel = this.update(json);
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

      if (channel.userIds.includes(userId)) {
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

  handleDispatchAction(event: DispatcherAction) {
    if (event instanceof MessageNewEvent) {
      this.handleChatMessageNewEvent(event);
    } else if (event instanceof ChatMessageSendAction) {
      this.handleChatMessageSendAction(event);
    } else if (event instanceof ChatUpdateSilences) {
      this.handleChatUpdateSilences(event);
    }
  }

  // TODO: load is async, needs to be reflected somewhere.
  @action
  loadChannel(channelId: number) {
    this.channels.get(channelId)?.load();
  }

  @action
  loadChannelEarlierMessages(channelId: number) {
    this.get(channelId)?.loadEarlierMessages();
  }

  @action
  partChannel(channelId: number, sync = true) {
    const channel = this.get(channelId);
    if (channel == null) return;

    // channelId <= 0 are local only channels, no need to make an api call.
    if (channelId > 0 && sync) {
      // tabs parting channel via received chat.channel.part message shouldn't need to ignore channels
      // since the order of events in that case should match the backend's...in theory.
      if (!channel.isHideable) {
        this.ignoredChannels.add(channelId);
      }

      apiPartChannel(channelId, core.currentUserOrFail.id)
        // unignore even on failure, could be failed to leave or success but timeout.
        .always(() => this.ignoredChannels.delete(channelId));
    }

    this.channels.delete(channelId);
  }

  @action
  update(json: ChannelJson): Channel {
    const channelId = json.channel_id;
    let channel = this.channels.get(channelId);

    if (!channel) {
      channel = new Channel(channelId);
      this.channels.set(channelId, channel);
    }

    channel.updateWithJson(json);
    this.ignoredChannels.delete(channelId);
    return channel;
  }

  @action
  updateMany(data: ChannelJson[]) {
    this.ignoredChannels.clear();

    filterSupportedChannelTypes(data).forEach((json) => {
      this.update(json);
    });

    // remove parted channels
    this.channels.forEach((channel) => {
      if (channel.newPmChannel) {
        return;
      }

      if (!data.find((json) => json.channel_id === channel.channelId)) {
        this.channels.delete(channel.channelId);
      }
    });
  }

  @action
  updateWithChatUpdates(updateJson: ChatUpdatesJson) {
    if (updateJson.presence != null) {
      this.updateMany(updateJson.presence);
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
      dispatch(new ChatUpdateSilences(updateJson.silences));
    }
  }

  @action
  private async handleChatMessageNewEvent(event: MessageNewEvent) {
    for (const message of event.json.messages) {
      const channel = this.channels.get(message.channel_id);

      if (channel != null) {
        channel.addMessage(message);
      } else if (!this.ignoredChannels.has(message.channel_id)) {
        try {
          const json = await getChannel(message.channel_id);
          this.update(json);
        } catch (error) {
          if (!isJqXHR(error)) throw error;
          // FIXME: this seems like the wrong place to trigger an error popup.
          if (error.status !== 404) {
            onError(error);
          }
        }
      }
    }

    this.updateLastReceivedMessageId(event.json.messages);
  }

  @action
  private async handleChatMessageSendAction(event: ChatMessageSendAction) {
    const message = event.message;
    const channel = this.get(message.channelId);
    if (channel == null) {
      console.debug('channel missing');
      return;
    }

    channel.addSendingMessage(message);

    try {
      if (channel.newPmChannel) {
        const userId = channel.pmTarget;

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
      // FIXME: this seems like the wrong place to trigger an error popup.
      if (!isJqXHR(error)) throw error;
      onError(error);
    }
  }

  @action
  private handleChatUpdateSilences(event: ChatUpdateSilences) {
    const silencedUserIds = new Set<number>(event.json.map((json) => json.user_id));
    this.removePublicMessagesFromUserIds(silencedUserIds);
  }

  @action
  private removePublicMessagesFromUserIds(userIds: Set<number>) {
    this.groupedChannels.PUBLIC.forEach((channel) => {
      channel.removeMessagesFromUserIds(userIds);
    });
  }

  @action
  private updateLastReceivedMessageId(json?: MessageJson[]) {
    if (json == null) return;

    this.lastReceivedMessageId = maxBy(json, 'message_id')?.message_id ?? this.lastReceivedMessageId;
  }
}
