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

import { observable, computed, action, transaction} from "mobx";
import Message from "./message";

export interface ChannelJSON {
  channel_id: number;
  type: 'PUBLIC'|'PRIVATE'|'MULTIPLAYER'|'SPECTATOR'|'TEMPORARY'|'PM'|'GROUP';
  name: string;
  description?: string;
  icon?: string;
  users: Array<number>;
  last_read_id: number;
  last_message_id: number;
}

export default class Channel {
  @observable channel_id: number;
  @observable type: string;
  @observable name: string;
  @observable description?: string;
  @observable icon?: string;

  @observable messages?: Message[] = observable(new Array<Message>());

  @observable last_message_id?: number;
  @observable last_read_id?: number;

  @observable users?: number[];

  @observable loading: boolean = false;
  @observable loaded: boolean = false;

  @observable newChannel: boolean = false;

  constructor(channel_id: number) {
    this.channel_id = channel_id;
    // this.messages = observable(new Array<ChatMessage>());
  }

  @action
  static fromJSON(json: ChannelJSON): Channel {
    let channel = Object.create(Channel.prototype);
    return (<any>Object).assign(channel, {
      channel_id: json.channel_id,
      name: json.name,
      type: json.type,
      description: json.description,
      icon: json.icon,
      last_read_id: json.last_read_id,
      last_message_id: json.last_message_id
    });
  }

  @computed
  get isUnread(): boolean {
    return this.last_message_id > this.last_read_id;
  }

  @action
  addMessages(messages: Message | Array<Message>, skipSort: boolean = false) {
    transaction(() => {
      this.messages = this.messages.concat(messages);

      if (!skipSort) {
        this.resortMessages();
      }

      if (this.messages.length > 100) {
        this.messages = _.drop(this.messages, this.messages.length - 100)
      }
    });
  }

  @action
  updateMessage(message: Message) {
    let messageObject = _.find(this.messages, {'uuid': message.uuid});
    if (messageObject) {
      messageObject.update(message);
      if (messageObject.errored) {
        messageObject.message_id = messageObject.uuid; // prevent from being culled by uniq sort thing
      } else {
        messageObject.persist();
      }
    } else {
      console.log('wtfm8', message)
      // delay and retry?
    }
  }

  @action
  resortMessages() {
    let newMessages = this.messages.slice();
    newMessages = _.sortBy(newMessages, 'timestamp')
    newMessages = _.uniqBy(newMessages, 'message_id')

    this.messages = newMessages;
  }

  @action
  updatePresence = (presence: ChannelJSON) => {
    console.log('Channel::updatePresence', presence);
    // this.channel_id = presence.channel_id;
    this.name = presence.name;
    this.description = presence.description;
    this.type = presence.type;
    this.icon = presence.icon || '/tmp/channel-default.png'; // TODO: update with actual image
    this.last_read_id = presence.last_read_id;

    this.last_message_id = _.max([this.last_message_id, presence.last_message_id]);

    this.users = presence.users;
  }

  @action
  unload() {
    this.messages = observable(new Array<Message>());
  }
}
