/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import { ChatMessageAddAction, ChatMessageSendAction, ChatMessageUpdateAction } from 'actions/chat-actions';
import DispatcherAction from 'actions/dispatcher-action';
import DispatchListener from 'dispatch-listener';
import Dispatcher from 'dispatcher';
import {action, computed, observable} from 'mobx';
import Channel, { ChannelJSON } from 'models/chat/channel';
import Message from 'models/chat/message';
import RootDataStore from './root-data-store';

export default class ChannelStore implements DispatchListener {
  root: RootDataStore;

  @observable channels = observable.map<number, Channel>();
  @observable maxMessageId: number = 0;
  @observable loaded: boolean = false;

  constructor(root: RootDataStore, dispatcher: Dispatcher) {
    this.root = root;
    dispatcher.register(this);
  }

  handleDispatchAction(dispatchedAction: DispatcherAction) {
    if (dispatchedAction instanceof ChatMessageSendAction) {
      this.getOrCreate(dispatchedAction.message.channelId).addMessages(dispatchedAction.message, true);
    }

    if (dispatchedAction instanceof ChatMessageAddAction) {
      this.getOrCreate(dispatchedAction.message.channelId).addMessages(dispatchedAction.message);
    }

    if (dispatchedAction instanceof ChatMessageUpdateAction) {
      const channel: Channel = this.getOrCreate(dispatchedAction.message.channelId);
      channel.updateMessage(dispatchedAction.message);
      channel.resortMessages();
    }
  }

  getMaxId(): number {
    return this.maxMessageId;
  }

  @computed get
  sortedByPresence(): Channel[] {
    const sortedChannels: Channel[] = [];
    this.channels.forEach((channel, channelId) => {
      sortedChannels.push(channel);
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

  @action
  getOrCreate(channelId: number): Channel {
    let channel = this.channels.get(channelId);

    if (!channel) {
      channel = new Channel(channelId);
      this.channels.set(channelId, channel);
    }

    return channel;
  }

  findPM(userId: number): Channel | null {
    for (const [channelId, channel] of this.channels) {
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
  addMessages(channelId: number, messages: Message[]) {
    if (_.isEmpty(messages)) {
      return;
    }

    this.getOrCreate(channelId).addMessages(messages);

    const max: number = _.maxBy(messages, 'messageId').messageId;

    if (max > this.maxMessageId) {
      this.maxMessageId = max;
    }
  }

  @action
  updatePresence(presence: ChannelJSON[]) {
    presence.forEach((json) => {
      this.getOrCreate(json.channel_id).updatePresence(json);

      if (json.last_message_id > this.maxMessageId) {
        this.maxMessageId = json.last_message_id;
      }
    });

    this.loaded = true;
  }
}
