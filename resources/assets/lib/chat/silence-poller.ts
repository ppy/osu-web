// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

/* eslint-disable max-classes-per-file */
/* tslint:disable: max-classes-per-file */

import { ChatSilenceJson } from 'interfaces/chat/chat-updates-json';
import { route } from 'laroute';
import { maxBy } from 'lodash';
import ChannelStore from 'stores/channel-store';

interface SilenceUpdatesJson {
  silences: ChatSilenceJson[];
}

export default class SilencePoller {
  private lastHistoryId: number | null = null;
  private pollingTime = 5000;
  private timerId?: number;
  private xhr?: JQuery.jqXHR<SilenceUpdatesJson | null>;

  constructor(private channelStore: ChannelStore) {
  }

  start() {
    if (this.timerId == null) {
      this.timerId = window.setTimeout(this.getUpdates, this.pollingTime);
    }
  }

  stop() {
    this.xhr?.abort();
    if (this.timerId != null) {
      window.clearTimeout(this.timerId);
      this.timerId = undefined;
    }
  }

  private getUpdates = () => {
    this.xhr = $.getJSON(
      route('chat.updates'),
      {
        history_since: this.lastHistoryId,
        includes: { messages: 0, presence: 0, silences: 1 },
        since: this.channelStore.lastReceivedMessageId,
      },
    );

    this.xhr.done((json) => {
      if (json != null) {
        const newHistoryId = maxBy(json.silences, 'id')?.id;

        if (newHistoryId != null) {
          this.lastHistoryId = newHistoryId;
        }

        this.channelStore.updateWithJson(json);
      }

      this.timerId = window.setTimeout(this.getUpdates, this.pollingTime);
    });
  };
}
