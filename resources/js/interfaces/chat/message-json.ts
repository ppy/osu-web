// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';

export type MessageType = 'action' | 'markdown' | 'plain';

export default interface MessageJson {
  channel_id: number;
  content: string;
  is_action: boolean;
  message_id: number;
  sender?: UserJson;
  sender_id: number;
  timestamp: string;
  type: MessageType;
  uuid?: string | null;
}
