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

import * as _ from 'lodash';
import * as React from 'react';
import SuggestionJSON from './suggestion-json';
import Suggestions from './suggestions';

interface State {
  highlightedSuggestion: number|null;
  loading: boolean;
  suggestions: SuggestionJSON[];
}

export default class Main extends React.Component<{}, State> {
  input = React.createRef<HTMLInputElement>();
  suggestionsDebounced = _.debounce(() => this.getSuggestions(), 500);
  xhr: JQuery.jqXHR|null;

  constructor(props: {}) {
    super(props);

    this.state = {
      highlightedSuggestion: null,
      loading: false,
      suggestions: [],
    };

    this.xhr = null;
    this.input = React.createRef();
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
      this.suggestionsDebounced.cancel();

      $.unsubscribe('.wikiSearch');
    }
  }

  getSuggestions = () => {
    const input = this.input.current;
    let query: string = '';

    if (input) {
      query = input.value;
    }

    this.xhr = $.ajax(laroute.route('search.suggestions'), {
      data: {
        mode: 'wiki_page',
        query,
      },
      method: 'GET',
    }).done((xhr, status) => {
      this.setState({
        suggestions: xhr.wiki_page.slice(0, 10),
      });
    }).always(() => {
      this.setState({
        loading: false,
      });
    });
  }

  hideSuggestions = () => {
    this.setState({
      highlightedSuggestion: null,
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
      const inputNotEmpty = input.value !== '';

      this.setState({
        loading: inputNotEmpty,
        suggestions: [],
      });

      if (inputNotEmpty) {
        this.suggestionsDebounced();
      } else {
        this.suggestionsDebounced.cancel();
      }
    }
  }

  onKeyDown = (e: React.KeyboardEvent) => {
    switch (e.keyCode) {
      case 13: // enter
        if (this.state.highlightedSuggestion != null) {
          this.selectHighlightedSuggestion();
        } else {
          this.performSearch();
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

  performSearch = () => {
    const input = this.input.current;

    if (input) {
      if (input.value === '') {
        return;
      }

      Turbolinks.visit(laroute.route('search', {
        mode: 'wiki_page',
        query: input.value,
      }));
    }
  }

  render() {
    return (
      <div className='wiki-search'>
        <input
          className='wiki-search__bar js-wiki-search-input'
          ref={this.input}
          placeholder={osu.trans('common.input.search')}
          onInput={this.onInput}
          onKeyDown={this.onKeyDown}
        />

        <span className='wiki-search__button fa fa-search' onClick={this.performSearch}/>

        <Suggestions
          loading={this.state.loading}
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

    Turbolinks.visit(laroute.route('wiki.show', {
      page: this.state.suggestions[this.state.highlightedSuggestion].path,
    }));
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
  }

}
