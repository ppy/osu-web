// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ChannelJson from 'interfaces/channel-json';
import MessageJson from 'interfaces/message-json';
import UserJson from 'interfaces/user-json';

interface ChatSilenceJson {
  id: number;
  user_id: number;
}

export interface ChatInitialJson {
  last_message_id: number | null;
  presence: ChannelJson[];
  send_to?: SendToJson;
}

export type GetMessagesJson =
  MessageJson[];

export interface GetUpdatesJson {
  messages: MessageJson[];
  presence: ChannelJson[];
  silences: ChatSilenceJson[];
}

export type MarkAsReadJson =
  null;


export interface NewConversationJson {
  channel: ChannelJson;
  message: MessageJson;
  new_channel_id: number;
}

export type SendMessageJson =
  MessageJson;

export interface SendToJson {
  can_message: boolean;
  channel_id: number | null;
  target: UserJson;
}
