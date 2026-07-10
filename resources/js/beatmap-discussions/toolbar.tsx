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

interface OptionButtonProps {
  checked: boolean;
  onClick: () => void;
  text: string;
}

function OptionButton(props: OptionButtonProps) {
  return (
    <button
      className='beatmapset-discussions-toolbar__item'
      onClick={props.onClick}
      type='button'
    >
      <span>
        <span className={props.checked ? 'fas fa-check-square' : 'far fa-square'} />
      </span>
      <span>
        {props.text}
      </span>
    </button>
  );
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
      <OptionButton
        checked={this.discussionsState.showDeleted}
        onClick={this.toggleShowDeleted}
        text={trans('beatmaps.discussions.show_deleted')}
      />
    );
  }

  private renderUserFilterToggles() {
    if (this.discussionsState.selectedUserIds.size === 0) return null;

    return (
      <>
        <OptionButton
          checked={this.discussionsState.repliesIncludeSelectedUsers}
          onClick={this.toggleIncludeReplies}
          text={trans('beatmaps.discussions.include_replies')}
        />
        <OptionButton
          checked={this.discussionsState.showOtherReplies}
          onClick={this.toggleShowOtherReplies}
          text={trans('beatmaps.discussions.show_other_replies')}
        />
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
