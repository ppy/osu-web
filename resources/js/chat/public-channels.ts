// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { getPublicChannels } from 'chat/chat-api';
import ChannelJson from 'interfaces/chat/channel-json';
import { action, makeObservable, observable, runInAction } from 'mobx';
import { isJqXHR } from 'utils/ajax';

export default class PublicChannels {
  @observable channels?: ChannelJson[];
  @observable error = false;
  @observable xhr: ReturnType<typeof getPublicChannels> | null= null;

  constructor() {
    makeObservable(this);
  }

  @action
  async load() {
    if (this.xhr != null) return;

    try {
      this.xhr = getPublicChannels();
      const channels = await this.xhr;

      runInAction(() => {
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
