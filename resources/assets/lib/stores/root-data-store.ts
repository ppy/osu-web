/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

import { BeatmapsetSearch } from 'beatmaps/beatmapset-search';
import Dispatcher from 'dispatcher';
import { BeatmapsetStore } from './beatmapset-store';
import ChannelStore from './channel-store';
import ClientStore from './client-store';
import UIStateStore from './ui-state-store';
import UserStore from './user-store';

export default class RootDataStore {
  beatmapsetSearch: BeatmapsetSearch;
  beatmapsetStore: BeatmapsetStore;
  channelStore: ChannelStore;
  clientStore: ClientStore;
  uiState: UIStateStore;
  userStore: UserStore;

  constructor(dispatcher: Dispatcher) {
    // TODO: needs re-re-refactoring
    this.uiState = new UIStateStore(this, dispatcher);
    this.beatmapsetStore = new BeatmapsetStore(this, dispatcher);
    this.beatmapsetSearch = new BeatmapsetSearch(this.beatmapsetStore, dispatcher);
    this.clientStore = new ClientStore(this, dispatcher);
    this.channelStore = new ChannelStore(this, dispatcher);
    this.userStore = new UserStore(this, dispatcher);
  }
}
