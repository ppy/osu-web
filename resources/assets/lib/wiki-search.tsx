// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import * as osu from 'osu-common';
import OsuUrlHelper from 'osu-url-helper';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { WikiSearchController } from 'wiki-search-controller';

@observer
export class WikiSearch extends React.Component {
  private readonly controller = new WikiSearchController();
  private keepSelectionInView = false;
  private readonly ref = React.createRef<HTMLDivElement>();

  componentDidMount() {
    document.addEventListener('keydown', this.handleEsc);
    document.addEventListener('mousedown', this.handleMouseDown);
  }

  componentDidUpdate() {
    // scroll highlighted option into view if triggered by keys
    if (this.keepSelectionInView) {
      // FIXME: probably doesn't work on Edge?
      $('.wiki-search__suggestion--active')[0]?.scrollIntoView({ block: 'nearest', inline: 'nearest' });
      this.keepSelectionInView = false;
    }
  }

  componentWillUnmount() {
    document.removeEventListener('keydown', this.handleEsc);
    document.removeEventListener('mousedown', this.handleMouseDown);
    this.controller.cancel();
  }

  handleChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    this.controller.updateQuery(event.target.value);
  };

  handleEsc = (e: KeyboardEvent) => {
    if (e.key === 'Escape') {
      this.controller.unselect(true);
    }
  };

  handleKeyDown = (e: React.KeyboardEvent) => {
    const key = e.key;

    if (key === 'Enter') {
      if (this.controller.selectedItem == null) {
        this.handleSearch();
      } else {
        osu.navigate(OsuUrlHelper.wikiUrl(this.controller.selectedItem.path));
      }
    } else if (key === 'ArrowUp' || key === 'ArrowDown') {
      this.keepSelectionInView = true;
      this.controller.shiftSelectedIndex(key === 'ArrowDown' ? 1 : -1);
    }
  };

  handleMouseDown = (e: MouseEvent) => {
    if (this.ref.current == null) return;

    if (!e.composedPath().includes(this.ref.current)) {
      this.controller.unselect(true);
    }
  };

  handleMouseLeave = () => {
    this.controller.unselect(false);
  };

  handleSearch = () => {
    this.controller.search();
  };

  render() {
    return (
      <div className='wiki-search'>
        <div className='wiki-search__bar'>
          <input
            autoFocus
            className='wiki-search__input'
            onChange={this.handleChange}
            onKeyDown={this.handleKeyDown}
            placeholder={osu.trans('common.input.search')}
            value={this.controller.displayText}
          />
          <button className='wiki-search__button' onClick={this.handleSearch}>
            <i className='fa fa-search' />
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
          this.controller.suggestions.map((item, index) => (
            <a
              key={index}
              className={classWithModifiers('wiki-search__suggestion', { active: this.controller.selectedIndex === index })}
              data-index={index}
              href={OsuUrlHelper.wikiUrl(item.path)}
              onMouseEnter={this.handleSuggestionMouseEnter}
            >
              <span dangerouslySetInnerHTML={{ __html: item.highlight }} />
            </a>
          ))
        }
      </div>
    );
  }

  private handleSuggestionMouseEnter = (e: React.SyntheticEvent<HTMLElement>) => {
    this.keepSelectionInView = false;
    this.controller.selectIndex(parseInt(e.currentTarget.dataset.index ?? '', 10));
  };
}
