// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

/* eslint-disable max-classes-per-file */

import DispatcherAction from 'actions/dispatcher-action';
import ChannelJson from 'interfaces/chat/channel-json';
import MessageJson from 'interfaces/chat/message-json';
import UserJson from 'interfaces/user-json';
import Channel from 'models/chat/channel';
import { SocketEventData } from 'socket-message-event';

const chatChannelEvents = ['chat.channel.join', 'chat.channel.part'] as const;
type ChatChannelEvent = (typeof chatChannelEvents)[number];

interface ChatChannelEventJson {
  data: ChannelJson;
  event: ChatChannelEvent;
}

interface ChatMessageNewEventJson {
  data: ChatMessagesNewJson;
  event: 'chat.message.new';
}

interface ChatMessagesNewJson {
  messages: MessageJson[];
  users: UserJson[];
}

export function isChannelEvent(arg: SocketEventData): arg is ChatChannelEventJson {
  return arg.event != null && (chatChannelEvents as Readonly<string[]>).includes(arg.event);
}

export function isMessageNewEvent(arg: SocketEventData): arg is ChatMessageNewEventJson {
  return arg.event === 'chat.message.new';
}

export class ChatChannelJoinEvent extends DispatcherAction {
  constructor(readonly channel: Channel) {
    super();
  }
}

export class ChatChannelPartEvent extends DispatcherAction {
  constructor(readonly channelId: number) {
    super();
  }
}

export class ChatMessageNewEvent extends DispatcherAction {
  constructor(readonly json: ChatMessagesNewJson) {
    super();
  }
}
