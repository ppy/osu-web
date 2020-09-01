// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJSON from 'interfaces/user-json';

interface ChatSilenceJson {
  id: number;
  user_id: number;
}

export type ChannelType = 'PUBLIC'|'PRIVATE'|'MULTIPLAYER'|'SPECTATOR'|'TEMPORARY'|'PM'|'GROUP'|'NEW';

// This is the one that matches the php-side transformer response.
export interface ChannelJSON {
  channel_id: number;
  description?: string;
  moderated: boolean;
  name: string;
  type: ChannelType;
  users?: number[];
}

// This is the version used by 'presence'.
export interface ChannelJsonExtended extends ChannelJSON {
  first_message_id: number;
  icon?: string;
  last_message_id: number;
  last_read_id: number;
  moderated: boolean;
  users: number[];
}

export type GetMessagesJSON =
  MessageJSON[];

export interface GetUpdatesJSON {
  messages: MessageJSON[];
  presence: PresenceJSON;
  silences: ChatSilenceJson[];
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
  presence: PresenceJSON;
}

export type PresenceJSON =
  ChannelJsonExtended[];

export type SendMessageJSON =
  MessageJSON;

export interface SendToJSON {
  can_message: boolean;
  target: UserJSON;
}
