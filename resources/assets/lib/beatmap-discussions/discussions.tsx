// Copyright (c) ppy Pty Ltd <contactthis.ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { IconExpand } from 'components/icon-expand';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import { BeatmapsetDiscussionJsonForShow } from 'interfaces/beatmapset-discussion-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import { BeatmapsetWithDiscussionsJson } from 'interfaces/beatmapset-json';
import GameMode from 'interfaces/game-mode';
import UserJson from 'interfaces/user-json';
import { BeatmapsetDiscussionJson } from 'legacy-modules';
import { size } from 'lodash';
import { observer } from 'mobx-react';
import * as React from 'react';
import { canModeratePosts } from 'utils/beatmapset-discussion-helper';
import { classWithModifiers } from 'utils/css';
import { jsonClone } from 'utils/json';
import { trans } from 'utils/lang';
import { nextVal } from 'utils/seq';
import { Discussion } from './discussion';

const bn = 'beatmap-discussions';

const sortPresets = {
  created_at: {
    sort(a: BeatmapsetDiscussionJson, b: BeatmapsetDiscussionJson) {
      if (a.created_at === b.created_at) {
        return a.id - b.id;
      } else {
        return Date.parse(a.created_at) - Date.parse(b.created_at);
      }
    },
    text: trans('beatmaps.discussions.sort.created_at'),
  },

  // there's obviously no timeline field
  timeline: {
    sort(a: BeatmapsetDiscussionJson, b: BeatmapsetDiscussionJson) {
      // TODO: this shouldnt be called when not timeline, anyway.
      if (a.timestamp == null || b.timestamp == null) {
        return 0;
      }

      if (a.timestamp === b.timestamp) {
        return a.id - b.id;
      } else {
        return a.timestamp - b.timestamp;
      }
    },
    text: trans('beatmaps.discussions.sort.timeline'),
  },
  updated_at: {
    sort(a: BeatmapsetDiscussionJson, b: BeatmapsetDiscussionJson) {
      if (a.last_post_at === b.last_post_at) {
        return b.id - a.id;
      } else {
        return Date.parse(b.last_post_at) - Date.parse(a.last_post_at);
      }
    },
    text: trans('beatmaps.discussions.sort.updated_at'),
  },
};

type Filter = 'deleted' | 'hype' | 'mapperNotes' | 'mine' | 'pending' | 'praises' | 'resolved' | 'total';
// type Mode = 'events' | 'general' | 'generalAll' | 'timeline' | 'reviews';
type Mode = 'general' | 'generalAll' | 'timeline' | 'reviews';
type Sort = 'created_at' | 'updated_at' | 'timeline';

interface CurrentDiscussions {
  byFilter: {
    deleted: DiscussionByFilter;
    hype: DiscussionByFilter;
    mapperNotes: DiscussionByFilter;
    mine: DiscussionByFilter;
    pending: DiscussionByFilter;
    praises: DiscussionByFilter;
    resolved: DiscussionByFilter;
    total: DiscussionByFilter;
  };
  countsByBeatmap: Record<number, number>;
  countsByPlaymode: Record<GameMode, number>;
  general: BeatmapsetDiscussionJson[];
  generalAll: BeatmapsetDiscussionJson[];
  reviews: BeatmapsetDiscussionJson[];
  timeline: BeatmapsetDiscussionJson[];
  timelineAllUsers: BeatmapsetDiscussionJson[];
  totalHype: number;
  unresolvedIssues: number;
}

interface DiscussionByFilter {
  general: Record<number, BeatmapsetDiscussionJson>;
  generalAll: Record<number, BeatmapsetDiscussionJson>;
  reviews: Record<number, BeatmapsetDiscussionJson>;
  timeline: Record<number, BeatmapsetDiscussionJson>;
}

interface DiscussionIdEvent {
  discussionId: number;
}

interface Props {
  beatmapset: BeatmapsetExtendedJson & BeatmapsetWithDiscussionsJson;
  currentBeatmap: BeatmapExtendedJson;
  currentDiscussions: CurrentDiscussions;
  currentFilter: Filter;
  currentUser: UserJson;
  mode: Mode;
  readPostIds: Set<number>;
  showDeleted: boolean;
  users: Record<number, UserJson>;
}

interface State {
  discussionCollapses: Record<number, boolean>;
  discussionDefaultCollapsed: boolean;
  highlightedDiscussionId: number | null;
  sort: {
    general: Sort;
    generalAll: Sort;
    reviews: Sort;
    timeline: Sort;
  };
}

@observer
export class Discussions extends React.Component<Props, State> {
  state: Readonly<State> = {
    discussionCollapses: {},
    discussionDefaultCollapsed: false,
    highlightedDiscussionId: null,
    sort: {
      general: 'updated_at',
      generalAll: 'updated_at',
      reviews: 'updated_at',
      timeline: 'timeline',
    },
  };

