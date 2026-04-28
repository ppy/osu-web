// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetDiscussionJsonForShow } from 'interfaces/beatmapset-discussion-json';
import BeatmapsetDiscussionsStore from 'interfaces/beatmapset-discussions-store';
import { action, computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import { Discussion } from './discussion';
import DiscussionsState from './discussions-state';
import Sort, { sortPresets } from './sort';

const bn = 'beatmap-discussions';

interface Props {
  discussionsState: DiscussionsState;
  store: BeatmapsetDiscussionsStore;
}

@observer
export class Discussions extends React.Component<Props> {
  private get discussionsState() {
    return this.props.discussionsState;
  }

  @computed
  private get isTimelineVisible() {
    return this.discussionsState.currentPage === 'timeline' && this.discussionsState.currentSort === 'timeline';
  }

  private get store() {
    return this.props.store;
  }

  @computed
  private get sortedDiscussions() {
    if (this.discussionsState.currentPage === 'events') return [];

    const discussions = this.discussionsState.discussionsForSelectedUserByMode[this.discussionsState.currentPage];

    return discussions.slice().sort((a, b) => {
      const mapperNoteCompare =
        // no sticky for timeline sort
        this.discussionsState.currentSort !== 'timeline'
        // stick the mapper note
        && [a.message_type, b.message_type].includes('mapper_note')
        // but if both are mapper note, do base comparison
        && a.message_type !== b.message_type;

      if (mapperNoteCompare) {
        return a.message_type === 'mapper_note' ? -1 : 1;
      } else {
        return sortPresets[this.discussionsState.currentSort].sort(a, b);
      }
    });
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  render() {
    return (
      <div className={`${bn} js-beatmap-discussions`}>
        <div className='page-title'>
          {trans('beatmaps.discussions.title')}
        </div>
        <div className={`${bn}__toolbar`}>
          <div className={`${bn}__toolbar-content ${bn}__toolbar-content--left`}>
            <div className={`${bn}__toolbar-item`}>
              {this.renderSortOptions()}
            </div>
          </div>
        </div>
        {this.renderDiscussions()}
      </div>
    );
  }

  @action
  private readonly handleChangeSort = (e: React.SyntheticEvent<HTMLButtonElement>) => {
    if (this.discussionsState.currentPage === 'events') return;
    this.discussionsState.sort[this.discussionsState.currentPage] = e.currentTarget.dataset.sortPreset as Sort;
  };


  private readonly renderDiscussionPage = (discussion: BeatmapsetDiscussionJsonForShow) => {
    const parentDiscussion = this.store.discussions.get(discussion.parent_id);

    return (
      <Discussion
        key={discussion.id}
        discussion={discussion}
        discussionsState={this.discussionsState}
        isTimelineVisible={this.isTimelineVisible}
        parentDiscussion={parentDiscussion?.message_type === 'review' ? parentDiscussion : null}
        store={this.store}
      />
    );
  };

  private renderDiscussions() {
    const count = this.sortedDiscussions.length;

    if (count === 0) {
      return (
        <div className={`${bn}__discussions ${bn}__discussions--empty`}>
          {this.discussionsState.discussionsByFilter.total.length > count
            ? trans('beatmaps.discussions.empty.hidden')
            : trans('beatmaps.discussions.empty.empty')
          }
        </div>
      );
    }

    return (
      <div className={`${bn}__discussions`}>
        {this.renderTimelineCircle()}

        {this.isTimelineVisible && <div className={`${bn}__timeline-line hidden-xs`} />}

        {this.sortedDiscussions.map(this.renderDiscussionPage)}

        {this.renderTimelineCircle()}
      </div>
    );
  }

  private renderSortOptions() {
    const presets: Sort[] = this.discussionsState.currentPage === 'timeline'
      ? ['timeline', 'updated_at']
      : ['created_at', 'updated_at'];

    return (
      <div className='sort sort--beatmapset-discussions'>
        <div className='sort__items'>
          <span className='sort__item sort__item--title'>{trans('sort._')}</span>
          {presets.map((preset) => (
            <button
              key={preset}
              className={classWithModifiers('sort__item', 'button', { active: this.discussionsState.currentSort === preset })}
              data-sort-preset={preset}
              onClick={this.handleChangeSort}
              type='button'
            >
              {sortPresets[preset].text}
            </button>
          ))}
        </div>
      </div>
    );
  }

  private renderTimelineCircle() {
    return (
      <div
        className={`${bn}__mode-circle ${bn}__mode-circle--active hidden-xs`}
        data-visibility={!this.isTimelineVisible ? 'hidden' : undefined}
      />
    );
  }
}
