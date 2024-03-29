// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import StringWithComponent from 'components/string-with-component';
import { snakeCase } from 'lodash';
import { action } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { makeUrl } from 'utils/beatmapset-discussion-helper';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import DiscussionPage, { discussionPages } from './discussion-page';
import DiscussionsState from './discussions-state';

interface Props {
  discussionsState: DiscussionsState;
  innerRef: React.RefObject<HTMLDivElement>;
}

const selectedClassName = 'page-mode-link--is-active';

@observer
export class ModeSwitcher extends React.Component<Props> {
  private readonly scrollerRef = React.createRef<HTMLUListElement>();

  private get beatmapset() {
    return this.props.discussionsState.beatmapset;
  }

  private get currentBeatmap() {
    return this.props.discussionsState.currentBeatmap;
  }

  private get currentMode() {
    return this.props.discussionsState.currentPage;
  }

  componentDidMount() {
    this.scrollModeSwitcher();
  }

  componentDidUpdate() {
    this.scrollModeSwitcher();
  }

  render() {
    return (
      <>
        <div className='page-extra-tabs-before' />
        <div ref={this.props.innerRef} className='page-extra-tabs'>
          <div className='osu-page osu-page--small'>
            <ul ref={this.scrollerRef} className='page-mode page-mode--page-extra-tabs'>
              {discussionPages.map(this.renderMode)}
            </ul>
          </div>
        </div>
      </>
    );
  }

  private readonly renderMode = (mode: DiscussionPage) => (
    <li key={mode} className='page-mode__item'>
      <a
        className={classWithModifiers('page-mode-link', { 'is-active': this.currentMode === mode })}
        data-mode={mode}
        href={makeUrl({
          beatmapId: this.currentBeatmap.id,
          beatmapsetId: this.beatmapset.id,
          mode,
        })}
        onClick={this.switch}
      >
        <div>
          {this.renderModeText(mode)}
          {mode !== 'events' && (
            <span className='page-mode-link__badge'>
              {this.props.discussionsState.discussionsForSelectedUserByMode[mode].length}
            </span>
          )}
          <span className='page-mode-link__stripe' />
        </div>
      </a>
    </li>
  );

  private renderModeText(mode: DiscussionPage) {
    if (mode === 'general' || mode === 'generalAll') {
      const text = mode === 'general'
        ? this.currentBeatmap.version
        : trans('beatmaps.discussions.mode.scopes.generalAll');

      return (
        <StringWithComponent
          mappings={{
            scope: <span className='page-mode-link__subtitle'>{`(${text})`}</span>,
          }}
          pattern={trans('beatmaps.discussions.mode.general')}
        />
      );
    }

    return trans(`beatmaps.discussions.mode.${snakeCase(mode)}`);
  }

  private scrollModeSwitcher() {
    if (this.scrollerRef.current == null) return;

    // on mobile, ModeSwitcher becomes horizontally scrollable - scrollTo ensures that the selected tab is made visible
    $(this.scrollerRef.current).scrollTo(`.${selectedClassName}`, 0, { over: { left: -1 } });
  }

  @action
  private readonly switch = (e: React.SyntheticEvent<HTMLAnchorElement>) => {
    e.preventDefault();

    this.props.discussionsState.changeDiscussionPage(e.currentTarget.dataset.mode);
  };
}
