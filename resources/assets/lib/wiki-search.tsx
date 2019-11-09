/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import { route } from 'laroute';
import * as React from 'react';

export class WikiSearch extends React.Component {
  input = React.createRef<HTMLInputElement>();

  onKeyDown = (e: React.KeyboardEvent) => {
    if (e.keyCode === 13) { // enter
      this.performSearch();
    }
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
            onKeyDown={this.onKeyDown}
          />
          <button className='wiki-search__button' onClick={this.performSearch}>
            <i className='fa fa-search'/>
          </button>
        </div>
      </div>
    );
  }
}
