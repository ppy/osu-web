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

import { BeatmapsetJSON } from 'beatmapsets/beatmapset-json';
import { route } from 'laroute';
import { Cancelable, debounce } from 'lodash';
import { action, observable } from 'mobx';

export type ResultMode = 'beatmapset' | 'forum_post' | 'user' | 'wiki_page';

interface SearchResult {
  beatmapset: SearchResultBeatmapset;
  forum_post: SearchResultSummary;
  user: SearchResultUser;
  wiki_page: SearchResultSummary;
}

interface SearchResultSummary {
  total: number;
}

interface SearchResultBeatmapset extends SearchResultSummary {
  beatmapsets: BeatmapsetJSON[];
}

interface SearchResultUser extends SearchResultSummary {
  users: User[];
}

export default class Worker {
  @observable query = '';
  @observable searching = false;
  @observable searchResult: SearchResult | null = null;

  private debouncedSearch: (() => void) & Cancelable;
  private xhr: JQueryXHR | null = null;

  constructor() {
    this.debouncedSearch = debounce(this.search, 500);
  }

  @action search = () => {
    if (this.query.length === 0) {
      this.reset();

      return;
    }

    this.searching = true;

    this.xhr = $.get(route('quick-search'), { query: this.query })
    .done(action((searchResult: SearchResult) => {
      this.searchResult = searchResult;
    })).always(action(() => {
      this.searching = false;
    }));
  }

  @action updateQuery = (newQuery: string) => {
    this.query = newQuery;
    this.debouncedSearch();
  }

  @action private reset = () => {
    this.debouncedSearch.cancel();
    if (this.xhr != null) {
      this.xhr.abort();
    }
    this.searching = false;
    this.searchResult = null;
  }
}
