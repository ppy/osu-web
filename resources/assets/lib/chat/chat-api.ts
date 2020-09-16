import { ChatMessageUpdateAction, ChatNewConversation } from 'actions/chat-actions';
import { dispatch } from 'app-dispatcher';
// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import Message from 'models/chat/message';
import * as ApiResponses from './chat-api-responses';

export default class ChatAPI {
  async getChannel(channelId: number): Promise<ApiResponses.ChannelJSON> {
    return $.get(route('chat.channels.show', { channel: channelId }));
  }

  getMessages(channelId: number, params?: { since?: number; until?: number }): Promise<ApiResponses.GetMessagesJSON> {
    return new Promise((resolve, reject) => {
      $.get(route('chat.channels.messages.index', { channel: channelId, ...params }))
        .done((response) => {
          resolve(response as ApiResponses.GetMessagesJSON);
        }).fail((error) => {
          reject(error);
        });
    });
  }

  getUpdates(since: number, lastHistoryId?: number | null): Promise<ApiResponses.GetUpdatesJSON> {
    return new Promise((resolve, reject) => {
      $.get(route('chat.updates'), { since, history_since: lastHistoryId })
      .done((response) => {
        resolve(response as ApiResponses.GetUpdatesJSON);
      }).fail((error) => {
        reject(error);
      });
    });
  }

  markAsRead(channelId: number, messageId: number): Promise<ApiResponses.MarkAsReadJSON> {
    return new Promise((resolve, reject) => {
      $.ajax({
        type: 'PUT',
        url: route('chat.channels.mark-as-read', {channel: channelId, message: messageId}),
      }).done((response) => {
        resolve(response as ApiResponses.MarkAsReadJSON);
      }).fail((error) => {
        reject(error);
      });
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
    return new Promise((resolve, reject) => {
      $.ajax(route('chat.channels.part', {
        channel: channelId,
        user: userId,
      }), {
        method: 'DELETE',
      }).done((response) => {
        resolve(response);
      }).fail((error) => {
        reject(error);
      });
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