  private readonly eventId = `beatmapset-discussions-${nextVal()}`;

  componentDidMount() {
    $.subscribe(`beatmapset-discussions:collapse.${this.eventId}`, this.toggleCollapse);
    $.subscribe(`beatmapset-discussions:highlight.${this.eventId}`, this.setHighlight);
  }

  componentWillUnmount() {
    $.unsubscribe(`.${this.eventId}`);
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

              <button
                className={`${bn}__toolbar-item ${bn}__toolbar-item--link`}
                data-type='collapse'
                onClick={this.handleExpandClick}
                type='button'
              >
                <IconExpand expand={false} parentClass={`${bn}__toolbar-link-content`} />
                <span className={`${bn}__toolbar-link-content`}>
                  {trans('beatmaps.discussions.collapse.all-collapse')}
                </span>
              </button>
              <button
                className={`${bn}__toolbar-item ${bn}__toolbar-item--link`}
                data-type='expand'
                onClick={this.handleExpandClick}
                type='button'
              >
                <IconExpand expand parentClass={`${bn}__toolbar-link-content`} />
                <span className={`${bn}__toolbar-link-content`}>
                  {trans('beatmaps.discussions.collapse.all-expand')}
                </span>
              </button>
            </div>
          </div>

          {this.renderDiscussions()}
        </div>
      </div>
    );
  }

  private currentSort() {
    return this.state.sort[this.props.mode];
  }

  private readonly handleChangeSort = (e: React.SyntheticEvent<HTMLButtonElement>) => {
    const targetPreset = e.currentTarget.dataset.sortPreset as Sort;

    if (targetPreset === this.currentSort()) {
      return;
    }

    const sort = jsonClone(this.state.sort);
    sort[this.props.mode] = targetPreset;

    return this.setState({ sort });
  };

  private handleExpandClick = (e: React.SyntheticEvent<HTMLButtonElement>) => this.setState({
    discussionCollapses: {},
    discussionDefaultCollapsed: e.currentTarget.dataset.type === 'collapse',
  });

  private isDiscussionCollapsed(discussionId: number) {
    return this.state.discussionCollapses[discussionId] != null ? this.state.discussionCollapses[discussionId] : this.state.discussionDefaultCollapsed;
  }

  private isTimelineVisible() {
    return (this.props.mode === 'timeline') && (this.currentSort() === 'timeline');
  }

  private readonly renderDiscussionPage = (discussion: BeatmapsetDiscussionJsonForShow) => {
    if (discussion.id == null) return null; // TODO: does this still happen?

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
          collapsed={this.isDiscussionCollapsed(discussion.id)}
          currentBeatmap={this.props.currentBeatmap}
          discussion={discussion}
          highlighted={this.state.highlightedDiscussionId === discussion.id}
          isTimelineVisible={this.isTimelineVisible()}
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

        {this.isTimelineVisible() && <div className={`${bn}__timeline-line hidden-xs`} />}

        <div>
          {this.sortedDiscussions().map(this.renderDiscussionPage)}
        </div>

        {this.renderTimelineCircle()}
      </div>
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
              className={classWithModifiers('sort__item', 'button', { active: this.currentSort() === preset })}
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
        data-visibility={!this.isTimelineVisible() ? 'hidden' : undefined}
      />
    );
  }

  private readonly setHighlight = (_event: unknown, { discussionId }: DiscussionIdEvent) => {
    this.setState({ highlightedDiscussionId: discussionId });
  };

  private sortedDiscussions() {
    return this.props.currentDiscussions[this.props.mode].slice().sort((a: BeatmapsetDiscussionJson, b: BeatmapsetDiscussionJson) => {
      const mapperNoteCompare =
        // no sticky for timeline sort
        (this.currentSort() !== 'timeline') &&
        // stick the mapper note
        [a.message_type, b.message_type].includes('mapper_note') &&
        // but if both are mapper note, do base comparison
        (a.message_type !== b.message_type);

      if (mapperNoteCompare) {
        if (a.message_type === 'mapper_note') {
          return -1;
        } else {
          return 1;
        }
      } else {
        return sortPresets[this.currentSort()].sort(a, b);
      }
    });
  }

  private readonly toggleCollapse = (_event: unknown, { discussionId }: DiscussionIdEvent) => {
    const newDiscussionCollapses = Object.assign({}, this.state.discussionCollapses);
    newDiscussionCollapses[discussionId] = !this.isDiscussionCollapsed(discussionId);

    this.setState({ discussionCollapses: newDiscussionCollapses });
  };

  private readonly toggleShowDeleted = () => {
    $.publish('beatmapDiscussionPost:toggleShowDeleted');
  };
}
