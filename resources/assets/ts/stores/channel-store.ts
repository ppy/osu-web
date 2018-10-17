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

import {observable, autorun, action, computed} from 'mobx';
import Channel, { ChannelJSON } from 'models/chat/channel';
import RootDataStore from './root-data-store';
import Message, { MessageJSON } from 'models/chat/message';
import Dispatcher from 'dispatcher';
import DispatcherAction from 'actions/dispatcher-action';
import DispatchListener from 'dispatch-listener';
import { ChatMessageSendAction, ChatMessageUpdateAction, ChatMessageAddAction } from 'actions/chat-actions';

export default class ChannelStore implements DispatchListener {
  parent: RootDataStore;

  @observable channels = observable.map<number, Channel>();
  @observable maxMessageId: number = 0;
  @observable loaded: boolean = false;

  constructor(root: RootDataStore, dispatcher: Dispatcher) {
    this.parent = root;
    dispatcher.register(this);
  }

  handleDispatchAction(action: DispatcherAction) {
    // console.log('ChannelStore::handleDispatchAction', action);

    if (action instanceof ChatMessageSendAction) {
      this.getOrCreate(action.message.channel.channel_id).addMessages(action.message, true);
    }

    if (action instanceof ChatMessageAddAction) {
      this.getOrCreate(action.message.channel.channel_id).addMessages(action.message);
    }

    if (action instanceof ChatMessageUpdateAction) {
      let channel: Channel = this.getOrCreate(action.message.channel.channel_id)
      channel.updateMessage(action.message);
      channel.resortMessages();
    }

  }

  getMaxId(): number {
    return this.maxMessageId;
  }

  @computed get
  sortedByPresence(): Array<Channel> {
    let sortedChannels: Array<Channel> = new Array<Channel>();
    this.channels.forEach((channel, channel_id) => {
      sortedChannels.push(channel);
    });

    return sortedChannels.sort((a, b) => {
      // so 'new' channels always end up on top
      if (a.newChannel) return -1;
      if (b.newChannel) return 1;

      if (a.last_message_id == b.last_message_id)
        return 0;

      return a.last_message_id > b.last_message_id ? -1 : 1;
    });
  }

  @action
  getOrCreate(channel_id: number) {
    if (!channel_id) {
      return;
    }

    let channel: Channel;

    if (this.channels.has(channel_id)) {
      channel = this.channels.get(channel_id);
    } else {
      channel = new Channel(channel_id);
      this.channels.set(channel_id, channel);
    }

    return channel;
  }

  findPM(user_id: number): Channel {
    for (let [channel_id, channel] of this.channels) {
      if (channel.type != 'PM') {
        continue;
      }

      if (channel.users.some((user) => { return user == user_id; })) {
        return channel;
      }
    }
  }

  @action
  addMessages(channel_id: number, messages: Array<Message>) {
    if (_.isEmpty(messages)) {
      return
    }

    this.getOrCreate(channel_id).addMessages(messages);

    let max: number = _.maxBy(messages, 'message_id').message_id;

    if (max > this.maxMessageId) {
      this.maxMessageId = max;
    }
  }

  @action
  updatePresence(presence: Array<ChannelJSON>) {
    console.log('ChannelStore::updatePresence', presence);
    presence.forEach(json => {
      this.getOrCreate(json.channel_id).updatePresence(json);

      if (json.last_message_id > this.maxMessageId) {
        this.maxMessageId = json.last_message_id;
      }
    });

    this.loaded = true;
  }
}
