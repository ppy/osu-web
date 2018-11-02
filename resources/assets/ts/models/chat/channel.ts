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

import { action, computed, observable, transaction} from 'mobx';
import Message from './message';

export interface ChannelJSON {
  channel_id: number;
  type: 'PUBLIC'|'PRIVATE'|'MULTIPLAYER'|'SPECTATOR'|'TEMPORARY'|'PM'|'GROUP';
  name: string;
  description?: string;
  icon?: string;
  users: number[];
  last_read_id: number;
  last_message_id: number;
}

export default class Channel {
  @observable channelId: number;
  @observable type: string;
  @observable name: string;
  @observable description?: string;
  @observable icon?: string;

  @observable messages: Message[] = observable([]);

  @observable lastMessageId: number = -1;
  @observable lastReadId: number = -1;

  @observable users: number[] = [];

  @observable loading: boolean = false;
  @observable loaded: boolean = false;
  @observable moderated: boolean = false;

  @observable newChannel: boolean = false;

  constructor(channelId: number) {
    this.channelId = channelId;
  }

  @action
  static fromJSON(json: ChannelJSON): Channel {
    const channel = Object.create(Channel.prototype);
    return Object.assign(channel, {
      channelId: json.channel_id,
      name: json.name,
      type: json.type,

      description: json.description,
      icon: json.icon,
      lastMessageId: json.last_message_id,
      lastReadId: json.last_read_id,
    });
  }

  @computed
  get isUnread(): boolean {
    return this.lastMessageId > this.lastReadId;
  }

  @action
  addMessages(messages: Message | Message[], skipSort: boolean = false) {
    transaction(() => {
      this.messages = this.messages.concat(messages);

      if (!skipSort) {
        this.resortMessages();
      }

      if (this.messages.length > 100) {
        this.messages = _.drop(this.messages, this.messages.length - 100);
      }
    });
  }

  @action
  updateMessage(message: Message) {
    const messageObject = _.find(this.messages, {uuid: message.uuid});
    if (messageObject) {
      messageObject.update(message);
      if (messageObject.errored) {
        messageObject.messageId = messageObject.uuid; // prevent from being culled by uniq sort thing
      } else {
        messageObject.persist();
      }
    } else {
      // delay and retry?
    }
  }

  @action
  resortMessages() {
    let newMessages = this.messages.slice();
    newMessages = _.sortBy(newMessages, 'timestamp');
    newMessages = _.uniqBy(newMessages, 'messageId');

    this.messages = newMessages;
  }

  @action
  updatePresence = (presence: ChannelJSON) => {
    this.name = presence.name;
    this.description = presence.description;
    this.type = presence.type;
    this.icon = presence.icon || '/images/layout/chat/channel-default.png'; // TODO: update with channel-specific icons
    this.lastReadId = presence.last_read_id;

    this.lastMessageId = _.max([this.lastMessageId, presence.last_message_id]);

    this.users = presence.users;
  }

  @action
  unload() {
    this.messages = observable([]);
  }
}
