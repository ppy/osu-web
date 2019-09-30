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

import { route } from 'laroute';
import * as ApiResponses from './chat-api-responses';

export default class ChatAPI {
  getMessages(channelId: number): Promise<ApiResponses.GetMessagesJSON> {
    return new Promise((resolve, reject) => {
      $.get(route('chat.channels.messages.index', {channel: channelId}))
        .done((response) => {
          resolve(response as ApiResponses.GetMessagesJSON);
        }).fail((error) => {
          reject(error);
        });
    });
  }

  getUpdates(since: number): Promise<ApiResponses.GetUpdatesJSON> {
    return new Promise((resolve, reject) => {
      $.get(route('chat.updates'),
        {since},
      ).done((response) => {
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

  newConversation(userId: number, message: string, action?: boolean): Promise<ApiResponses.NewConversationJSON> {
    return new Promise((resolve, reject) => {
      $.post(route('chat.new'), {
        is_action: action,
        message,
        target_id: userId,
      }).done((response) => {
        resolve(response as ApiResponses.NewConversationJSON);
      }).fail((error) => {
        reject(error);
      });
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

  sendMessage(channelId: number, message: string, action?: boolean): Promise<ApiResponses.SendMessageJSON> {
    return new Promise((resolve, reject) => {
      $.post(route('chat.channels.messages.store', {channel: channelId}), {
        is_action: action,
        message,
        target_id: channelId,
        target_type: 'channel',
      }).done((response) => {
        resolve(response as ApiResponses.SendMessageJSON);
      }).fail((error) => {
        reject(error);
      });
    });
  }
}
