// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ChatChannelJoinAction, ChatChannelPartAction, ChatMessageAddAction } from 'actions/chat-actions';
import { dispatch } from 'app-dispatcher';
import { ChannelType, MessageJSON } from 'chat/chat-api-responses';
import Message from 'models/chat/message';

// tslint:disable: max-classes-per-file

export interface ChatChannelEventJson {
  data: {
    channel_id: number;
  };
  event: string;
}

export interface ChatChannelJoinEventJson {
  data: {
    channel_id: number;
    icon?: string;
    name: string;
    type: ChannelType;
  };
  event: 'chat.channel.join';
}

export interface ChatChannelPartEventJson {
  data: {
    channel_id: number;
  };
  event: 'chat.channel.part';
}

export interface ChatMessageAddEventJson {
  data: MessageJSON;
  event: 'chat.message.add';
}

export function dispatchChatChannelEvent(json: ChatChannelEventJson) {
  // TODO: dynamic class loading?
  // const className = startCase(json.event).replace(/\s/g, '');

  if (isChatChannelJoinEventJson(json)) {
    const data = json.data;
    return dispatch(new ChatChannelJoinAction(data.channel_id, data.name, data.type, data.icon));
  } else if (isChatChannelPartEventJson(json)) {
    return dispatch(new ChatChannelPartAction(json.data.channel_id, false));
  } else if (isChatMessageAddEventJson(json)) {
    const message = Message.fromJSON(json.data);
    return dispatch(new ChatMessageAddAction(message));
  }
}

function isChatChannelJoinEventJson(arg: any): arg is ChatChannelJoinEventJson {
  return arg.event === 'chat.channel.join';
}

function isChatChannelPartEventJson(arg: any): arg is ChatChannelPartEventJson {
  return arg.event === 'chat.channel.part';
}

function isChatMessageAddEventJson(arg: any): arg is ChatMessageAddEventJson {
  return arg.event === 'chat.message.add';
}

export function isChatChannelEventJson(arg: any): arg is ChatChannelEventJson {
  return arg.event?.startsWith('chat.') ?? false;
}
