// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';
import ChannelJson from 'interfaces/channel-json';
import MessageJson from 'interfaces/message-json';
import Channel from 'models/chat/channel';
import Message from 'models/chat/message';

// tslint:disable: max-classes-per-file

export type ChatEventJson = ChatChannelEventJson | ChatMessageEventJson;

export interface ChatChannelEventJson {
  data: ChannelJson;
  event: string;
}

export interface ChatMessageEventJson {
  data: MessageJson;
  event: string;
}

export class ChatChannelJoinEvent extends DispatcherAction {
  constructor(readonly channel: Channel) {
    super();
  }
}

export class ChatChannelNewMessagesEvent extends DispatcherAction {
  constructor(readonly channelId: number, readonly json: MessageJson[]) {
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
