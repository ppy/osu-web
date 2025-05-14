// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetSearch from 'beatmaps/beatmapset-search';
import ChatStateStore from 'chat/chat-state-store';
import { BeatmapsetStore } from './beatmapset-store';
import ChannelStore from './channel-store';
import ClientStore from './client-store';
import NotificationStore from './notification-store';
import OwnClientStore from './own-client-store';
import UIStateStore from './ui-state-store';
import UserStore from './user-store';

export default class RootDataStore {
  beatmapsetSearch: BeatmapsetSearch;
  beatmapsetStore: BeatmapsetStore;
  channelStore: ChannelStore;
  chatState: ChatStateStore;
  clientStore: ClientStore;
  notificationStore: NotificationStore;
  ownClientStore: OwnClientStore;
  uiState: UIStateStore;
  userStore: UserStore;

  constructor() {
    // TODO: needs re-re-refactoring
    this.beatmapsetStore = new BeatmapsetStore();
    this.beatmapsetSearch = new BeatmapsetSearch(this.beatmapsetStore);
    this.clientStore = new ClientStore();
    this.notificationStore = new NotificationStore();
    this.ownClientStore = new OwnClientStore();
    this.userStore = new UserStore();
    this.channelStore = new ChannelStore();
    this.chatState = new ChatStateStore(this.channelStore);
    this.uiState = new UIStateStore();
  }
}
