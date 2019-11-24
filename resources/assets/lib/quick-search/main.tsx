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
import { Modal } from 'modal';
import * as React from 'react';
import { Spinner } from 'spinner';
import { StringWithComponent } from 'string-with-component';
import Beatmapset from './beatmapset';
import User from './user';
import { ResultMode } from './worker';
import Worker from './worker';

interface Props {
  worker: Worker;
}

interface State {
  open: boolean;
}

const otherModes: ResultMode[] = ['forum_post', 'wiki_page'];

@observer export default class QuickSearch extends React.Component<Props, State> {
  searchPath = route('search', null, false);
  state = { open: false };

  private inputRef = React.createRef<HTMLInputElement>();

  private get isSearchPage() {
    return document.location.pathname === this.searchPath;
  }

  componentDidUpdate(prevProps: Props, prevState: State) {
    if (this.inputRef.current != null && prevState.open !== this.state.open && this.state.open) {
      this.inputRef.current.selectionStart = 0;
      this.inputRef.current.selectionEnd = this.inputRef.current.value.length;
      this.inputRef.current.focus();
    }
  }

  render() {
    let className = 'nav2__menu-link-main nav2__menu-link-main--search';

    if (this.state.open || document.location.pathname === route('search', null, false)) {
      className += ' u-section--bg-normal';
    }

    return (
      <>
        <a
          className={className}
          href={route('search')}
          onClick={this.toggle}
        >
          <span className='fas fa-search' />
        </a>
        {this.renderModal()}
      </>
    );
  }

  private count(mode: ResultMode) {
    if (this.props.worker.searchResult === null) {
      return 0;
    }

    return this.props.worker.searchResult[mode].total;
  }

  private onInputKeyDown = (event: React.KeyboardEvent<HTMLInputElement>) => {
    if (event.key === 'Enter') {
      this.props.worker.debouncedSearch.flush();
    }
  }

  private renderBeatmapsets() {
    if (this.props.worker.searchResult == null) {
      return null;
    }

    if (this.count('beatmapset') === 0) {
      return (
        <span className='quick-search-items quick-search-items--empty'>
          {osu.trans('quick_search.result.empty', { mode: osu.trans('quick_search.mode.beatmapset') })}
        </span>
      );
    }

    return (
      <div className='quick-search-items'>
        {this.props.worker.searchResult.beatmapset.beatmapsets.map((beatmapset) => {
          return (
            <div key={beatmapset.id} className='quick-search-items__item'>
              <Beatmapset beatmapset={beatmapset} />
            </div>
          );
        })}

        {this.count('beatmapset') > this.props.worker.searchResult.beatmapset.beatmapsets.length
          ? (
            <div className='quick-search-items__item'>
              {this.renderResultLink('beatmapset')}
            </div>
          ) : null
        }
      </div>
    );
  }

  private renderModal() {
    if (!this.state.open || this.isSearchPage) {
      return null;
    }

    return (
      <Modal visible={true} onClose={this.toggle}>
        <div className='quick-search u-fancy-scrollbar'>
          <div className='quick-search-input'>
            <div className='quick-search-input__field'>
              <span className='quick-search-input__icon'>
                {this.props.worker.searching ? <Spinner /> : <span className='fas fa-search' />}
              </span>

              <input
                className='quick-search-input__input'
                ref={this.inputRef}
                placeholder={osu.trans('home.search.placeholder')}
                value={this.props.worker.query}
                onChange={this.updateQuery}
                onKeyDown={this.onInputKeyDown}
              />
            </div>

            <button
              type='button'
              className='btn-osu-big btn-osu-big--quick-search-close'
              onClick={this.toggle}
            >
              {osu.trans('common.buttons.close')}
            </button>
          </div>

          {this.renderResult()}
        </div>
      </Modal>
    );
  }

  private renderMoreOtherResultLink() {
    const modes = otherModes.filter((mode) => this.count(mode) > 0);

    if (modes.length === 0) {
      return null;
    }

    return (
      <div className='quick-search-items'>
        {modes.map((mode) => {
          return (
            <div key={mode} className='quick-search-items__item'>
              {this.renderResultLink(mode)}
            </div>
          );
        })}
      </div>
    );
  }

