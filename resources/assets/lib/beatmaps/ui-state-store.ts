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

import Filters from 'beatmap-search-filters';
import { intersection } from 'lodash';
import { computed, observable } from 'mobx';
import core from 'osu-core-singleton';

const store = core.dataStore.beatmapSearchStore;

export class UIStateStore {
  @observable hasMore = false;
  @observable isPaging = false;
  @observable loading = false;
  @observable recommendedDifficulty = 0;
  @observable filters: Filters = BeatmapsetFilter.fillDefaults(BeatmapsetFilter.filtersFromUrl(location.href));
  @observable isExpanded = intersection(Object.keys(BeatmapsetFilter.filtersFromUrl(location.href)), BeatmapsetFilter.expand).length > 0;

  @computed
  get beatmapsets() {
    return store.getBeatmapsets(this.filters);
  }
}

export const instance = new UIStateStore();
