// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';

export default interface MessageJson {
  channel_id: number;
  content: string;
  content_html?: string;
  is_action: boolean;
  message_id: number;
  sender?: UserJson;
  sender_id: number;
  timestamp: string;
  uuid?: string | null;
}
