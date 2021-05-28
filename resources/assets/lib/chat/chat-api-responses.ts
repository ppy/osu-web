// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';

interface ChatSilenceJson {
  id: number;
  user_id: number;
}

export type ChannelType = 'PUBLIC'|'PRIVATE'|'MULTIPLAYER'|'SPECTATOR'|'TEMPORARY'|'PM'|'GROUP'|'NEW';

// This is the one that matches the php-side transformer response.
export interface ChannelJson {
  channel_id: number;
  description?: string;
  first_message_id?: number;
  icon?: string;
  last_message_id?: number;
  moderated: boolean;
  name: string;
  type: ChannelType;
  users?: number[];
}

// This is the version used by 'presence'.
export interface ChannelJsonExtended extends ChannelJson {
  last_message_id: number;
  last_read_id: number;
}

export interface ChatInitialJson {
  last_message_id: number | null;
  presence: PresenceJson;
  send_to?: SendToJson;
}

export type GetMessagesJson =
  MessageJson[];

export interface GetUpdatesJson {
  messages: MessageJson[];
  presence: PresenceJson;
  silences: ChatSilenceJson[];
}

export type MarkAsReadJson =
  null;

export interface MessageJson {
  channel_id: number;
  content: string;
  is_action: boolean;
  message_id: number;
  sender?: UserJson;
  sender_id: number;
  timestamp: string;
}

export interface NewConversationJson {
  channel: ChannelJson;
  message: MessageJson;
  new_channel_id: number;
}

export type PresenceJson =
  ChannelJsonExtended[];

export type SendMessageJson =
  MessageJson;

export interface SendToJson {
  can_message: boolean;
  channel_id: number | null;
  target: UserJson;
}
