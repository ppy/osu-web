// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import {
  ChatChannelPartAction,
  ChatMessageAddAction,
  ChatMessageSendAction,
  ChatMessageUpdateAction,
  ChatPresenceUpdateAction,
} from 'actions/chat-actions';
import DispatcherAction from 'actions/dispatcher-action';
import { UserLogoutAction } from 'actions/user-login-actions';
import UserSilenceAction from 'actions/user-silence-action';
import { dispatch, dispatchListener } from 'app-dispatcher';
import { ChannelJSON, MessageJSON, PresenceJSON } from 'chat/chat-api-responses';
import * as _ from 'lodash';
import { action, computed, observable } from 'mobx';
import Channel from 'models/chat/channel';
import Message from 'models/chat/message';
import core from 'osu-core-singleton';
import UserStore from './user-store';

@dispatchListener
export default class ChannelStore {
  @observable channels = observable.map<number, Channel>();
  lastHistoryId: number | null = null;
  @observable loaded: boolean = false;

  @computed
  get channelList(): Channel[] {
    return [...this.nonPmChannels, ...this.pmChannels];
  }

  @computed
  get maxMessageId(): number {
    const channelArray = Array.from(this.channels.toJS().values());
    const max = _.maxBy(channelArray, 'lastMessageId');

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
      if (channel.newChannel || (channel.type === 'PM' && channel.metaLoaded)) {
        sortedChannels.push(channel);
      }
    });

    return sortedChannels.sort((a, b) => {
      // so 'new' channels always end up on top
      if (a.newChannel) return -1;
      if (b.newChannel) return 1;

      if (a.lastMessageId === b.lastMessageId) {
        return 0;
      }

      return a.lastMessageId > b.lastMessageId ? -1 : 1;
    });
  }

  constructor(protected userStore: UserStore) {
  }

  @action
  addMessages(channelId: number, messages: Message[]) {
    if (_.isEmpty(messages)) {
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

    // tslint:disable-next-line:prefer-const browsers that support ES6 but not const in for...of
    for (let [, channel] of this.channels) {
      if (channel.type !== 'PM') {
        continue;
      }

      if (channel.users.some((user) => user === userId)) {
        return channel;
      }
    }

    return null;
  }

  @action
  flushStore() {
    this.channels = observable.map<number, Channel>();
    this.loaded = false;
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
    if (event instanceof ChatMessageSendAction) {
      this.getOrCreate(event.message.channelId).addMessages(event.message, true);
    } else if (event instanceof ChatMessageAddAction) {
      this.getOrCreate(event.message.channelId).addMessages(event.message);
    } else if (event instanceof ChatMessageUpdateAction) {
      const channel: Channel = this.getOrCreate(event.message.channelId);
      channel.updateMessage(event.message, event.json);
      channel.resortMessages();
    } else if (event instanceof ChatPresenceUpdateAction) {
      this.updatePresence(event.presence);
    } else if (event instanceof UserSilenceAction) {
      this.removePublicMessagesFromUser(event.userIds);
    } else if (event instanceof UserLogoutAction) {
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
      channel.messages = channel.messages.filter((message) => !userIds.has(message.sender.id));
    });
  }

  @action
  updatePresence(presence: PresenceJSON) {
    presence.forEach((json) => {
      this.getOrCreate(json.channel_id).updatePresence(json);
    });

    // remove parted channels
    this.channels.forEach((channel) => {
      if (channel.newChannel) {
        return;
      }

      if (!presence.find((json) => json.channel_id === channel.channelId)) {
        dispatch(new ChatChannelPartAction(channel.channelId, false));
      }
    });

    this.loaded = true;
  }
}
