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
import { debounce } from 'lodash';
import { action, computed, observable } from 'mobx';

export type Section = 'user' | 'user_others' | 'beatmapset' | 'beatmapset_others' | 'others';
const SECTIONS: Section[] = [
  'user',
  'user_others',
  'beatmapset',
  'beatmapset_others',
  'others',
];

interface SelectedItem {
  index: number;
  section: number;
}

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

const otherModes: ResultMode[] = ['forum_post', 'wiki_page'];

export default class Worker {
  debouncedSearch = debounce(this.search, 500);
  @observable query = '';
  @observable searching = false;
  @observable searchResult: SearchResult | null = null;
  @observable selected: SelectedItem | null = null;

  private xhr: JQueryXHR | null = null;

  @action cycleSelectedItem(direction: number) {
    let newSelected: SelectedItem | null;
    if (!this.selected) {
      if (direction > 0) {
        newSelected = {section: 0, index: 0};
      } else {
        const sectionIdx = SECTIONS.length - 1;
        const section: Section = SECTIONS[sectionIdx];
        newSelected = {section: sectionIdx, index: this.sectionLength(section) - 1};
      }
    } else {
      newSelected = {...this.selected};
      newSelected.index += direction;
    }

    if (newSelected.index < 0 || newSelected.index >= this.sectionLength(SECTIONS[newSelected.section])) {
      let newSection = newSelected.section;
      do {
        newSection = (newSection + direction) % SECTIONS.length;
        if (newSection < 0) {
          newSection = SECTIONS.length + newSection;
        }
        if (newSection === newSelected.section) {
          return;
        }
      } while (this.sectionLength(SECTIONS[newSection]) === 0);

      newSelected = {
        index: direction > 0 ? 0 : this.sectionLength(SECTIONS[newSection]) - 1,
        section: newSection,
      };
    }

    this.selected = newSelected;
  }

  @computed get currentSection(): string | undefined {
    if (!this.selected) {
      return;
    }
    return SECTIONS[this.selected.section];
  }

  @computed get selectedURL(): string | undefined {
    const searchResult = this.searchResult;
    if (!this.selected || !searchResult) {
      return;
    }

    switch (SECTIONS[this.selected.section]) {
      case 'user':
        const userId = searchResult.user.users[this.selected.index]?.id;
        return userId ? route('users.show', { user: userId }) : undefined;
      case 'user_others':
        return route('search', { mode: 'user', query: this.query });
      case 'beatmapset':
        const id = searchResult.beatmapset.beatmapsets[this.selected.index]?.id;
        return id ? route('beatmapsets.show', { beatmapset: id }) : undefined;
      case 'beatmapset_others':
        return route('search', { mode: 'beatmapset', query: this.query });
      case 'others':
        const others = otherModes.filter((mode) => searchResult[mode].total > 0);
        const selectedMode = others[this.selected.index];

        return route('search', { mode: selectedMode, query: this.query });
    }
  }

  @action search() {
    if (this.query.length === 0) {
      this.reset();

      return;
    }

    this.searching = true;

    this.xhr = $.get(route('quick-search'), { query: this.query })
    .done(action((searchResult: SearchResult) => {
      this.searchResult = searchResult;
      this.selected = null;
    })).always(action(() => {
      this.searching = false;
    }));
  }

  @action selectNone() {
    this.selected = null;
  }

  @action setSelected(section: Section, index: number) {
    this.selected = {section: SECTIONS.indexOf(section), index};
  }

  @action updateQuery(newQuery: string) {
    this.query = newQuery;
    this.selected = null;
    this.debouncedSearch();
  }

  @action private reset() {
    this.debouncedSearch.cancel();
    if (this.xhr != null) {
      this.xhr.abort();
    }
    this.searching = false;
    this.searchResult = null;
    this.selected = null;
  }

  private sectionLength(section: Section): number {
    const searchResult = this.searchResult;
    if (!searchResult) {
      return 0;
    }
    switch (section) {
      case 'user':
        return searchResult.user.users.length;
      case 'user_others':
        return searchResult.user.total > searchResult.user.users.length ? 1 : 0;
      case 'beatmapset':
        return searchResult.beatmapset.beatmapsets.length;
      case 'beatmapset_others':
        return searchResult.beatmapset.total > searchResult.beatmapset.beatmapsets.length ? 1 : 0;
      case 'others':
        return otherModes.filter((mode) => searchResult[mode].total > 0).length;
    }

    return 0;
  }
}
