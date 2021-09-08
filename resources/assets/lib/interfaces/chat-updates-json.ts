// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ChannelJson from 'interfaces/channel-json';
import MessageJson from 'interfaces/message-json';

export default interface ChatUpdatesJson {
  messages: MessageJson[];
  presence: ChannelJson[];
  silences: ChatSilenceJson[];
}

interface ChatSilenceJson {
  id: number;
  user_id: number;
}
