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
  type: ChannelType;
  name: string;
  description?: string;
  icon?: string;
  users: number[];
  last_read_id: number;
  last_message_id: number;
}

export interface UserJSON {
  id: number;
  username: string;
  avatar_url: string;
  profile_colour: string;
  country_code: string; // TODO: country object?
  is_active: boolean;
  is_bot: boolean;
  is_online: boolean;
  is_supporter: boolean;
  pm_friends_only: boolean;
}

export interface MessageJSON {
  content: string;
  is_action: boolean;
  message_id: number;
  sender: UserJSON;
  sender_id: number;
  channel_id: number;
  timestamp: string;
}

export type GetMessagesJSON =
  MessageJSON[];

export interface GetUpdatesJSON {
  presence: ChannelJSON[];
  messages: MessageJSON[];
}

export type MarkAsReadJSON =
  null;

export interface NewConversationJSON {
  new_channel_id: number;
  presence: ChannelJSON[];
  message: MessageJSON;
}

export type PresenceJSON =
  ChannelJSON[];

export type SendMessageJSON =
  MessageJSON;

export interface SendToJSON {
  target: UserJSON;
  can_message: boolean;
}
