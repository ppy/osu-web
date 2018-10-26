/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

import * as ApiResponses from './chat-api-responses';

export default class ChatAPI {
  getMessages(channelId: number): Promise<ApiResponses.GetMessagesJSON> {
    return new Promise((resolve, reject) => {
      $.get(laroute.route('chat.channels.messages.index', {channel_id: channelId}))
        .done((response) => {
          resolve(response as ApiResponses.GetMessagesJSON);
        }).fail((error) => {
          reject(error);
        });
    });
  }

  getUpdates(since: number): Promise<ApiResponses.GetUpdatesJSON> {
    return new Promise((resolve, reject) => {
      $.get(laroute.route('chat.updates'),
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
        url: laroute.route('chat.channels.mark-as-read', {channel_id: channelId, message_id: messageId}),
      }).done((response) => {
        resolve(response as ApiResponses.MarkAsReadJSON);
      }).fail((error) => {
        reject(error);
      });
    });
  }

  newConversation(userId: number, message: string): Promise<ApiResponses.NewConversationJSON> {
    return new Promise((resolve, reject) => {
      $.post(laroute.route('chat.new'), {
        message,
        target_id: userId,
      }).done((response) => {
        resolve(response as ApiResponses.NewConversationJSON);
      }).fail((error) => {
        reject(error);
      });
    });
  }

  sendMessage(channelId: number, message: string): Promise<ApiResponses.SendMessageJSON> {
    return new Promise((resolve, reject) => {
      $.post(laroute.route('chat.channels.messages.store', {channel_id: channelId}), {
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
