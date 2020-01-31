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
import { observer } from 'mobx-react';
import * as React from 'react';
import { WikiSearchController } from 'wiki-search-controller';

@observer
export class WikiSearch extends React.Component {
  private readonly controller = new WikiSearchController();
  private readonly ref = React.createRef<HTMLDivElement>();

  componentDidMount() {
    document.addEventListener('keydown', this.handleEsc);
    document.addEventListener('mousedown', this.handleMouseDown);
  }

  componentDidUpdate() {
    // scroll highlighted option into view if triggered by keys
    if (this.controller.direction !== 0) {
      // FIXME: probably doesn't work on Edge?
      $('.wiki-search__suggestion--active')[0]?.scrollIntoView({ inline: 'nearest', block: 'nearest' });
    }
  }

  componentWillUnmount() {
    document.removeEventListener('keydown', this.handleEsc);
    document.removeEventListener('mousedown', this.handleMouseDown);
    this.controller.cancel();
  }

  handleChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    this.controller.updateQuery(event.target.value);
  }

  handleEsc = (e: KeyboardEvent) => {
    if (e.key === 'Escape') {
      this.controller.selectIndex(-1, -1);
    }
  }

  handleKeyDown = (e: React.KeyboardEvent) => {
    const key = e.key;

    if (key === 'Enter') {
      this.handleSearch();
    } else if (key === 'ArrowUp' || key === 'ArrowDown') {
      this.controller.shiftSelectedIndex(key === 'ArrowDown' ? 1 : -1);
    }
  }

  handleMouseDown = (e: MouseEvent) => {
    if (this.ref.current == null) return;

    if (!e.composedPath().includes(this.ref.current)) {
      this.controller.selectIndex(-1, -1);
    }
  }

  handleMouseLeave = () => {
    this.controller.selectIndex(-1, 0);
  }

  handleSearch = () => {
    this.controller.search();
  }

  render() {
    return (
      <div className='wiki-search'>
        <div className='wiki-search__bar'>
          <input
            autoFocus={true}
            className='wiki-search__input'
            value={this.controller.query}
            onChange={this.handleChange}
            onKeyDown={this.handleKeyDown}
            placeholder={osu.trans('common.input.search')}
          />
          <button className='wiki-search__button' onClick={this.handleSearch}>
            <i className='fa fa-search'/>
          </button>
        </div>
        {this.renderSuggestions()}
      </div>
    );
  }

  renderSuggestions() {
    if (!this.controller.isSuggestionsVisible) return null;

    return (
      <div ref={this.ref} className='wiki-search__suggestions u-fancy-scrollbar' onMouseLeave={this.handleMouseLeave}>
        {
          this.controller.suggestions.map((item, index) => {
            const setIndex = () => this.controller.selectIndex(index, 0);
            const href = route('wiki.show', { page: item.path });

            return (
              <a
                className={osu.classWithModifiers('wiki-search__suggestion', this.controller.selectedIndex === index ? ['active'] : [])}
                href={href}
                key={index}
                onMouseEnter={setIndex}
              >
                <span dangerouslySetInnerHTML={{ __html: item.highlight }} />
              </a>
            );
          })
        }
      </div>
    );
  }
}
