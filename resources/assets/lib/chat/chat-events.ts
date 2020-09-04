// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ChatChannelJoinAction, ChatChannelPartAction } from 'actions/chat-actions';
import { dispatch } from 'app-dispatcher';
import { runInAction } from 'mobx';

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
  };
  event: 'chat.channel.join';
}

export interface ChatChannelPartEventJson {
  data: {
    channel_id: number;
  };
  event: 'chat.channel.part';
}

export function dispatchChatChannelEvent(json: ChatChannelEventJson) {
  // TODO: dynamic class loading?
  // const className = startCase(json.event).replace(/\s/g, '');
  runInAction(() => {
    const data = json.data;
    console.log(json);
    switch (json.event) {
      case 'chat.channel.part':
        return dispatch(new ChatChannelPartAction(data.channel_id, false));

      case 'chat.channel.join':
        return dispatch(new ChatChannelJoinAction(data.channel_id, data.name, data.type, data.icon));
    }
  });
}

export function isChatChannelEventJson(arg: any): arg is ChatChannelEventJson {
  return arg.event?.startsWith('chat.') ?? false;
}
