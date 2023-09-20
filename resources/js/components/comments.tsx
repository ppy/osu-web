// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import CommentModel from 'models/comment';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers, mergeModifiers, Modifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import Comment from './comment';
import CommentEditor from './comment-editor';
import CommentShowMore from './comment-show-more';
import CommentsController, { BaseCommentableMeta } from './comments-controller';
import CommentsSort from './comments-sort';
import DeletedCommentsCount from './deleted-comments-count';
import { Spinner } from './spinner';

interface Props {
  baseCommentableMeta: BaseCommentableMeta;
  controllerStateSelector: string;
  modifiers?: Modifiers;
}

@observer
export default class Comments extends React.Component<Props> {
  private readonly controller: CommentsController;

  constructor(props: Props) {
    super(props);

    this.controller = new CommentsController(this.props.controllerStateSelector, this.props.baseCommentableMeta);
  }

  componentWillUnmount() {
    this.controller.destroy();
  }

  render() {
    const topLevelComments = this.controller.topLevelComments;
    const comments = topLevelComments.filter((comment) => !comment.pinned);
    const pinnedComments = this.controller.pinnedComments;

    return (
      <div
        className={classWithModifiers('comments', this.props.modifiers)}
        id='comments'
      >
        <h2 className='comments__title'>
          {trans('comments.title')}
          <span className='comments__count'>{formatNumber(this.controller.state.total)}</span>
        </h2>

        {pinnedComments.length > 0 &&
          <div className='comments__items comments__items--pinned'>
            {this.renderComments(pinnedComments, true)}
          </div>
        }

        <div className='comments__new'>
          <CommentEditor
            commentableMeta={this.controller.commentableMeta}
            controller={this.controller}
            focus={false}
            modifiers={this.props.modifiers}
          />
        </div>

        <div className='comments__items comments__items--toolbar'>
          <CommentsSort controller={this.controller} modifiers={this.props.modifiers} />
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
            <div className={classWithModifiers('comments__items', { loading: this.controller.nextState.sort != null })}>
              {this.renderComments(comments, false)}

              <DeletedCommentsCount comments={topLevelComments} modifiers='top' />

              <CommentShowMore
                comments={topLevelComments}
                controller={this.controller}
                modifiers={mergeModifiers('top', this.props.modifiers)}
                top
                total={this.controller.state.topLevelCount}
              />
            </div>
          )}
      </div>
    );
  }

  private readonly onToggleFollow = () => {
    this.controller.apiToggleFollow();
  };

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
        controller={this.controller}
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

    if (this.controller.nextState.isFollowing != null) {
      icon = <Spinner modifiers='center-inline' />;
    }

    if (this.controller.state.isFollowing) {
      icon ??= <span className='fas fa-eye-slash' />;
      label = trans('common.buttons.watch.to_0');
    } else {
      icon ??= <span className='fas fa-eye' />;
      label = trans('common.buttons.watch.to_1');
    }

    return (
      <button
        className='sort__item sort__item--button'
        disabled={this.controller.nextState.isFollowing != null}
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
