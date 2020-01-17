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
import * as React from 'react';

interface State {
  direction: number;
  selectedIndex: number;
  suggestions?: string[];
}

export class WikiSearch extends React.Component<{}, State> {
  readonly input = React.createRef<HTMLInputElement>();
  readonly state: State = {
    direction: 0,
    selectedIndex: -1,
    suggestions: [],
  };

  componentDidUpdate() {
    // scroll highlighted option into view if triggered by keys
    if (this.state.direction !== 0) {
      // FIXME: probably doesn't work on Edge?
      $('.wiki-search__suggestion--active')[0]?.scrollIntoView({ inline: 'nearest', block: 'nearest' });
    }
  }

  getSuggestions() {
    console.log(this.input.current?.value);
    $.getJSON(route('wiki-suggestions'), { q: this.input.current?.value })
    .done((response) => {
      console.log(response);
      this.setState({ suggestions: response });
    });
  }

  handleChange = () => {
    this.getSuggestions();
  }

  handleKeyDown = (e: React.KeyboardEvent) => {
    const key = e.key;

    if (key === 'Enter') {
      this.performSearch();
    }

    if (key === 'ArrowUp' || key === 'ArrowDown') {
      this.shiftSelectedIndex(key === 'ArrowDown' ? 1 : -1);
    }
  }

  handleUnselect = () => {
    this.setState({ selectedIndex: -1 });
  }

  performSearch = () => {
    const input = this.input.current;

    if (input == null || input.value === '') {
      return;
    }

    Turbolinks.visit(route('search', {
      mode: 'wiki_page',
      query: input.value,
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
            onChange={this.handleChange}
            onKeyDown={this.handleKeyDown}
          />
          <button className='wiki-search__button' onClick={this.performSearch}>
            <i className='fa fa-search'/>
          </button>
        </div>
        {this.renderSuggestions()}
      </div>
    );
  }

  renderSuggestions() {
    if (!this.state.suggestions?.length) return null;

    return (
      <div className='wiki-search__suggestions u-fancy-scrollbar' onMouseLeave={this.handleUnselect}>
        {
          this.state.suggestions.map((item, index) => {
            const setIndex = () => this.setState({ selectedIndex: index, direction: 0 });

            return (
              <div
                dangerouslySetInnerHTML={{ __html: item }}
                className={osu.classWithModifiers('wiki-search__suggestion', this.state.selectedIndex === index ? ['active'] : [])}
                key={index}
                onMouseEnter={setIndex}
              />
            );
          })
        }
      </div>
    );
  }

  private shiftSelectedIndex(direction: number) {
    const selectedIndex = this.state.selectedIndex + direction;
    if (selectedIndex < -1 || selectedIndex >= (this.state.suggestions?.length ?? 0)) return;
    this.setState({ selectedIndex, direction });
  }
}
