// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ChatUpdateSilences } from 'actions/chat-update-silences';
import { dispatch } from 'app-dispatcher';
import { ack } from 'chat/chat-api';
import AckResponseJson from 'interfaces/chat/ack-response-json';
import { maxBy } from 'lodash';
import ChannelStore from 'stores/channel-store';
import RetryDelay from 'utils/retry-delay';

export default class PingService {
  private lastHistoryId?: number;
  // standard polling time of 0 to 20 seconds from default RetryDelay random
  private retryDelay = new RetryDelay(0, 45000);
  private timerId?: number;
  private xhr?: JQuery.jqXHR<AckResponseJson>;

  constructor(private channelStore: ChannelStore) {
  }

  start() {
    if (this.timerId == null) {
      this.scheduleNextPing();
    }
  }

  stop() {
    this.xhr?.abort();
    this.retryDelay.reset();
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

      this.retryDelay.reset();
      this.scheduleNextPing();
    }).fail((xhr) => {
      // logged out, stop pinging.
      if (xhr.status === 401) {
        return;
      }

      this.scheduleNextPing();
    });
  };

  private scheduleNextPing() {
    this.timerId = window.setTimeout(this.ping, this.retryDelay.get());
  }
}
