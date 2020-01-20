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

import { route } from 'laroute';
import { debounce } from 'lodash';
import { action, computed, observable } from 'mobx';

interface SuggestionJSON {
  highlight: string;
  source: string;
}

export class WikiSearchController {
  @observable direction = 0;
  @observable query = '';
  @observable selectedIndex = -1;
  @observable shouldShowSuggestions = false;
  @observable suggestions: SuggestionJSON[] = [];

  private getSuggestionsDebounced = debounce(this.getSuggestions, 200);
  private saved = '';

  @computed get isSuggestionsVisible() {
    return this.shouldShowSuggestions && this.suggestions.length > 0;
  }

  @action
  getSuggestions() {
    $.getJSON(route('wiki-suggestions'), { q: this.query.trim() })
    .done(action((response) => {
      if (response != null) {
        this.suggestions = response as SuggestionJSON[];
        this.shouldShowSuggestions = true;
      }
    }));
  }

  @action
  search() {
    const query = this.query.trim();

    if (query === '') {
      return;
    }

    Turbolinks.visit(route('search', {
      mode: 'wiki_page',
      query,
    }));
  }

  @action
  selectIndex(index: number, direction: number) {
    if (index < -1 || index >= this.suggestions.length) return;

    this.selectedIndex = index;
    this.direction = direction;

    if (direction === 0) return;

    if (index < 0) {
      this.query = this.saved;
      this.shouldShowSuggestions = false;
    } else {
      this.query = this.suggestions[index].source;
      this.shouldShowSuggestions = true;
    }
  }

  @action
  shiftSelectedIndex(direction: number) {
    this.selectIndex(this.selectedIndex + direction, direction);
  }

  @action
  updateQuery(query: string) {
    this.saved = this.query = query;

    if (this.query.trim().length === 0) {
      this.suggestions = [];
    }

    if (this.query.trim().length > 1) {
      this.getSuggestionsDebounced();
    }
  }
}
