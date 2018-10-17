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

import { MessageJSON } from 'models/chat/message';
import { ChannelJSON } from 'models/chat/channel';

export interface UpdateJSON {
  presence: ChannelJSON[];
  messages: MessageJSON[];
}

export default class ChatAPI {
  // Route::post('messages/new', 'MessagesController@newConversation')->name('messages.new');
  createChannel(userId: number, message: string): Promise<any> {
    return new Promise((resolve, reject) => {
      $.post(laroute.route('chat.new'), {
        target_id: userId,
        message: message
      }).done((r) => {
        resolve(r)
      }).fail((e) => {
        reject(e)
      });
    });
  }

  // Route::post('messages/channel/{channel_id}/mark-as-read', 'MessagesController@postMarkAsRead')->name('messages.mark-as-read');
  markAsRead(channelId: number, messageId: number): Promise<null> {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: laroute.route('chat.channels.mark-as-read', {channel_id: channelId, message_id: messageId}),
        type: 'PUT'
      }).done((r) => {
        resolve(r);
      }).fail((e) => {
        reject(e)
      });
    });
  }

  // Route::post('messages/{channel_id}', 'API\ChatController@postMessage')->name('messages.send');
  postMessage(channelId: number, message: string): Promise<MessageJSON> {
    return new Promise((resolve, reject) => {
      $.post(laroute.route('chat.channels.messages.store', {channel_id: channelId}), {
        target_type: 'channel',
        target_id: channelId,
        message: message
      }).done((r) => {
        resolve(<MessageJSON>r);
      }).fail((e) => {
        reject(e);
      });
    });
  }

  // Route::get('messages/channel/{channel_id}', 'MessagesController@channel')->name('messages.channel');
  getMessages(channelId: number): Promise<MessageJSON[]> {
    return new Promise((resolve, reject) => {
      $.get(laroute.route('chat.channels.messages.index', {channel_id: channelId}))
        .done((data) => {
          resolve(<MessageJSON[]>data);
        }).fail((e) => {
          reject(e);
        });
    });
  }

  // Route::get('messages/updates', 'MessagesController@getUpdates')->name('messages.updates');
  getUpdates(since: number): Promise<UpdateJSON> {
    return new Promise((resolve, reject) => {
      $.get(laroute.route('chat.updates'),
        {since: since}
      ).done( (r) => {
        resolve(<UpdateJSON>r);
      }).fail((e) => {
        reject(e);
      });
    });
  }
}
