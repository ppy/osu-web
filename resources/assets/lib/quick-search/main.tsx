// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Spinner } from 'components/spinner';
import StringWithComponent from 'components/string-with-component';
import { route } from 'laroute';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import Beatmapset from './beatmapset';
import User from './user';
import { ResultMode, Section } from './worker';
import Worker from './worker';

interface Props {
  modifiers?: string[];
  onClose?: () => void;
  worker: Worker;
}

const otherModes: ResultMode[] = ['forum_post', 'wiki_page'];

@observer export default class QuickSearch extends React.Component<Props> {
  private inputRef = React.createRef<HTMLInputElement>();

  focus = () => {
    if (this.inputRef.current != null) {
      this.inputRef.current.selectionStart = 0;
      this.inputRef.current.selectionEnd = this.inputRef.current.value.length;

      this.props.worker.selectNone();

      this.inputRef.current?.focus();
    }
  };

  render() {
    let blockClass = classWithModifiers('quick-search', this.props.modifiers);
    blockClass += ' u-fancy-scrollbar';

    return (
      <div className={blockClass}>
        <div className='quick-search-input'>
          <div className='quick-search-input__field'>
            <span className='quick-search-input__icon'>
              {this.props.worker.searching ? <Spinner /> : <span className='fas fa-search' />}
            </span>

            <input
              ref={this.inputRef}
              className='quick-search-input__input js-click-menu--autofocus'
              onChange={this.updateQuery}
              onKeyDown={this.onInputKeyDown}
              placeholder={osu.trans('home.search.placeholder')}
              value={this.props.worker.query}
            />
          </div>

          {this.props.onClose != null && (
            <button
              className='btn-osu-big btn-osu-big--quick-search-close'
              onClick={this.props.onClose}
              type='button'
            >
              {osu.trans('common.buttons.close')}
            </button>
          )}
        </div>

        {this.renderResult()}
      </div>
    );
  }

  private boxIsActive(section: Section, idx: number): boolean {
    const worker = this.props.worker;
    return worker.currentSection === section && worker.selected?.index === idx;
  }

  private count(mode: ResultMode) {
    if (this.props.worker.searchResult === null) {
      return 0;
    }

    return this.props.worker.searchResult[mode].total;
  }

  private navigateToSelected() {
    const url = this.props.worker.selectedURL;
    if (url) {
      osu.navigate(url, false);
    }
  }

  private onInputKeyDown = (event: React.KeyboardEvent<HTMLInputElement>) => {
    const key = event.key;
    if (key === 'Enter') {
      this.props.worker.debouncedSearch.flush();
      this.navigateToSelected();
    }
    if (key === 'ArrowUp' || key === 'ArrowDown') {
      this.props.worker.cycleSelectedItem(key === 'ArrowDown' ? 1 : -1);
    }
  };

  private onMouseEnter = (event: React.MouseEvent<HTMLDivElement>) => {
    const section = event.currentTarget.dataset.section as Section;
    const index = parseInt(event.currentTarget.dataset.index ?? '0', 10);

    this.selectBox(section, index);
  };

  private onMouseLeave = () => {
    this.props.worker.selectNone();
  };

  private renderBeatmapsets() {
    if (this.props.worker.searchResult === null) {
      return null;
    }

    return (
      <div className='quick-search-items'>
        {this.props.worker.searchResult.beatmapset.beatmapsets.map((beatmapset, idx) => (
          <div
            key={beatmapset.id}
            className='quick-search-items__item'
            data-index={idx}
            data-section='beatmapset'
            onMouseEnter={this.onMouseEnter}
            onMouseLeave={this.onMouseLeave}
          >
            <Beatmapset
              beatmapset={beatmapset}
              modifiers={this.boxIsActive('beatmapset', idx) ? ['active'] : []}
            />
          </div>
        ))}

        <div
          className='quick-search-items__item'
          data-section='beatmapset_others'
          onMouseEnter={this.onMouseEnter}
          onMouseLeave={this.onMouseLeave}
        >
          {this.renderResultLink('beatmapset', this.boxIsActive('beatmapset_others', 0))}
        </div>
      </div>
    );
  }

  private renderMoreOtherResultLink() {
    const modes = otherModes.filter((mode) => this.count(mode) > 0);

    if (modes.length === 0) {
      return null;
    }

    return (
      <div className='quick-search-items'>
        {modes.map((mode, idx) => (
          <div
            key={mode}
            className='quick-search-items__item'
            data-index={idx}
            data-section='others'
            onMouseEnter={this.onMouseEnter}
            onMouseLeave={this.onMouseLeave}
          >
            {this.renderResultLink(mode, this.boxIsActive('others', idx))}
          </div>
        ))}
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
        {modes.map((mode) => (
          <div key={mode} className='quick-search-items__item'>
            {osu.trans('quick_search.result.empty_for', { modes: osu.trans(`quick_search.mode.${mode}`) })}
          </div>
        ))}
      </div>
    );
  }

  private renderOthers() {
    if (this.count('forum_post') === 0 && this.count('wiki_page') === 0) {
      return (
        <span className='quick-search-items quick-search-items--empty'>
          {osu.trans('quick_search.result.empty_for', {
            modes: osu.transArray([
              osu.trans('quick_search.mode.forum_post'),
              osu.trans('quick_search.mode.wiki_page'),
            ]),
          })}
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

  private renderResultLink(mode: ResultMode, active = false) {
    let key = 'quick_search.result.';

    key += otherModes.includes(mode) ? 'title' : 'more';

    return (
      <a
        className={classWithModifiers('search-result-more', active ? ['active'] : [])}
        href={route('search', { mode, query: this.props.worker.query })}
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
          mappings={{ mode: <strong>{osu.trans(`quick_search.mode.${mode}`)}</strong> }}
          pattern={osu.trans('quick_search.result.title')}
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
        {this.props.worker.searchResult.user.users.map((user, idx) => (
          <div
            key={user.id}
            className='quick-search-items__item'
            data-index={idx}
            data-section='user'
            onMouseEnter={this.onMouseEnter}
            onMouseLeave={this.onMouseLeave}
          >
            <User
              modifiers={this.boxIsActive('user', idx) ? ['active'] : []}
              user={user}
            />
          </div>
        ))}

        {this.count('user') > this.props.worker.searchResult.user.users.length && (
          <div
            className='quick-search-items__item'
            data-section='user_others'
            onMouseEnter={this.onMouseEnter}
            onMouseLeave={this.onMouseLeave}
          >
            {this.renderResultLink('user', this.boxIsActive('user_others', 0))}
          </div>
        )}
      </div>
    );
  }

  private selectBox(section: Section, index = 0) {
    this.props.worker.setSelected(section, index);
  }

  private updateQuery = (event: React.SyntheticEvent<HTMLInputElement>) => {
    this.props.worker.updateQuery(event.currentTarget.value);
  };
}
