// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

/* eslint-disable max-classes-per-file */
/* tslint:disable: max-classes-per-file */

import DispatcherAction from 'actions/dispatcher-action';
import ChannelJson from 'interfaces/channel-json';
import MessageJson from 'interfaces/message-json';
import Channel from 'models/chat/channel';
import Message from 'models/chat/message';

export type ChatEventJson = ChatChannelEventJson | ChatMessageEventJson;

export interface ChatChannelEventJson {
  data: ChannelJson;
  event: string;
}

export interface ChatMessageEventJson {
  data: MessageJson;
  event: string;
}

export function isChannelEvent(arg: ChatEventJson): arg is ChatChannelEventJson {
  return arg.event?.startsWith('chat.channel.') ?? false;
}

export function isMessageEvent(arg: ChatEventJson): arg is ChatMessageEventJson {
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
  constructor(readonly message: Message) {
    super();
  }
}
