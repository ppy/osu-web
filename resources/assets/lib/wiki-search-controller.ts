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
import { action, observable } from 'mobx';

export class WikiSearchController {
  @observable direction = 0;
  @observable isSuggestionsVisibile = false;
  @observable query = '';
  @observable selectedIndex = -1;
  @observable suggestions: string[] = [];

  private saved = '';

  @action
  getSuggestions() {
    $.getJSON(route('wiki-suggestions'), { q: this.query })
    .done(action((response) => {
      this.suggestions = response as string[] ?? [];
      this.isSuggestionsVisibile = this.suggestions.length > 0;
    }));
  }

  @action
  search() {
    const input = this.query;

    if (input === '') {
      return;
    }

    Turbolinks.visit(route('search', {
      mode: 'wiki_page',
      query: input,
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
      this.isSuggestionsVisibile = false;
    } else {
      this.query = this.suggestions[index];
      this.isSuggestionsVisibile = true;
    }
  }

  @action
  shiftSelectedIndex(direction: number) {
    this.selectIndex(this.selectedIndex + direction, direction);
  }

  @action
  updateQuery(query: string) {
    this.saved = this.query = query;
    this.getSuggestions();
  }
}
