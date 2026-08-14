// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { debounce } from 'lodash';
import { action, computed, makeObservable, observable } from 'mobx';

interface SuggestionJson {
  highlight: string;
  locale: string;
  path: string;
  title: string;
}

export class WikiSearchController {
  @observable selectedIndex = -1;
  @observable shouldShowSuggestions = false;
  @observable suggestions: SuggestionJson[] = [];

  private readonly debouncedFetchSuggestions = debounce(() => this.fetchSuggestions(), 200);
  @observable private locale: string;
  @observable private query = '';
  private xhr?: JQueryXHR;

  @computed get isSuggestionsVisible() {
    return this.shouldShowSuggestions && this.suggestions.length > 0;
  }

  @computed get selectedItem(): SuggestionJson | undefined {
    return this.suggestions[this.selectedIndex];
  }

  @computed get displayText() {
    return this.selectedItem == null ? this.query : this.selectedItem.title;
  }

  constructor(locale: string) {
    makeObservable(this);
    this.locale = locale;
  }

  @action
  cancel() {
    this.xhr?.abort();
    this.debouncedFetchSuggestions.cancel();
  }

  @action
  search() {
    const query = this.displayText.trim();

    if (!query.length) {
      return;
    }

    Turbo.visit(route('search', {
      mode: 'wiki_page',
      query,
    }));
  }

  @action
  selectIndex(index: number): void {
    if (index < -1) {
      return this.selectIndex(this.suggestions.length - 1);
    }

    if (index >= this.suggestions.length) {
      return this.selectIndex(-1);
    }

    this.selectedIndex = index;
    this.shouldShowSuggestions = true;
  }

  @action
  shiftSelectedIndex(direction: number) {
    this.selectIndex(this.selectedIndex + direction);
  }

  @action
  unselect(close: boolean) {
    this.selectIndex(-1);
    this.shouldShowSuggestions = this.shouldShowSuggestions && !close;
  }

  @action
  updateQuery(query: string, locale: string) {
    const newQuery = query.trim();
    const previousQuery = this.query.trim();

    this.query = query;
    this.selectedIndex = -1;
    this.locale = locale;

    // just adding more spaces to either end of the query shouldn't perform more queries
    if (previousQuery === newQuery) return;

    this.xhr?.abort();

    if (newQuery.length > 1) {
      this.debouncedFetchSuggestions();
    } else {
      this.suggestions.length = 0;
    }
  }

  @action
  private fetchSuggestions() {
    this.xhr = $.getJSON(route('suggestions.wiki'), {
      locale: this.locale,
      query: this.query.trim(),
    })
      .done(action((response: SuggestionJson[]) => {
        if (response != null) {
          this.suggestions = observable(response);
          this.shouldShowSuggestions = true;
        }
      }));
  }
}
