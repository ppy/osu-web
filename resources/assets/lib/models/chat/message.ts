// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { MessageJSON } from 'chat/chat-api-responses';
import * as _ from 'lodash';
import { action, computed, observable } from 'mobx';
import User from 'models/user';
import * as moment from 'moment';
import core from 'osu-core-singleton';

export default class Message {
  @observable channelId = -1;
  @observable content = '';
  @observable errored = false;
  @observable isAction = false;
  @observable messageId: number | string = -1;
  @observable persisted = false;
  @observable senderId = -1;
  @observable timestamp = moment().toISOString();
  @observable uuid = osu.uuid();

  @computed
  get sender() {
    return core.dataStore.userStore.get(this.senderId) ?? new User(-1);
  }

  @computed
  get parsedContent() {
    return osu.linkify(_.escape(this.content), true);
  }

  static fromJSON(json: MessageJSON): Message {
    const message = Object.create(Message.prototype);
    return Object.assign(message, {
      channelId: json.channel_id,
      content: json.content,
      isAction: json.is_action,
      messageId: json.message_id,
      persisted: true,
      senderId: json.sender_id,
      timestamp: json.timestamp,
      uuid: osu.uuid(),
    });
  }

  @action
  persist() {
    this.persisted = true;

    return this;
  }
}
