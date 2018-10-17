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
import {ChatChannelSwitchAction, ChatMessageSendAction, ChatMessageUpdateAction, ChatMessageAddAction} from 'actions/chat-actions';
import Message, { MessageJSON } from 'models/chat/message';
import Channel from 'models/chat/channel';
import ChatAPI from './chat-api';
import { transaction } from 'mobx';
import { WindowFocusAction, WindowBlurAction } from 'actions/window-focus-actions';

export default class ChatWorker implements DispatchListener {
  private dispatcher: Dispatcher;
  private rootDataStore: RootDataStore;

  private pollingEnabled: boolean = true;
  private pollTime: number = 1000;
  private pollTimeIdle: number = 5000;
  private windowIsActive: boolean = true;

  private updateTimerId: number;

  private api: ChatAPI;

  private updateXHR;

  constructor(dispatcher: Dispatcher, rootDataStore: RootDataStore) {
    this.dispatcher = dispatcher;
    this.rootDataStore = rootDataStore;
    this.dispatcher.register(this);
    this.api = new ChatAPI();

    this.startPolling();
  }

  handleDispatchAction(action: DispatcherAction) {
    if (action instanceof ChatMessageSendAction) {
      this.sendMessage(action.message);
    }

    if (action instanceof WindowFocusAction) {
      this.windowActive();
    }

    if (action instanceof WindowBlurAction) {
      this.windowIdle();
    }
  }

  markAsRead(channel_id: number) {
    let channel: Channel = this.rootDataStore.channelStore.getOrCreate(channel_id);
    let last_read: number = channel.last_message_id;


    if (!last_read || channel.last_read_id >= last_read) {
      console.log('markAsRead', 'up to date, doing nothing')
      return
    }
    console.group('markAsRead', channel.channel_id, last_read, '=>', channel.last_read_id)

    this.api.markAsRead(channel.channel_id, last_read)
      .then(() => {
        channel.last_read_id = last_read;
      })
      .catch((err) => {
        console.log('error idk', err);
      })
  }

  addMessages(channel_id: number, messages: MessageJSON[]) {
    let newMessages: Message[] = [];

    transaction(() => {
      _.forEach(messages, (json) => {
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
    let channel_id: number = channel.channel_id;

    if (channel.newChannel) {
      let users = channel.users.slice();
      let userId = users.find((user) => {
        return user != currentUser.id;
      });

      console.log('api.createChannel(',userId,', ',message,')')
      this.api.createChannel(userId, message.content)
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
      this.api.postMessage(channel_id, message.content)
        .then((updateJson) => {
          if (updateJson) {
            message.message_id = updateJson.message_id;
          } else {
            message.errored = true;
          }
          this.dispatcher.dispatch(new ChatMessageUpdateAction(message));
        })
        .catch((err) => {
          message.errored = true;
          this.dispatcher.dispatch(new ChatMessageUpdateAction(message));
        });
    }
  }

  pollForUpdates = () => {
    if (this.updateXHR) {
      return;
    }
    this.updateXHR = true;

    this.api.getUpdates(this.rootDataStore.channelStore.maxMessageId)
    .then((updateJson) => {
      this.updateXHR = false;
      if (this.pollingEnabled) {
        this.updateTimerId = Timeout.set(this.pollingTime(), this.pollForUpdates);
      }

      if (!updateJson) {
        return
      }

      transaction(() => {
        _.forEach(updateJson.messages, (message: MessageJSON) => {

          let newMessage = Message.fromJSON(message);
          newMessage.channel = this.rootDataStore.channelStore.getOrCreate(message.channel_id);
          newMessage.sender = this.rootDataStore.userStore.getOrCreate(message.sender_id, message.sender);
          this.dispatcher.dispatch(new ChatMessageAddAction(newMessage));
        });

        this.rootDataStore.channelStore.updatePresence(updateJson.presence);
      });
    })
    .catch((err) => {
      console.log('error idk', err);
      this.updateXHR = false;
      if (this.pollingEnabled) {
        this.updateTimerId = Timeout.set(this.pollingTime(), this.pollForUpdates);
      }
    });
  }

  startPolling() {
    if (!this.updateTimerId) {
      this.updateTimerId = Timeout.set(this.pollingTime(), this.pollForUpdates);
    }
  }

  pollingTime(): number {
    return this.windowIsActive ? this.pollTime : this.pollTimeIdle;
  }

  stopPolling() {
    if (this.updateTimerId) {
      Timeout.clear(this.updateTimerId);
      this.updateTimerId = null;
      this.updateXHR = false;
    }
  }

  windowIdle = () => {
    this.windowIsActive = false;
  }

  windowActive = () => {
    this.windowIsActive = true;
  }
}
