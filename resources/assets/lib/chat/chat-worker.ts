// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';
import { dispatch, dispatchListener } from 'app-dispatcher';
import { ChatChannelJoinEvent, ChatChannelPartEvent, ChatMessageNewEvent, isChannelEvent, isMessageEvent } from 'chat/chat-events';
import DispatchListener from 'dispatch-listener';
import Channel from 'models/chat/channel';
import SocketMessageEvent, { SocketEventData } from 'socket-message-event';

function newDispatchActionFromJson(json: SocketEventData) {
  if (isMessageEvent(json)) {
    switch (json.event) {
      case 'chat.message.new':
        return new ChatMessageNewEvent(json.data);
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
  handleDispatchAction(event: DispatcherAction) {
    if (!(event instanceof SocketMessageEvent)) return;

    const dispatchAction = newDispatchActionFromJson(event.message);

    if (dispatchAction != null) {
      dispatch(dispatchAction);
    }
  }
}
