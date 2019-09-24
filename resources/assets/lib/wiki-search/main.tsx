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

import * as React from 'react';

export default class Main extends React.Component {
  input = React.createRef<HTMLInputElement>();

  constructor(props: {}) {
    super(props);

    this.input = React.createRef();
  }

  componentDidMount() {
    const input = this.input.current;

    if (input) {
      input.focus();
    }
  }

  onKeyDown = (e: React.KeyboardEvent) => {
    if (e.keyCode === 13) { // enter
      this.performSearch();
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
          className='wiki-search__bar'
          ref={this.input}
          placeholder={osu.trans('common.input.search')}
          onKeyDown={this.onKeyDown}
        />

        <span className='wiki-search__button fa fa-search' onClick={this.performSearch}/>
      </div>
    );
  }
}
