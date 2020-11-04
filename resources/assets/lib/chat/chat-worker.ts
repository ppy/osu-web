// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';
import { WindowBlurAction, WindowFocusAction } from 'actions/window-focus-actions';
import { dispatchListener } from 'app-dispatcher';
import DispatchListener from 'dispatch-listener';
import { maxBy } from 'lodash';
import { transaction } from 'mobx';
import ChannelStore from 'stores/channel-store';
import ChatAPI from './chat-api';

@dispatchListener
export default class ChatWorker implements DispatchListener {
  private api = new ChatAPI();
  private lastHistoryId: number | null = null;
  private pollingEnabled = true;
  private pollTime = 1000;
  private pollTimeIdle = 5000;
  private updateTimerId?: number;
  private updateXHR = false;
  private windowIsActive = true;

  constructor(private channelStore: ChannelStore) {
  }

  handleDispatchAction(action: DispatcherAction) {
    if (action instanceof WindowFocusAction) {
      this.windowIsActive = true;
    } else if (action instanceof WindowBlurAction) {
      this.windowIsActive = false;
    }
  }

  pollForUpdates = () => {
    if (this.updateXHR) {
      return;
    }

    this.updateXHR = true;

    const maxMessageId = this.channelStore.maxMessageId;

    this.api.getUpdates(maxMessageId, this.lastHistoryId)
      .then((updateJson) => {
        this.updateXHR = false;
        if (this.pollingEnabled) {
          this.updateTimerId = Timeout.set(this.pollingTime(), this.pollForUpdates);
        }

        if (!updateJson) {
          return;
        }

        transaction(() => {
          const newHistoryId = maxBy(updateJson.silences, 'id')?.id;

          if (newHistoryId != null) {
            this.lastHistoryId = newHistoryId;
          }

          this.channelStore.updateWithJson(updateJson);
        });
      })
      .catch((err) => {
        // silently ignore errors and continue polling
        this.updateXHR = false;
        if (this.pollingEnabled) {
          this.updateTimerId = Timeout.set(this.pollingTime(), this.pollForUpdates);
        }
      });
  }

  pollingTime(): number {
    return this.windowIsActive ? this.pollTime : this.pollTimeIdle;
  }

  startPolling() {
    if (!this.updateTimerId) {
      this.updateTimerId = Timeout.set(this.pollingTime(), this.pollForUpdates);
    }
  }

  stopPolling() {
    if (this.updateTimerId) {
      Timeout.clear(this.updateTimerId);
      this.updateTimerId = undefined;
      this.updateXHR = false;
    }
  }
}
