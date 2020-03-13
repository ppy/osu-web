// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export type ChannelType = 'PUBLIC'|'PRIVATE'|'MULTIPLAYER'|'SPECTATOR'|'TEMPORARY'|'PM'|'GROUP'|'NEW';

export interface ChannelJSON {
  channel_id: number;
  description?: string;
  icon?: string;
  last_message_id: number;
  last_read_id: number;
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

export interface UserJSON {
  avatar_url: string;
  blocks?: any[];
  country_code: string; // TODO: country object?
  id: number;
  is_active: boolean;
  is_admin: boolean;
  is_bot: boolean;
  is_moderator: boolean;
  is_online: boolean;
  is_supporter: boolean;
  pm_friends_only: boolean;
  profile_colour: string;
  username: string;
}
