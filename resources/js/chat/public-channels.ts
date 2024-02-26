// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { getPublicChannels } from 'chat/chat-api';
import ChannelJson from 'interfaces/chat/channel-json';
import { action, makeObservable, observable, runInAction } from 'mobx';
import { isJqXHR } from 'utils/ajax';

const refreshDelayMs = 30_000;

export default class PublicChannels {
  @observable channels?: ChannelJson[];
  @observable error = false;
  @observable xhr: ReturnType<typeof getPublicChannels> | null= null;

  private lastRefreshTime?: Date;

  private get canRefresh() {
    if (this.lastRefreshTime == null) {
      return true;
    }

    return new Date().getTime() - this.lastRefreshTime.getTime() > refreshDelayMs;
  }

  constructor() {
    makeObservable(this);
  }

  @action
  async load() {
    if (this.xhr != null || !this.canRefresh) return;

    try {
      this.xhr = getPublicChannels();
      const channels = await this.xhr;

      runInAction(() => {
        this.lastRefreshTime = new Date();
        this.channels = channels;
      });
    } catch (error) {
      if (!isJqXHR(error)) throw error;

      runInAction(() => {
        this.error = true;
      });
    } finally {
      runInAction(() => {
        this.xhr = null;
      });
    }
  }
}
