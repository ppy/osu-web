// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { CommentableMetaJson } from 'interfaces/comment-json';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import { Comment as CommentModel } from 'models/comment';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers, mergeModifiers, Modifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import Comment from './comment';
import CommentEditor from './comment-editor';
import CommentShowMore from './comment-show-more';
import CommentsSort from './comments-sort';
import DeletedCommentsCount from './deleted-comments-count';
import { Spinner } from './spinner';

const store = core.dataStore.commentStore;
const uiState = core.dataStore.uiState;

interface Props {
  commentableMeta: CommentableMetaJson;
  modifiers?: Modifiers;
}

@observer
export default class Comments extends React.Component<Props> {
  @computed
  private get topLevelComments() {
    const ret = [];
    for (const id of uiState.comments.topLevelCommentIds) {
      const comment = store.comments.get(id);

      if (comment != null) {
        ret.push(comment);
      }
    }

    return ret;
  }

  @computed
  private get comments() {
    return this.topLevelComments.filter((comment) => !comment.pinned);
  }

  @computed
  private get pinnedComments() {
    const ret = [];
    for (const id of uiState.comments.pinnedCommentIds) {
      const comment = store.comments.get(id);

      if (comment != null) {
        ret.push(comment);
      }
    }

    return ret;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    const comments = this.comments;
    const pinnedComments = this.pinnedComments;

    return (
      <div
        className={classWithModifiers('comments', this.props.modifiers)}
        id='comments'
      >
        <h2 className='comments__title'>
          {trans('comments.title')}
          <span className='comments__count'>{formatNumber(uiState.comments.total)}</span>
        </h2>

        {pinnedComments.length > 0 &&
          <div className='comments__items comments__items--pinned'>
            {this.renderComments(pinnedComments, true)}
          </div>
        }

        <div className='comments__new'>
          <CommentEditor
            commentableMeta={this.props.commentableMeta}
            focus={false}
            modifiers={this.props.modifiers}
          />
        </div>

        <div className='comments__items comments__items--toolbar'>
          <CommentsSort modifiers={this.props.modifiers} />
          <div className={classWithModifiers('sort', this.props.modifiers)}>
            <div className='sort__items'>
              {this.renderFollowToggle()}
              {this.renderShowDeletedToggle()}
            </div>
          </div>
        </div>

        {comments.length === 0
          ? (
            <div className='comments__items comments__items--empty'>
              {pinnedComments.length === 0 ? trans('comments.empty') : trans('comments.empty_other')}
            </div>
          ) : (
            <div className={classWithModifiers('comments__items', { loading: uiState.comments.loadingSort != null })}>
              {this.renderComments(comments, false)}

              <DeletedCommentsCount comments={this.topLevelComments} modifiers='top' />

              <CommentShowMore
                commentableMeta={this.props.commentableMeta}
                comments={this.topLevelComments}
                modifiers={mergeModifiers('top', this.props.modifiers)}
                top
                total={uiState.comments.topLevelCount}
              />
            </div>
          )}
      </div>
    );
  }

  private onToggleFollow(this: void) {
    $.publish('comments:toggle-follow');
  }

  private onToggleShowDeleted(this: void) {
    core.userPreferences.set('comments_show_deleted', !core.userPreferences.get('comments_show_deleted'));
  }

  private renderComment(comment: CommentModel, expandReplies?: boolean) {
    if (comment.isDeleted && !core.userPreferences.get('comments_show_deleted')) {
      return;
    }

    return (
      <Comment
        key={comment.id}
        comment={comment}
        depth={0}
        expandReplies={expandReplies}
        modifiers={this.props.modifiers}
      />
    );
  }

  private renderComments(comments: CommentModel[], pinned: boolean) {
    const expandReplies = pinned ? false : undefined;

    return comments.map((comment) => this.renderComment(comment, expandReplies));
  }

  private renderFollowToggle() {
    let icon: React.ReactNode;
    let label: string;

    if (uiState.comments.loadingFollow != null) {
      icon = <Spinner modifiers='center-inline' />;
    }

    if (uiState.comments.userFollow) {
      icon ??= <span className='fas fa-eye-slash' />;
      label = trans('common.buttons.watch.to_0');
    } else {
      icon ??= <span className='fas fa-eye' />;
      label = trans('common.buttons.watch.to_1');
    }

    return (
      <button
        className='sort__item sort__item--button'
        disabled={uiState.comments.loadingFollow != null}
        onClick={this.onToggleFollow}
        type='button'
      >
        <span className='sort__item-icon'>{icon}</span>
        {label}
      </button>
    );
  }

  private renderShowDeletedToggle() {
    const iconClass = core.userPreferences.get('comments_show_deleted')
      ? 'fas fa-check-square'
      : 'far fa-square';

    return (
      <button
        className='sort__item sort__item--button'
        onClick={this.onToggleShowDeleted}
        type='button'
      >
        <span className='sort__item-icon'>
          <span className={iconClass} />
        </span>
        {trans('common.buttons.show_deleted')}
      </button>
    );
  }
}
