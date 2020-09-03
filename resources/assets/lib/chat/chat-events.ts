// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ChatChannelPartAction } from 'actions/chat-actions';
import { dispatch } from 'app-dispatcher';

// tslint:disable: max-classes-per-file

export interface ChatChannelEventJson {
  data: {
    channel_id: number;
  };
  event: string;
}

export interface ChatChannelPartEventJson {
  data: {
    channel_id: number;
  };
  event: 'chat.channel.part';
}

export function dispatchChatChannelEvent(json: ChatChannelEventJson) {
  dispatch(new ChatChannelPartAction(json.data.channel_id, false));
}

export function isChatChannelEventJson(arg: any): arg is ChatChannelEventJson {
  return arg.event?.startsWith('chat.') ?? false;
}
