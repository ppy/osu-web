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
