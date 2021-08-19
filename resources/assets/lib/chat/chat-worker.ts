// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';
import { dispatch, dispatchListener } from 'app-dispatcher';
import ChatApi from 'chat/chat-api';
import { ChatChannelJoinEvent, ChatChannelPartEvent, ChatMessageNewEvent, isChannelEvent, isMessageEvent } from 'chat/chat-events';
import DispatchListener from 'dispatch-listener';
import { maxBy } from 'lodash';
import { transaction } from 'mobx';
import Channel from 'models/chat/channel';
import Message from 'models/chat/message';
import SocketMessageEvent, { SocketEventData } from 'socket-message-event';
import ChannelStore from 'stores/channel-store';

function newDispatchActionFromJson(json: SocketEventData) {
  if (isMessageEvent(json)) {
    switch (json.event) {
      case 'chat.message.new':
        return new ChatMessageNewEvent(Message.fromJson(json.data));
    }
  } else if (isChannelEvent(json)) {
    switch (json.event) {
      case 'chat.channel.join': {
        const channel = new Channel(json.data.channel_id);
        channel.updateWithJson(json.data);
        return new ChatChannelJoinEvent(channel);
      }
      case 'chat.channel.part':
        return new ChatChannelPartEvent(json.data.channel_id);
    }
  }
}

@dispatchListener
export default class ChatWorker implements DispatchListener {
  private lastHistoryId: number | null = null;

  constructor(private channelStore: ChannelStore) {
  }

  handleDispatchAction(event: DispatcherAction) {
    if (!(event instanceof SocketMessageEvent)) return;

    const dispatchAction = newDispatchActionFromJson(event.message);
    console.debug(dispatchAction);
    if (dispatchAction != null) {
      dispatch(dispatchAction);
    }
  }

  // FIXME: placeholder function
  update() {
    ChatApi.getUpdates(this.channelStore.lastPolledMessageId, this.lastHistoryId).then((updateJson) => {
      if (!updateJson) {
        return;
      }

      transaction(() => {
        const newHistoryId = maxBy(updateJson.silences, 'id')?.id;

        if (newHistoryId != null) {
          this.lastHistoryId = newHistoryId;
        }

        this.channelStore.updateWithJson(updateJson);
      });
    });
  }
}
