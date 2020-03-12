// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import {
  ChatChannelSwitchAction,
  ChatMessageAddAction,
  ChatMessageSendAction,
  ChatMessageUpdateAction,
  ChatPresenceUpdateAction,
} from 'actions/chat-actions';
import DispatcherAction from 'actions/dispatcher-action';
import { WindowBlurAction, WindowFocusAction } from 'actions/window-focus-actions';
import { dispatch, dispatchListener } from 'app-dispatcher';
import DispatchListener from 'dispatch-listener';
import { transaction } from 'mobx';
import Message from 'models/chat/message';
import RootDataStore from 'stores/root-data-store';
import ChatAPI from './chat-api';
import { MessageJSON } from './chat-api-responses';

@dispatchListener
export default class ChatWorker implements DispatchListener {
  private api: ChatAPI;
  private pollingEnabled: boolean = true;
  private pollTime: number = 1000;
  private pollTimeIdle: number = 5000;
  private updateTimerId?: number;
  private updateXHR: boolean = false;
  private windowIsActive: boolean = true;

  constructor(private rootDataStore: RootDataStore) {
    this.api = new ChatAPI();
  }

  handleDispatchAction(action: DispatcherAction) {
    if (action instanceof ChatMessageSendAction) {
      this.sendMessage(action.message);
    } else if (action instanceof WindowFocusAction) {
      this.windowIsActive = true;
    } else if (action instanceof WindowBlurAction) {
      this.windowIsActive = false;
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
          return;
        }

        transaction(() => {
          updateJson.messages.forEach((message: MessageJSON) => {
            const newMessage = Message.fromJSON(message);
            newMessage.sender = this.rootDataStore.userStore.getOrCreate(message.sender_id, message.sender);
            dispatch(new ChatMessageAddAction(newMessage));
          });

          dispatch(new ChatPresenceUpdateAction(updateJson.presence));
        });
      })
      .catch((err) => {
        // silently ignore errors and continue polling
        this.updateXHR = false;
        if (this.pollingEnabled) {
          this.updateTimerId = Timeout.set(this.pollingTime(), this.pollForUpdates);
        }
      });
  }

  pollingTime(): number {
    return this.windowIsActive ? this.pollTime : this.pollTimeIdle;
  }

  sendMessage(message: Message) {
    const channelId = message.channelId;
    const channel = this.rootDataStore.channelStore.getOrCreate(channelId);

    if (channel.newChannel) {
      const users = channel.users.slice();
      const userId = users.find((user) => {
        return user !== currentUser.id;
      });

      if (!userId) {
        console.debug('sendMessage:: userId not found?? this shouldn\'t happen');
        return;
      }

      this.api.newConversation(userId, message.content, message.isAction)
        .then((response) => {
          const newId = response.new_channel_id;
          transaction(() => {
            this.rootDataStore.channelStore.channels.delete(channelId);
            this.rootDataStore.channelStore.updatePresence(response.presence);
            dispatch(new ChatChannelSwitchAction(newId));
          });
        })
        .catch(() => {
          message.errored = true;
          dispatch(new ChatMessageUpdateAction(message));
        });
    } else {
      this.api.sendMessage(channelId, message.content, message.isAction)
        .then((updateJson) => {
          if (updateJson) {
            message.messageId = updateJson.message_id;
          } else {
            message.errored = true;
          }
          dispatch(new ChatMessageUpdateAction(message));
        })
        .catch(() => {
          message.errored = true;
          dispatch(new ChatMessageUpdateAction(message));
        });
    }
  }

  startPolling() {
    if (!this.updateTimerId) {
      this.updateTimerId = Timeout.set(this.pollingTime(), this.pollForUpdates);
    }
  }

  stopPolling() {
    if (this.updateTimerId) {
      Timeout.clear(this.updateTimerId);
      this.updateTimerId = undefined;
      this.updateXHR = false;
    }
  }
}
