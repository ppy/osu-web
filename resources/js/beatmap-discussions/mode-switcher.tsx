// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import StringWithComponent from 'components/string-with-component';
import BeatmapJson from 'interfaces/beatmap-json';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import { snakeCase, size } from 'lodash';
import * as React from 'react';
import { makeUrl } from 'utils/beatmapset-discussion-helper';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import CurrentDiscussions, { Filter } from './current-discussions';
import { DiscussionPage, discussionPages } from './discussion-mode';

interface Props {
  beatmapset: BeatmapsetJson;
  currentBeatmap: BeatmapJson;
  currentDiscussions: CurrentDiscussions;
  currentFilter: Filter;
  innerRef: React.RefObject<HTMLDivElement>;
  mode: DiscussionPage;
}

const selectedClassName = 'page-mode-link--is-active';

export class ModeSwitcher extends React.PureComponent<Props> {
  private scrollerRef = React.createRef<HTMLUListElement>();

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

  private renderMode = (mode: DiscussionPage) => (
    <li key={mode} className='page-mode__item'>
      <a
        className={classWithModifiers('page-mode-link', { 'is-active': this.props.mode === mode })}
        data-mode={mode}
        href={makeUrl({
          beatmapId: this.props.currentBeatmap.id,
          beatmapsetId: this.props.beatmapset.id,
          mode,
        })}
        onClick={this.switch}
      >
        <div>
          {this.renderModeText(mode)}
          {mode !== 'events' && (
            <span className='page-mode-link__badge'>
              {size(this.props.currentDiscussions.byFilter[this.props.currentFilter][mode])}
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
        ? this.props.currentBeatmap.version
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

  private readonly switch = (e: React.SyntheticEvent<HTMLAnchorElement>) => {
    e.preventDefault();

    $.publish('beatmapsetDiscussions:update', { mode: e.currentTarget.dataset.mode });
  };
}
