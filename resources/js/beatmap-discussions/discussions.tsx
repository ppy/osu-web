// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import IconExpand from 'components/icon-expand';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapsetDiscussionJson, { BeatmapsetDiscussionJsonForShow } from 'interfaces/beatmapset-discussion-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import UserJson from 'interfaces/user-json';
import { size } from 'lodash';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { canModeratePosts } from 'utils/beatmapset-discussion-helper';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import CurrentDiscussions, { Filter } from './current-discussions';
import { Discussion } from './discussion';
import DiscussionMode from './discussion-mode';
import DiscussionsState from './discussions-state';
import DiscussionsStateContext from './discussions-state-context';

const bn = 'beatmap-discussions';

const sortPresets = {
  created_at: {
    sort(a: BeatmapsetDiscussionJson, b: BeatmapsetDiscussionJson) {
      return a.created_at === b.created_at
        ? a.id - b.id
        : Date.parse(a.created_at) - Date.parse(b.created_at);
    },
    text: trans('beatmaps.discussions.sort.created_at'),
  },
  // there's obviously no timeline field
  timeline: {
    sort(a: BeatmapsetDiscussionJson, b: BeatmapsetDiscussionJson) {
      // TODO: this shouldn't be called when not timeline, anyway.
      if (a.timestamp == null || b.timestamp == null) {
        return 0;
      }

      return a.timestamp === b.timestamp
        ? a.id - b.id
        : a.timestamp - b.timestamp;
    },
    text: trans('beatmaps.discussions.sort.timeline'),
  },
  updated_at: {
    sort(a: BeatmapsetDiscussionJson, b: BeatmapsetDiscussionJson) {
      return a.last_post_at === b.last_post_at
        ? b.id - a.id
        : Date.parse(b.last_post_at) - Date.parse(a.last_post_at);
    },
    text: trans('beatmaps.discussions.sort.updated_at'),
  },
};

type Sort = 'created_at' | 'updated_at' | 'timeline';

interface Props {
  // TODO: most of these can move to context/store after main is converted to typescript.
  beatmapset: BeatmapsetExtendedJson & BeatmapsetWithDiscussionsJson;
  currentBeatmap: BeatmapExtendedJson;
  currentDiscussions: CurrentDiscussions;
  currentFilter: Filter;
  mode: DiscussionMode;
  readPostIds: Set<number>;
  showDeleted: boolean;
  users: Record<number, UserJson>;
}

@observer
export class Discussions extends React.Component<Props> {
  @observable private discussionsState = new DiscussionsState();
  @observable private sort: Record<DiscussionMode, Sort> = {
    general: 'updated_at',
    generalAll: 'updated_at',
    reviews: 'updated_at',
    timeline: 'timeline',
  };

  @computed
  private get currentSort() {
    return this.sort[this.props.mode];
  }

  @computed
  private get isTimelineVisible() {
    return this.props.mode === 'timeline' && this.currentSort === 'timeline';
  }

