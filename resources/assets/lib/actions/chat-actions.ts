// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
// tslint:disable:max-classes-per-file

import DispatcherAction from 'actions/dispatcher-action';
import { MessageJSON } from 'chat/chat-api-responses';
import Message from 'models/chat/message';

export class ChatChannelLoadEarlierMessages implements DispatcherAction {
  constructor(readonly channelId: number) {
  }
}

export class ChatChannelPartAction implements DispatcherAction {
  constructor(readonly channelId: number) {
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
