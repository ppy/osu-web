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

import {ChatChannelSwitchAction, ChatMessageUpdateAction} from 'actions/chat-actions';
import DispatcherAction from 'actions/dispatcher-action';
import { WindowBlurAction, WindowFocusAction } from 'actions/window-focus-actions';
import DispatchListener from 'dispatch-listener';
import Dispatcher from 'dispatcher';
import { transaction } from 'mobx';
import Channel from 'models/chat/channel';
import Message, { MessageJSON } from 'models/chat/message';
import RootDataStore from 'stores/root-data-store';
import ChatAPI from './chat-api';

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

    if (action instanceof WindowFocusAction) {
      this.windowActive();
      this.markAsRead(this.rootDataStore.uiState.chat.selected);
    }

    if (action instanceof WindowBlurAction) {
      this.windowIdle();
    }
  }

  changeChannel(channelId: number) {
    const uiState = this.rootDataStore.uiState.chat;
    if (channelId === uiState.selected) {
      return;
    }

    const channelStore = this.rootDataStore.channelStore;
    transaction(() => {
      const channel = channelStore.getOrCreate(channelId);

      if (!channel.newChannel) {
        if (channel.loaded) {
          this.markAsRead(channelId);
        } else {
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

  markAsRead(channelId: number) {
    const channel: Channel = this.rootDataStore.channelStore.getOrCreate(channelId);
    const lastRead: number = channel.lastMessageId;

    if (!lastRead || channel.lastReadId >= lastRead) {
      return;
    }

    this.api.markAsRead(channel.channelId, lastRead)
      .then(() => {
        channel.lastReadId = lastRead;
      })
      .catch((err) => {
        console.debug('markAsRead error', err);
      });
  }

  loadChannel(channelId: number): Promise<void> {
    const channel: Channel = this.rootDataStore.channelStore.getOrCreate(channelId);

    if (channel.loading) {
      return Promise.resolve();
    }

    channel.loading = true;

    return this.api.getMessages(channelId)
      .then((messages) => {
        transaction(() => {
          this.addMessages(channelId, messages);
          channel.loading = false;
          channel.loaded = true;
        });
      })
      .catch((err) => {
        console.debug('loadChannel error', err);
      });
  }

  addMessages(channelId: number, messages: MessageJSON[]) {
    const newMessages: Message[] = [];

    transaction(() => {
      _.forEach(messages, (json: MessageJSON) => {
        const newMessage: Message = Message.fromJSON(json);
        newMessage.sender = this.rootDataStore.userStore.getOrCreate(json.sender_id, json.sender);
        newMessages.push(newMessage);
      });

      this.rootDataStore.channelStore.addMessages(channelId, newMessages);
    });
  }

  windowIdle = () => {
    this.windowIsActive = false;
  }

  windowActive = () => {
    this.windowIsActive = true;
  }
}
