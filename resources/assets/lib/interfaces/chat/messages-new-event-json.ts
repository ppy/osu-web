// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { SocketEventData } from 'socket-message-event';
import MessagesNewJson from './messages-new-json';

export function isMessageNewEvent(arg: SocketEventData): arg is MessageNewEventJson {
  return arg.event === 'chat.message.new';
}

export default interface MessageNewEventJson {
  data: MessagesNewJson;
  event: 'chat.message.new';
}
