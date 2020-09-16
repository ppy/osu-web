import { ChatMessageUpdateAction, ChatNewConversation } from 'actions/chat-actions';
import { dispatch } from 'app-dispatcher';
// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import Message from 'models/chat/message';
import * as ApiResponses from './chat-api-responses';

export default class ChatAPI {
  getChannel(channelId: number): JQuery.jqXHR<ApiResponses.ChannelJSON> {
    return $.get(route('chat.channels.show', { channel: channelId }));
  }

  getMessages(channelId: number, params?: { since?: number; until?: number }): JQuery.jqXHR<ApiResponses.GetMessagesJSON> {
    return $.get(route('chat.channels.messages.index', { channel: channelId, ...params }));
  }

  getUpdates(since: number, lastHistoryId?: number | null): JQuery.jqXHR<ApiResponses.GetUpdatesJSON> {
    return $.get(route('chat.updates'), { since, history_since: lastHistoryId });
  }

  markAsRead(channelId: number, messageId: number): JQuery.jqXHR<ApiResponses.MarkAsReadJSON> {
    return $.ajax({
      type: 'PUT',
      url: route('chat.channels.mark-as-read', {channel: channelId, message: messageId}),
    });
  }

  newConversation(userId: number, message: Message) {
    return $.post(route('chat.new'), {
      is_action: message.isAction,
      message: message.content,
      target_id: userId,
    }).done((response: ApiResponses.NewConversationJSON) => {
      dispatch(new ChatNewConversation(response.channel, response.message, message.channelId));
    }).fail(() => {
      dispatch(new ChatMessageUpdateAction(message, null));
    });
  }

  partChannel(channelId: number, userId: number) {
    return $.ajax(route('chat.channels.part', {
      channel: channelId,
      user: userId,
    }), {
      method: 'DELETE',
    });
  }

  sendMessage(message: Message) {
    return $.post(route('chat.channels.messages.store', { channel: message.channelId }), {
      is_action: message.isAction,
      message: message.content,
      target_id: message.channelId,
      target_type: 'channel',
    }).done((response: ApiResponses.SendMessageJSON) => {
      dispatch(new ChatMessageUpdateAction(message, response));
    }).fail(() => {
      dispatch(new ChatMessageUpdateAction(message, null));
    });
  }
}
