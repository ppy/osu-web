// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import Message from 'models/chat/message';
import * as ApiResponses from './chat-api-responses';

export default class ChatAPI {
  getMessages(channelId: number, params?: { since?: number; until?: number }): JQuery.jqXHR<ApiResponses.GetMessagesJson> {
    return $.get(route('chat.channels.messages.index', { channel: channelId, ...params }));
  }

  getUpdates(since: number, lastHistoryId?: number | null): JQuery.jqXHR<ApiResponses.GetUpdatesJson> {
    return $.get(route('chat.updates'), { history_since: lastHistoryId, since });
  }

  markAsRead(channelId: number, messageId: number): JQuery.jqXHR<ApiResponses.MarkAsReadJson> {
    return $.ajax({
      type: 'PUT',
      url: route('chat.channels.mark-as-read', {channel: channelId, message: messageId}),
    });
  }

  newConversation(userId: number, message: Message): JQuery.jqXHR<ApiResponses.NewConversationJson> {
    return $.post(route('chat.new'), {
      is_action: message.isAction,
      message: message.content,
      target_id: userId,
    });
  }

  partChannel(channelId: number, userId: number): JQuery.jqXHR<void> {
    return $.ajax(route('chat.channels.part', {
      channel: channelId,
      user: userId,
    }), {
      method: 'DELETE',
    });
  }

  sendMessage(message: Message): JQuery.jqXHR<ApiResponses.SendMessageJson> {
    return $.post(route('chat.channels.messages.store', { channel: message.channelId }), {
      is_action: message.isAction,
      message: message.content,
      target_id: message.channelId,
      target_type: 'channel',
    });
  }
}
