// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export type ChannelType = 'BROADCAST'|'PUBLIC'|'PRIVATE'|'MULTIPLAYER'|'SPECTATOR'|'TEMPORARY'|'PM'|'GROUP'|'NEW';

export default interface ChannelJson {
  channel_id: number;
  current_user_attributes?: {
    can_message: boolean;
    last_read_id: number;
  };
  description?: string;
  icon?: string;
  last_message_id?: number;
  name: string;
  type: ChannelType;
  users?: number[];
}