  private renderNoMoreOtherResultLink() {
    const modes = otherModes.filter((mode) => this.count(mode) === 0);

    if (modes.length === 0) {
      return null;
    }

    return (
      <div className='quick-search-items quick-search-items--empty'>
        {modes.map((mode) => {
          return (
            <div key={mode} className='quick-search-items__item'>
              {osu.trans('quick_search.result.empty_for', { modes: osu.trans(`quick_search.mode.${mode}`) })}
            </div>
          );
        })}
      </div>
    );
  }

  private renderOthers() {
    if (this.count('forum_post') === 0 && this.count('wiki_page') === 0) {
      return (
        <span className='quick-search-items quick-search-items--empty'>
          {osu.trans('quick_search.result.empty_for', { modes: osu.transArray([
            osu.trans('quick_search.mode.forum_post'),
            osu.trans('quick_search.mode.wiki_page'),
          ]) })}
        </span>
      );
    }

    return (
      <>
        {this.renderMoreOtherResultLink()}
        {this.renderNoMoreOtherResultLink()}
      </>
    );
  }

  private renderResult() {
    if (this.props.worker.searchResult == null) {
      return null;
    }

    return (
      <div className='quick-search-result'>
        <div className='quick-search-result__item'>
          {this.renderTitle('user')}
          {this.renderUsers()}
        </div>

        <div className='quick-search-result__item'>
          {this.renderTitle('beatmapset')}
          {this.renderBeatmapsets()}
        </div>

        <div className='quick-search-result__item'>
          {this.renderTitle('other')}
          {this.renderOthers()}
        </div>
      </div>
    );
  }

  private renderResultLink(mode: ResultMode) {
    let key = 'quick_search.result.';

    key += otherModes.includes(mode) ? 'title' : 'more';

    return (
      <a
        href={route('search', { mode, query: this.props.worker.query })}
        className='search-result-more'
      >
        <div className='search-result-more__content'>
          {osu.trans(key, { mode: osu.trans(`quick_search.mode.${mode}`) })}
          <span className='search-result-more__count'>
            {osu.formatNumber(this.count(mode))}
          </span>
        </div>
        <div className='search-result-more__arrow'>
          <span className='fas fa-angle-right' />
        </div>
      </a>
    );
  }

  private renderTitle(mode: string) {
    return (
      <h2 className='title'>
        <StringWithComponent
          pattern={osu.trans('quick_search.result.title')}
          mappings={{ ':mode': <strong key='mode'>{osu.trans(`quick_search.mode.${mode}`)}</strong> }}
        />
      </h2>
    );
  }

  private renderUsers() {
    if (this.props.worker.searchResult == null) {
      return null;
    }

    if (this.count('user') === 0) {
      return (
        <span className='quick-search-items quick-search-items--empty'>
          {osu.trans('quick_search.result.empty', { mode: osu.trans('quick_search.mode.beatmapset') })}
        </span>
      );
    }

    return (
      <div className='quick-search-items'>
        {this.props.worker.searchResult.user.users.map((user) => {
          return (
            <div key={user.id} className='quick-search-items__item'>
              <User user={user} />
            </div>
          );
        })}

        {this.count('user') > this.props.worker.searchResult.user.users.length
          ? (
            <div className='quick-search-items__item'>
              {this.renderResultLink('user')}
            </div>
          ) : null
        }
      </div>
    );
  }

  private toggle = (event?: React.SyntheticEvent<HTMLElement>) => {
    if (event != null) {
      event.preventDefault();
    }

    if (this.isSearchPage) {
      $('.js-search--input').focus();

      return;
    }

    this.setState({ open: !this.state.open });
  }

  private updateQuery = (event: React.SyntheticEvent<HTMLInputElement>) => {
    this.props.worker.updateQuery(event.currentTarget.value);
  }
}
