// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
// tslint:disable:max-classes-per-file
import Message from 'models/chat/message';
import { ChannelJSON, ChannelType, MessageJSON, PresenceJSON } from '../chat/chat-api-responses';
import DispatcherAction from './dispatcher-action';

export class ChatChannelLoadEarlierMessages implements DispatcherAction {
  constructor(public channelId: number) {
  }
}

export class ChatChannelPartAction implements DispatcherAction {
  constructor(public channelId: number, public shouldSync = true) {
  }
}

export class ChatChannelJoinAction implements DispatcherAction {
  constructor(readonly channelId: number, readonly name: string, readonly type: ChannelType, readonly icon?: string) {
  }
}

export class ChatChannelSwitchAction implements DispatcherAction {
  constructor(public channelId: number) {
  }
}

export class ChatMessageAddAction implements DispatcherAction {
  constructor(public message: Message) {
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

export class ChatNewConversation implements DispatcherAction {
  constructor(readonly channel: ChannelJSON, readonly message: MessageJSON, readonly tempChannelId: number) {
  }
}

export class ChatPresenceUpdateAction implements DispatcherAction {
  constructor(public presence: PresenceJSON) {
  }
}
