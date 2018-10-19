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

import RootDataStore from 'stores/root-data-store';
import Dispatcher from 'dispatcher';
import DispatchListener from 'dispatch-listener';
import DispatcherAction from 'actions/dispatcher-action';
import {ChatChannelSwitchAction, ChatMessageUpdateAction} from 'actions/chat-actions';
import Message, { MessageJSON } from 'models/chat/message';
import Channel from 'models/chat/channel';
import ChatAPI from './chat-api';
import { transaction } from 'mobx';
import { WindowFocusAction, WindowBlurAction } from 'actions/window-focus-actions';

export default class ChatOrchestrator implements DispatchListener {
  private dispatcher: Dispatcher;
  private rootDataStore: RootDataStore;

  private windowIsActive: boolean = true;

  private api: ChatAPI;

  constructor(dispatcher: Dispatcher, rootDataStore: RootDataStore) {
    this.dispatcher = dispatcher;
    this.rootDataStore = rootDataStore;
    this.dispatcher.register(this);
    this.api = new ChatAPI();
  }

  handleDispatchAction(action: DispatcherAction) {
    if (action instanceof ChatChannelSwitchAction) {
      this.changeChannel(action.channelId);
    }

    if (action instanceof ChatChannelSwitchAction) {
      this.changeChannel(action.channelId);
    }

    if (action instanceof WindowFocusAction) {
      this.windowActive();
    }

    if (action instanceof WindowBlurAction) {
      this.windowIdle();
    }
  }

  changeChannel(channelId: number) {
    let uiState = this.rootDataStore.uiState.chat;
    if (channelId == uiState.selected) {
      return;
    }

    let channelStore = this.rootDataStore.channelStore;
    transaction(() => {
      let channel = channelStore.getOrCreate(channelId);

      if (!channel.newChannel) {
        if (channel.loaded) {
          this.markAsRead(channelId);
        } else {
          console.log('loading', channelId)
          this.loadChannel(channelId)
            .then(() => {
              if (this.windowIsActive) {
                this.markAsRead(channelId);
              }
            });
        }
      }

      this.rootDataStore.uiState.chat.selected = channelId;
    });
  }

  markAsRead(channel_id: number) {
    let channel: Channel = this.rootDataStore.channelStore.getOrCreate(channel_id);
    let lastRead: number = channel.lastMessageId;


    if (!lastRead || channel.lastReadId >= lastRead) {
      console.log('markAsRead', 'up to date, doing nothing')
      return
    }
    console.group('markAsRead', channel.channelId, lastRead, '=>', channel.lastReadId)

    this.api.markAsRead(channel.channelId, lastRead)
      .then(() => {
        channel.lastReadId = lastRead;
      })
      .catch((err) => {
        console.log('error idk', err);
      })
  }

  loadChannel(channelId: number): Promise<void> {
    let channel: Channel = this.rootDataStore.channelStore.getOrCreate(channelId);

    if (channel.loading) {
      console.log('loadChannel:: already loading', channel)

      return Promise.resolve();
    }

    channel.loading = true;

    return this.api.getMessages(channelId)
      .then((messages) => {
        this.addMessages(channelId, messages);
        channel.loading = false;
        channel.loaded = true;
      })
      .catch((err) => {
        console.log('error idk', err);
      })
  }

  addMessages(channel_id: number, messages: MessageJSON[]) {
    let newMessages: Message[] = [];

    transaction(() => {
      _.forEach(messages, (json: MessageJSON) => {
        let newMessage: Message = Message.fromJSON(json);
        newMessage.sender = this.rootDataStore.userStore.getOrCreate(json.sender_id, json.sender);
        // newMessage.channel = this.rootDataStore.channelStore.getOrCreate(json.channel_id);
        newMessages.push(newMessage);
      });

      this.rootDataStore.channelStore.addMessages(channel_id, newMessages)
    });
  }

  sendMessage(message: Message) {
    console.log('ChatOrchestrator::sendMessage', message);

    let channel: Channel = message.channel;
    let channel_id: number = channel.channelId;

    if (channel.newChannel) {
      let users = channel.users.slice();
      let userId = users.find((user) => {
        return user != currentUser.id;
      });

      if (!userId) {
        return;
      }

      console.log('api.createChannel(',userId,', ',message,')')
      this.api.newConversation(userId, message.content)
        .then((response) => {
          console.log('api.createChannel ->', response);
          let new_id = response.new_channel_id;
          transaction(() => {
            this.rootDataStore.channelStore.channels.delete(channel_id);
            // this.rootDataStore.channelStore.updatePresence(response.presence);
            this.dispatcher.dispatch(new ChatChannelSwitchAction(new_id));
          });
        });
    } else {
      this.api.sendMessage(channel_id, message.content)
        .then((updateJson) => {
          if (updateJson) {
            message.messageId = updateJson.message_id;
          } else {
            message.errored = true;
          }
          this.dispatcher.dispatch(new ChatMessageUpdateAction(message));
        })
        .catch(() => {
            message.errored = true;
            this.dispatcher.dispatch(new ChatMessageUpdateAction(message));
          });
    }
  }

  windowIdle = () => {
    this.windowIsActive = false;
  }

  windowActive = () => {
    this.windowIsActive = true;
  }
}
