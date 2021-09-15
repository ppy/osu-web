// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ChatUpdateSilences } from 'actions/chat-update-silences';
import { dispatch } from 'app-dispatcher';
import { ack } from 'chat/chat-api';
import AckResponseJson from 'interfaces/chat/ack-response-json';
import { maxBy } from 'lodash';
import ChannelStore from 'stores/channel-store';

export default class PingService {
  private lastHistoryId?: number;
  private pollingTime = 5000;
  private timerId?: number;
  private xhr?: JQuery.jqXHR<AckResponseJson>;

  constructor(private channelStore: ChannelStore) {
  }

  start() {
    if (this.timerId == null) {
      this.timerId = window.setTimeout(this.ping, this.pollingTime);
    }
  }

  stop() {
    this.xhr?.abort();
    if (this.timerId != null) {
      window.clearTimeout(this.timerId);
      this.timerId = undefined;
    }
  }

  private ping = () => {
    this.xhr = ack(this.channelStore.lastReceivedMessageId, this.lastHistoryId).done((json) => {
      const newHistoryId = maxBy(json.silences, 'id')?.id;

      if (newHistoryId != null) {
        this.lastHistoryId = newHistoryId;
      }

      dispatch(new ChatUpdateSilences(json.silences));

      this.timerId = window.setTimeout(this.ping, this.pollingTime);
    });
  };
}
