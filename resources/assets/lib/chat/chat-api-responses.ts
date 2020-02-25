/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
