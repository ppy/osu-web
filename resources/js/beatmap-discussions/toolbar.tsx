// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetDiscussionsStore from 'interfaces/beatmapset-discussions-store';
import { action, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { canModeratePosts } from 'utils/beatmapset-discussion-helper';
import { trans } from 'utils/lang';
import DiscussionsState from './discussions-state';
import TypeFilters from './type-filters';
import { UserFilter } from './user-filter';

interface Props {
  discussionsState: DiscussionsState;
  store: BeatmapsetDiscussionsStore;
}

@observer
export default class Toolbar extends React.Component<Props> {
  private get discussionsState() {
    return this.props.discussionsState;
  }

  private get store() {
    return this.props.store;
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  render() {
    return (
      <div className='beatmapset-discussions-toolbar'>
        <div className='beatmapset-discussions-toolbar__group beatmapset-discussions-toolbar__group--filters'>
          <UserFilter
            discussionsState={this.discussionsState}
            store={this.store}
          />
          <div className='beatmapset-discussions-toolbar__type-filters'>
            <TypeFilters discussionsState={this.discussionsState} />
          </div>
        </div>
        <div className='beatmapset-discussions-toolbar__group'>
          {this.renderUserFilterToggles()}
          {this.renderShowDeletedToggle()}
        </div>
      </div>
    );
  }

  private renderShowDeletedToggle() {
    if (!canModeratePosts()) return null;

    return (
      <button
        className='beatmapset-discussions-toolbar__item'
        onClick={this.toggleShowDeleted}
        type='button'
      >
        <span>
          <span className={this.discussionsState.showDeleted ? 'fas fa-check-square' : 'far fa-square'} />
        </span>
        <span>
          {trans('beatmaps.discussions.show_deleted')}
        </span>
      </button>
    );
  }

  private renderUserFilterToggles() {
    if (this.discussionsState.selectedUserIds.size === 0) return null;

    return (
      <>
        <button
          className='beatmapset-discussions-toolbar__item'
          onClick={this.toggleIncludeReplies}
          type='button'
        >
          <span>
            <span className={this.discussionsState.repliesIncludeSelectedUsers ? 'fas fa-check-square' : 'far fa-square'} />
          </span>
          <span>
            {trans('beatmaps.discussions.include_replies')}
          </span>
        </button>
        <button
          className='beatmapset-discussions-toolbar__item'
          onClick={this.toggleShowOtherReplies}
          type='button'
        >
          <span>
            <span className={this.discussionsState.showOtherReplies ? 'fas fa-check-square' : 'far fa-square'} />
          </span>
          <span>
            {trans('beatmaps.discussions.show_other_replies')}
          </span>
        </button>
      </>
    );
  }

  @action
  private readonly toggleIncludeReplies = () => {
    this.discussionsState.repliesIncludeSelectedUsers = !this.discussionsState.repliesIncludeSelectedUsers;
  };

  @action
  private readonly toggleShowDeleted = () => {
    this.discussionsState.showDeleted = !this.discussionsState.showDeleted;
  };

  @action
  private readonly toggleShowOtherReplies = () => {
    this.discussionsState.showOtherReplies = !this.discussionsState.showOtherReplies;
  };
}