  @computed
  private get sortedDiscussions() {
    return this.props.currentDiscussions[this.props.mode].slice().sort((a: BeatmapsetDiscussionJson, b: BeatmapsetDiscussionJson) => {
      const mapperNoteCompare =
        // no sticky for timeline sort
        this.currentSort !== 'timeline'
        // stick the mapper note
        && [a.message_type, b.message_type].includes('mapper_note')
        // but if both are mapper note, do base comparison
        && a.message_type !== b.message_type;

      if (mapperNoteCompare) {
        return a.message_type === 'mapper_note' ? -1 : 1;
      } else {
        return sortPresets[this.currentSort].sort(a, b);
      }
    });
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  componentDidMount() {
    $.subscribe('beatmapset-discussions:highlight', this.handleSetHighlight);
  }

  componentWillUnmount() {
    $.unsubscribe('beatmapset-discussions:highlight', this.handleSetHighlight);
  }

  render() {
    return (
      <div className='osu-page osu-page--small osu-page--full'>
        <div className={bn}>
          <div className='page-title'>
            {trans('beatmaps.discussions.title')}
          </div>
          <div className={`${bn}__toolbar`}>
            <div className={`${bn}__toolbar-content ${bn}__toolbar-content--left`}>
              <div className={`${bn}__toolbar-item`}>
                {this.renderSortOptions()}
              </div>
            </div>
            <div className={`${bn}__toolbar-content ${bn}__toolbar-content--right`}>
              {this.renderShowDeletedToggle()}
              {this.renderExpandCollapseAllButton('collapse')}
              {this.renderExpandCollapseAllButton('expand')}
            </div>
          </div>

          {this.renderDiscussions()}
        </div>
      </div>
    );
  }

  @action
  private readonly handleChangeSort = (e: React.SyntheticEvent<HTMLButtonElement>) => {
    this.sort[this.props.mode] = e.currentTarget.dataset.sortPreset as Sort;
  };

  @action
  private handleExpandClick = (e: React.SyntheticEvent<HTMLButtonElement>) => {
    this.discussionsState.discussionDefaultCollapsed = e.currentTarget.dataset.type === 'collapse';
    this.discussionsState.discussionCollapsed.clear();
  };

  @action
  private readonly handleSetHighlight = (_event: unknown, { discussionId }: { discussionId: number }) => {
    // TODO: update main to use context instead of publishing event.
    this.discussionsState.highlightedDiscussionId = discussionId;
  };

  private readonly renderDiscussionPage = (discussion: BeatmapsetDiscussionJsonForShow) => {
    const visible = this.props.currentDiscussions.byFilter[this.props.currentFilter][this.props.mode][discussion.id] != null;

    if (!visible) return null;

    const parentDiscussion = discussion.parent_id != null ? this.props.currentDiscussions.byFilter.total.reviews[discussion.parent_id] : null;

    return (
      <div
        key={discussion.id}
        className={`${bn}__discussion`}
      >
        <Discussion
          beatmapset={this.props.beatmapset}
          currentBeatmap={this.props.currentBeatmap}
          discussion={discussion}
          isTimelineVisible={this.isTimelineVisible}
          parentDiscussion={parentDiscussion}
          readPostIds={this.props.readPostIds}
          showDeleted={this.props.showDeleted}
          users={this.props.users}
        />
      </div>
    );
  };

  private renderDiscussions() {
    const discussions = this.props.currentDiscussions[this.props.mode];

    if (discussions.length === 0) {
      return (
        <div className={`${bn}__discussions ${bn}__discussions--empty`}>
          {trans('beatmaps.discussions.empty.empty')}
        </div>
      );
    }

    if (size(this.props.currentDiscussions.byFilter[this.props.currentFilter][this.props.mode]) === 0) {
      return (
        <div className={`${bn}__discussions ${bn}__discussions--empty`}>
          {trans('beatmaps.discussions.empty.hidden')}
        </div>
      );
    }

    return (
      <div className={`${bn}__discussions`}>
        {this.renderTimelineCircle()}

        {this.isTimelineVisible && <div className={`${bn}__timeline-line hidden-xs`} />}

        <DiscussionsStateContext.Provider value={this.discussionsState}>
          {this.sortedDiscussions.map(this.renderDiscussionPage)}
        </DiscussionsStateContext.Provider>

        {this.renderTimelineCircle()}
      </div>
    );
  }

  private renderExpandCollapseAllButton(type: 'collapse' | 'expand') {
    return (
      <button
        className={`${bn}__toolbar-item ${bn}__toolbar-item--link`}
        data-type={type}
        onClick={this.handleExpandClick}
        type='button'
      >
        <IconExpand expand={type === 'expand'} parentClass={`${bn}__toolbar-link-content`} />
        <span className={`${bn}__toolbar-link-content`}>
          {trans(`beatmaps.discussions.collapse.all-${type}`)}
        </span>
      </button>
    );
  }

  private renderShowDeletedToggle() {
    if (!canModeratePosts()) return null;

    return (
      <button
        className={`${bn}__toolbar-item ${bn}__toolbar-item--link`}
        onClick={this.toggleShowDeleted}
        type='button'
      >
        <span className={`${bn}__toolbar-link-content`}>
          <span className={this.props.showDeleted ? 'fas fa-check-square' : 'far fa-square'} />
        </span>
        <span className={`${bn}__toolbar-link-content`}>
          {trans('beatmaps.discussions.show_deleted')}
        </span>
      </button>
    );
  }

  private renderSortOptions() {
    const presets: Sort[] = this.props.mode === 'timeline'
      ? ['timeline', 'updated_at']
      : ['created_at', 'updated_at'];

    return (
      <div className='sort sort--beatmapset-discussions'>
        <div className='sort__items'>
          <span className='sort__item sort__item--title'>{trans('sort._')}</span>
          {presets.map((preset) => (
            <button
              key={preset}
              className={classWithModifiers('sort__item', 'button', { active: this.currentSort === preset })}
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

  private readonly toggleShowDeleted = () => {
    $.publish('beatmapDiscussionPost:toggleShowDeleted');
  };
}
