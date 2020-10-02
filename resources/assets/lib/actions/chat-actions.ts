// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
// tslint:disable:max-classes-per-file

import Channel from 'models/chat/channel';
import Message from 'models/chat/message';
import { ChannelType, MessageJSON } from '../chat/chat-api-responses';
import DispatcherAction from './dispatcher-action';

export class ChatChannelLoadEarlierMessages implements DispatcherAction {
  constructor(readonly channelId: number) {
  }
}

export class ChatChannelNewMessages implements DispatcherAction {
  constructor(readonly channelId: number, readonly json: MessageJSON[]) {
  }
}

export class ChatChannelPartAction implements DispatcherAction {
  constructor(readonly channelId: number) {
  }
}

export class ChatChannelJoinAction implements DispatcherAction {
  constructor(readonly channelId: number, readonly name: string, readonly type: ChannelType, readonly icon?: string) {
  }
}

export class ChatChannelSwitchedAction implements DispatcherAction {
  constructor(readonly channel: Channel) {
  }
}

export class ChatMessageSendAction implements DispatcherAction {
  constructor(readonly message: Message) {
  }
}

export class ChatMessageUpdateAction implements DispatcherAction {
  constructor(readonly message: Message, readonly json: MessageJSON | null) {
  }
}
