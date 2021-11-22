// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

/* eslint-disable max-classes-per-file */

import DispatcherAction from 'actions/dispatcher-action';
import ChannelJson from 'interfaces/chat/channel-json';
import MessageJson from 'interfaces/chat/message-json';
import UserJson from 'interfaces/user-json';
import Channel from 'models/chat/channel';
import { SocketEventData } from 'socket-message-event';

interface ChatChannelEventJson {
  data: ChannelJson;
  event: string;
}

interface ChatMessageEventJson {
  data: ChatMessagesNewJson;
  event: string;
}

interface ChatMessagesNewJson {
  messages: MessageJson[];
  users: UserJson[];
}

export function isChannelEvent(arg: SocketEventData): arg is ChatChannelEventJson {
  return arg.event?.startsWith('chat.channel.') ?? false;
}

export function isMessageEvent(arg: SocketEventData): arg is ChatMessageEventJson {
  return arg.event?.startsWith('chat.message.') ?? false;
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
