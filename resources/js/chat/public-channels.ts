// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { getPublicChannels } from 'chat/chat-api';
import ChannelJson from 'interfaces/chat/channel-json';
import { action, makeObservable, observable, runInAction } from 'mobx';

export default class PublicChannels {
  @observable channels?: ChannelJson[];
  @observable error = false;
  @observable xhr: ReturnType<typeof getPublicChannels> | null= null;

  constructor() {
    makeObservable(this);
  }

  @action
  load() {
    if (this.xhr != null) return;

    this.xhr = getPublicChannels()
      .done((channels) => runInAction(() => {
        this.channels = channels;
      }))
      .fail(action(() => {
        this.error = true;
      }))
      .always(action(() => {
        this.xhr = null;
      }));
  }
}
