// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';
import { dispatch, dispatchListener } from 'app-dispatcher';
import DispatchListener from 'dispatch-listener';
import { isChannelEvent } from 'interfaces/chat/channel-event-json';
import { isMessageNewEvent } from 'interfaces/chat/messages-new-event-json';
import Channel from 'models/chat/channel';
import SocketMessageEvent, { SocketEventData } from 'socket-message-event';
import ChatChannelJoinEvent from './chat-channel-join-event';
import ChatChannelPartEvent from './chat-channel-part-event';
import ChatMessageNewEvent from './chat-message-new-event';

function newDispatchActionFromJson(json: SocketEventData) {
  if (isMessageNewEvent(json)) {
    return new ChatMessageNewEvent(json.data);
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
