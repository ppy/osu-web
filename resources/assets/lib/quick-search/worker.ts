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

export enum Section {User, UserOthers, Beatmapset, BeatmapsetOthers, Others}
const SECTIONS = [
  Section.User,
  Section.UserOthers,
  Section.Beatmapset,
  Section.BeatmapsetOthers,
  Section.Others,
];

interface Cursor {
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
  @observable cursor: Cursor | null = null;
  debouncedSearch = debounce(this.search, 500);
  @observable query = '';
  @observable searching = false;
  @observable searchResult: SearchResult | null = null;

  private xhr: JQueryXHR | null = null;

  @action cycleCursor(direction: number) {
    let newCursor;
    if (!this.cursor) {
      if (direction > 0) {
        newCursor = {section: SECTIONS[0], index: 0};
      } else {
        const section = SECTIONS.length - 1;
        newCursor = {section, index: this.sectionLength(section) - 1};
      }
    } else {
      newCursor = {...this.cursor};
      newCursor.index += direction;
    }

    if (newCursor.index < 0 || newCursor.index >= this.sectionLength(SECTIONS[newCursor.section])) {
      let newSection = newCursor.section;
      do {
        newSection = (newSection + direction) % SECTIONS.length;
        if (newSection < 0) {
          newSection = SECTIONS.length + newSection;
        }
        if (newSection === newCursor.section) {
          return;
        }
      } while (this.sectionLength(SECTIONS[newSection]) === 0);

      newCursor = {
        index: direction > 0 ? 0 : this.sectionLength(newSection) - 1,
        section: newSection,
      };
    }

    this.cursor = newCursor;
  }

  @computed get cursorURL(): string | undefined {
    const searchResult = this.searchResult;
    if (!this.cursor || !searchResult) {
      return;
    }

    switch (this.cursor.section) {
      case Section.User:
        const userId = searchResult.user.users[this.cursor.index]?.id;
        return userId ? route('users.show', { user: userId }) : undefined;
      case Section.UserOthers:
        return route('search', { mode: 'user', query: this.query });
      case Section.Beatmapset:
        const id = searchResult.beatmapset.beatmapsets[this.cursor.index]?.id;
        return id ? route('beatmapsets.show', { beatmapset: id }) : undefined;
      case Section.BeatmapsetOthers:
        return route('search', { mode: 'beatmapset', query: this.query });
      case Section.Others:
        const others = otherModes.filter((mode) => searchResult[mode].total > 0);
        const selectedMode = others[this.cursor.index];

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
      this.cursor = null;
    })).always(action(() => {
      this.searching = false;
    }));
  }

  @action updateQuery(newQuery: string) {
    this.query = newQuery;
    this.cursor = null;
    this.debouncedSearch();
  }

  @action private reset() {
    this.debouncedSearch.cancel();
    if (this.xhr != null) {
      this.xhr.abort();
    }
    this.searching = false;
    this.searchResult = null;
    this.cursor = null;
  }

  private sectionLength(section: Section): number {
    const searchResult = this.searchResult;
    if (!searchResult) {
      return 0;
    }
    switch (section) {
      case Section.User:
        return searchResult.user.users.length;
      case Section.UserOthers:
        return searchResult.user.total > searchResult.user.users.length ? 1 : 0;
      case Section.Beatmapset:
        return searchResult.beatmapset.beatmapsets.length;
      case Section.BeatmapsetOthers:
        return searchResult.beatmapset.total > searchResult.beatmapset.beatmapsets.length ? 1 : 0;
      case Section.Others:
        return otherModes.filter((mode) => searchResult[mode].total > 0).length;
    }

    return 0;
  }
}
