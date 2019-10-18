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

import { SuggestionJSON, SuggestionsJSON } from 'interfaces/wiki-suggestion-json';
import { route } from 'laroute';
import * as React from 'react';
import { Suggestions } from 'wiki-search-suggestions';

interface State {
  highlightedSuggestion: number|null;
  originalQuery: string|null;
  suggestions: SuggestionJSON[];
}

export class WikiSearch extends React.Component<{}, State> {
  input = React.createRef<HTMLInputElement>();
  xhr: JQuery.jqXHR|null;

  constructor(props: {}) {
    super(props);

    this.state = {
      highlightedSuggestion: null,
      originalQuery: null,
      suggestions: [],
    };

    this.xhr = null;
  }

  componentDidMount() {
    const input = this.input.current;

    if (input) {
      input.focus();
    }

    $.subscribe('suggestion:mouseenter.wikiSearch', this.highlightSuggestion);
    $.subscribe('suggestion:mouseleave.wikiSearch', this.resetHighlight);
    $.subscribe('suggestion:select.wikiSearch', this.selectHighlightedSuggestion);
  }

  componentWillUnmount() {
    if (this.xhr != null) {
      this.xhr.abort();

      $.unsubscribe('.wikiSearch');
    }
  }

  getSuggestions = () => {
    const input = this.input.current;
    let query: string = '';

    if (input) {
      query = input.value;
    }

    this.setState({
      originalQuery: query,
    });

    this.resetHighlight();

    this.xhr = $.ajax(route('wiki.search-suggestions'), {
      data: {query},
      method: 'GET',
    }).done((xhr: SuggestionsJSON) => {
      // in case that an older requests arrives after a newer request
      if (input && input.value === xhr.query) {
        this.setState({
          suggestions: xhr.suggestions,
        });
      }
    });
  }

  hideSuggestions = () => {
    if (this.state.originalQuery) {
      this.updateInput(this.state.originalQuery);
    }

    this.setState({
      highlightedSuggestion: null,
      originalQuery: null,
      suggestions: [],
    });
  }

  highlightSuggestion = (e: any, position: number) => {
    this.setState({
      highlightedSuggestion: position,
    });
  }

  onInput = () => {
    const input = this.input.current;

    if (input) {
      this.getSuggestions();
    }
  }

  onKeyDown = (e: React.KeyboardEvent) => {
    switch (e.keyCode) {
      case 13: // enter
        if (this.state.highlightedSuggestion != null) {
          this.selectHighlightedSuggestion();
        } else {
          this.onSearchClick();
        }

        break;
      case 27: // escape
        this.hideSuggestions();
        break;
      case 38: // up arrow
        this.shiftSuggestion(-1);
        break;
      case 40: // down arrow
        this.shiftSuggestion(1);
    }
  }

  onSearchClick = () => {
    const input = this.input.current;

    if (input == null || input.value === '') {
      return;
    }

    this.performSearch(input.value);
  }

  performSearch(query: string) {
    Turbolinks.visit(route('search', {
      mode: 'wiki_page',
      query,
    }));
  }

  render() {
    return (
      <div className='wiki-search'>
        <div className='wiki-search__bar'>
          <input
            className='wiki-search__input'
            ref={this.input}
            placeholder={osu.trans('common.input.search')}
            autoFocus={true}
            onInput={this.onInput}
            onKeyDown={this.onKeyDown}
          />
          <button className='wiki-search__button' onClick={this.onSearchClick}>
            <i className='fa fa-search'/>
          </button>
        </div>

        <Suggestions
          suggestions={this.state.suggestions}
          visible={this.state.suggestions.length > 0}
          highlighted={this.state.highlightedSuggestion}
        />
      </div>
    );
  }

  resetHighlight = () => {
    this.setState({
      highlightedSuggestion: null,
    });
  }

  selectHighlightedSuggestion = () => {
    if (this.state.highlightedSuggestion == null) {
      return;
    }

    this.performSearch(this.state.suggestions[this.state.highlightedSuggestion].clean);
  }

  shiftSuggestion = (delta: number) => {
    if (this.state.suggestions.length === 0 || (this.state.highlightedSuggestion === null && delta === -1)) {
      return;
    }

    let newPosition: number|null = this.state.highlightedSuggestion != null ? this.state.highlightedSuggestion + delta : 0;

    if (newPosition > this.state.suggestions.length - 1) {
      newPosition--;
    } else if (newPosition === - 1) {
      newPosition = null;
    }

    this.setState({
      highlightedSuggestion: newPosition,
    });

    if (newPosition != null) {
      this.updateInput(this.state.suggestions[newPosition].clean);
    } else if (this.state.originalQuery) {
      this.updateInput(this.state.originalQuery);
    }
  }

  updateInput(newQuery: string) {
    const input = this.input.current;

    if (input) {
      input.value = newQuery;
    }
  }
}
