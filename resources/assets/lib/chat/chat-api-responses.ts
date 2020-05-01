// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJSON from 'interfaces/user-json';

export type ChannelType = 'PUBLIC'|'PRIVATE'|'MULTIPLAYER'|'SPECTATOR'|'TEMPORARY'|'PM'|'GROUP'|'NEW';

export interface ChannelJSON {
  channel_id: number;
  description?: string;
  first_message_id: number;
  icon?: string;
  last_message_id: number;
  last_read_id: number;
  moderated: boolean;
  name: string;
  type: ChannelType;
  users: number[];
}

export type GetMessagesJSON =
  MessageJSON[];

export interface GetUpdatesJSON {
  messages: MessageJSON[];
  presence: ChannelJSON[];
}

export type MarkAsReadJSON =
  null;

export interface MessageJSON {
  channel_id: number;
  content: string;
  is_action: boolean;
  message_id: number;
  sender: UserJSON;
  sender_id: number;
  timestamp: string;
}

export interface NewConversationJSON {
  message: MessageJSON;
  new_channel_id: number;
  presence: ChannelJSON[];
}

export type PresenceJSON =
  ChannelJSON[];

export type SendMessageJSON =
  MessageJSON;

export interface SendToJSON {
  can_message: boolean;
  target: UserJSON;
}
