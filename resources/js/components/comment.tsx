// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import CommentsController, { CommentEditMode } from 'components/comments-controller';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { truncate } from 'lodash';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import CommentModel from 'models/comment';
import { canModerateComments } from 'models/comment';
import { deletedUserJson } from 'models/user';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';
import { estimateMinLines } from 'utils/estimate-min-lines';
import { formatNumberSuffixed, stripTags } from 'utils/html';
import { trans, transChoice } from 'utils/lang';
import ClickToCopy from './click-to-copy';
import CommentEditor from './comment-editor';
import CommentShowMore from './comment-show-more';
import DeletedCommentsCount from './deleted-comments-count';
import { ReportReportable } from './report-reportable';
import ShowMoreLink from './show-more-link';
import { Spinner } from './spinner';
import StringWithComponent from './string-with-component';
import TimeWithTooltip from './time-with-tooltip';
import UserAvatar from './user-avatar';
import UserLink from './user-link';

const clipLines = 7;
const maxDepth = 6;

interface Props {
  comment: CommentModel;
  controller: CommentsController;
  depth: number;
  expandReplies?: boolean;
  linkParent: boolean;
  modifiers: Modifiers;
  showCommentableMeta: boolean;
  showToolbar: boolean;
}

@observer
export default class Comment extends React.Component<Props> {
  static readonly defaultProps = {
    linkParent: false,
    showCommentableMeta: false,
    showToolbar: false,
  };

  @observable private clipped = true;
  @observable private editing = false;
  @observable private expandReplies: boolean;
  @observable private forceShow = false;
  private readonly showMoreRef = React.createRef<CommentShowMore>();
  @observable private showNewReply = false;

  private get hasVoted() {
    return this.props.controller.state.votedCommentIds.has(this.props.comment.id);
  }

  @computed
  private get isBlocked() {
    return this.props.comment.userId != null && core.currentUserModel.blocks.has(this.props.comment.userId);
  }

  private get isLongContent() {
    // Only clip if there are at least clipLines + 2 lines to ensure there are enough contents
    // being clipped instead of just single lone line (or worse no more lines because of rounding up).
    return this.lines != null && this.lines.count >= clipLines + 2;
  }

  @computed
  private get lines() {
    return estimateMinLines(this.props.comment.messageHtml ?? '');
  }

  @computed
  private get meta() {
    return this.props.controller.getCommentableMeta(this.props.comment);
  }

  @computed
  private get parentComment() {
    return this.props.comment.parentId == null
      ? undefined
      : this.props.controller.state.comments[this.props.comment.parentId];
  }

  @computed
  private get parentPreview() {
    const comment = this.parentComment;

    if (comment == null) {
      throw new Error('trying to render parent preview without parent');
    }

    return comment.isDeleted
      ? trans('comments.deleted')
      : comment.userId != null && core.currentUserModel.blocks.has(comment.userId)
        ? trans('users.blocks.comment_text')
        : truncate(stripTags(comment.messageHtml ?? ''), { length: 100 });
  }

  private get postingVote() {
    return this.props.controller.isVoting(this.props.comment);
  }

  @computed
  private get replies() {
    return this.props.controller.getReplies(this.props.comment);
  }

  @computed
  private get shouldRender() {
    if (!this.props.comment.isDeleted) {
      return true;
    }

    // always render in single comment page
    if (this.props.showToolbar) {
      return true;
    }

    if (canModerateComments() && core.userPreferences.get('comments_show_deleted')) {
      return true;
    }

    const replies = this.replies;

    return replies.some((reply) => reply.isVisible);
  }

  @computed
  private get shouldRenderContent() {
    if (this.props.comment.messageHtml == null) {
      return false;
    }

    if (canModerateComments() && core.userPreferences.get('comments_show_deleted')) {
      return true;
    }

    return !this.props.comment.isDeleted;
  }

  @computed
  private get user() {
    return this.getCommentUser(this.props.comment);
  }

  constructor(props: Props) {
    super(props);

    if (core.windowSize.isMobile) {
      // There's no indentation on mobile so don't expand by default otherwise it will be confusing.
      this.expandReplies = false;
    } else if (this.props.comment.isDeleted) {
      this.expandReplies = false;
    } else if (this.props.expandReplies != null) {
      this.expandReplies = this.props.expandReplies;
    } else {
      const children = this.replies;
      // Collapse if either no children is loaded, current level doesn't add indentation, or this comment is blocked.
      this.expandReplies = !this.isBlocked && children?.length > 0 && this.props.depth < maxDepth;
    }

    makeObservable(this);
  }

  render() {
    if (!this.shouldRender) {
      return null;
    }

    return (
      <div className={classWithModifiers(
        'comment',
        this.props.modifiers,
        { top: this.props.depth === 0 },
      )}>
        {!this.props.comment.isDeleted && this.isBlocked && !this.forceShow
          ? this.renderBlocked()
          : this.renderMain()
        }
      </div>
    );
  }

  private getCommentUser(comment: CommentModel): UserJson | { username: string } {
    return this.getUser(comment.userId) ?? (
      comment.legacyName == null
        ? deletedUserJson
        : { username: comment.legacyName }
    );
  }

  private getUser(id: number | null | undefined) {
    return this.props.controller.getUser(id);
  }

  @action
  private readonly onCloseEdit = () => {
    this.editing = false;
  };

  @action
  private readonly onCloseReplyBox = () => {
    this.showNewReply = false;
  };

  private readonly onDelete = () => {
    this.props.controller.apiDelete(this.props.comment);
  };

  private readonly onLoadReplies = () => {
    this.props.controller.apiLoadMore(this.props.comment);
    this.onToggleReplies();
  };

  @action
  private readonly onReplyPosted = (type: CommentEditMode) => {
    this.expandReplies = type === 'reply';
  };

  private readonly onRestore = () => {
    this.props.controller.apiRestore(this.props.comment);
  };

  private readonly onShowDeletedToggleClick = () => {
    core.userPreferences.set('comments_show_deleted', !core.userPreferences.get('comments_show_deleted'));
  };

  @action
  private readonly onToggleClip = () => {
    this.clipped = !this.clipped;
  };

  @action
  private readonly onToggleEdit = () => {
    this.editing = !this.editing;
  };

  @action
  private readonly onToggleForceShow = () => {
    this.forceShow = !this.forceShow;
  };

  @action
  private readonly onToggleNewReply = () => {
    this.showNewReply = !this.showNewReply;
  };

  private readonly onTogglePinned = () => {
    this.props.controller.apiTogglePin(this.props.comment);
  };

  @action
  private readonly onToggleReplies = () => {
    this.expandReplies = !this.expandReplies;
  };

  private readonly onToggleVote = () => {
    this.props.controller.apiToggleVote(this.props.comment);
  };

  private renderBlocked() {
    return (
      <div className={classWithModifiers('comment__main', 'deleted')}>
        <span
          className={this.props.depth > 0 ? 'comment__avatar' : undefined}
          style={{ height: 'auto' }}
        />

        <div className='comment__container'>
          <div className='comment__message'>
            <p className='osu-md osu-md--comment osu-md__paragraph'>
              {trans('users.blocks.comment_text')}
              {' '}
              {this.renderForceShowButton()}
            </p>
          </div>
        </div>
      </div>
    );
  }

  private readonly renderComment = (comment: CommentModel) => (
    <Comment
      key={comment.id}
      comment={comment}
      controller={this.props.controller}
      depth={this.props.depth + 1}
      expandReplies={this.props.expandReplies}
      modifiers={this.props.modifiers}
    />
  );

  private renderCommentableMeta() {
    if (!this.props.showCommentableMeta) return;

    const meta = this.meta;

    if (meta == null) return;

    return (
      <div className='comment__commentable-meta'>
        {this.props.comment.commentableType != null && (
          <span className='comment__commentable-meta-type'>
            <span className='comment__commentable-meta-icon fas fa-comment' />
            {' '}
            {trans(`comments.commentable_name.${this.props.comment.commentableType}`)}
          </span>
        )}
        {'url' in meta
          ? <a className='comment__link' href={meta.url}>{meta.title}</a>
          : <span>{meta.title}</span>
        }
      </div>
    );
  }

  private renderDelete() {
    if (this.props.comment.isDeleted || !this.props.comment.canDelete) return;

    return (
      <div className='comment__row-item'>
        <button
          className='comment__action'
          onClick={this.onDelete}
          type='button'
        >
          {trans('common.buttons.delete')}
        </button>
      </div>
    );
  }

  private renderDeletedBy() {
    if (this.props.comment.deletedAt == null || !this.props.comment.canModerate) return;

    return (
      <div className='comment__row-item comment__row-item--info'>
        <StringWithComponent
          mappings={{
            timeago: (
              <TimeWithTooltip
                dateTime={this.props.comment.deletedAt}
                relative
              />
            ),
            user: (
              this.props.comment.deletedById == null
                ? trans('comments.deleted_by_system')
                : <UserLink user={this.getUser(this.props.comment.deletedById) ?? deletedUserJson} />
            ),
          }}
          pattern={trans('comments.deleted_by')}
        />
      </div>
    );
  }

  private renderEdit() {
    if (!this.props.comment.canEdit) return;

    return (
      <div className='comment__row-item'>
        <button
          className={classWithModifiers('comment__action', { active: this.editing })}
          onClick={this.onToggleEdit}
          type='button'
        >
          {trans('common.buttons.edit')}
        </button>
      </div>
    );
  }

  private renderEditedBy() {
    if (this.props.comment.editedAt == null || this.props.comment.isDeleted) {
      return;
    }

    return (
      <div className='comment__row-item comment__row-item--info'>
        <StringWithComponent
          mappings={{
            timeago: <TimeWithTooltip dateTime={this.props.comment.editedAt} relative />,
            user: <UserLink user={this.getUser(this.props.comment.editedById) ?? deletedUserJson} />,
          }}
          pattern={trans('comments.edited')}
        />
      </div>
    );
  }

  private renderFooter() {
    return (
      <div className='comment__row comment__row--footer'>
        {this.props.comment.canHaveVote &&
          <div className='comment__row-item visible-xs'>
            {this.renderVoteButton(true)}
          </div>
        }

        <div className='comment__row-item comment__row-item--info'>
          <TimeWithTooltip dateTime={this.props.comment.createdAt} relative />
        </div>

        {this.renderPermalink()}
        {this.renderReplyButton()}
        {this.renderEdit()}
        {this.renderRestore()}
        {this.renderDelete()}
        {this.renderPin()}
        {this.renderReport()}
        {this.renderEditedBy()}
        {this.renderDeletedBy()}
        {this.renderForceShow()}
        {this.renderRepliesText()}
      </div>
    );
  }

  private renderForceShow() {
    if (!this.isBlocked || this.props.comment.isDeleted) return;

    return (
      <div className='comment__row-item'>
        {this.renderForceShowButton()}
      </div>
    );
  }

  private renderForceShowButton() {
    return (
      <button
        className='comment__action'
        onClick={this.onToggleForceShow}
        type='button'
      >
        {this.forceShow
          ? trans('users.blocks.hide_comment')
          : trans('users.blocks.show_comment')
        }
      </button>
    );
  }

  private renderMain() {
    return (
      <>
        {this.renderRepliesToggle()}
        {this.renderCommentableMeta()}
        {this.renderToolbar()}

        <div
          className={classWithModifiers('comment__main', {
            clip: this.clipped && this.isLongContent,
            deleted: this.props.comment.isDeleted || this.isBlocked,
          })}
          style={{
            '--clip-lines': clipLines,
            '--line-height': this.lines == null ? undefined : `${this.lines.lineHeight}px`,
          } as React.CSSProperties}
        >
          {this.props.comment.canHaveVote &&
            <div className='comment__float-container comment__float-container--left hidden-xs'>
              {this.renderVoteButton(false)}
            </div>
          }

          {this.renderUserAvatar()}

          <div className='comment__container'>
            <div className='comment__row comment__row--header'>
              {<UserLink className='comment__row-item' user={this.user} />}
              {this.renderOwnerBadge()}

              {this.props.comment.pinned &&
                <span className='comment__row-item  comment__row-item--pinned'>
                  <span className='fa fa-thumbtack' />
                  {' '}
                  {trans('comments.pinned')}
                </span>
              }

              {this.renderParentLink()}

              {this.props.comment.isDeleted &&
                <span className='comment__row-item comment__row-item--deleted'>
                  {trans('comments.deleted')}
                </span>
              }
            </div>

            {this.editing
              ? <div className='comment__editor'>
                <CommentEditor
                  close={this.onCloseEdit}
                  controller={this.props.controller}
                  id={this.props.comment.id}
                  message={this.props.comment.message}
                  modifiers={this.props.modifiers}
                />
              </div>
              : this.shouldRenderContent &&
              <>
                <div
                  dangerouslySetInnerHTML={{
                    __html: this.props.comment.messageHtml ?? '',
                  }}
                  className='comment__message'
                />
                {this.isLongContent && this.renderToggleClipButton()}
              </>
            }

            {this.renderFooter()}

            {this.renderReplyBox()}
          </div>
        </div>

        {this.props.comment.visibleReplyCount > 0 &&
          <div className={classWithModifiers('comment__replies', {
            hidden: !this.expandReplies,
            indented: this.props.depth < maxDepth,
          })}>
            {this.replies.map(this.renderComment)}

            <DeletedCommentsCount comments={this.replies} />

            <CommentShowMore
              ref={this.showMoreRef}
              comments={this.replies}
              controller={this.props.controller}
              label={this.replies.length === 0 ? trans('comments.load_replies') : undefined}
              modifiers={this.props.modifiers}
              parent={this.props.comment}
              total={this.props.comment.visibleReplyCount}
            />
          </div>
        }
      </>
    );
  }

  private renderOwnerBadge() {
    const meta = this.meta;

    if (meta == null || !('owner_id' in meta) || meta.owner_id == null || this.props.comment.userId !== meta.owner_id) {
      return;
    }

    return (
      <div className='comment__row-item'>
        <div className='comment__owner-badge'>{meta.owner_title}</div>
      </div>
    );
  }

  private renderParentLink() {
    const parent = this.parentComment;

    if (parent == null) return;

    const parentUser = this.getCommentUser(parent);

    const content = (
      <>
        <span className='fas fa-reply' />
        {` ${parentUser.username}`}
      </>
    );

    return (
      <span className='comment__row-item comment__row-item--parent'>
        {this.props.linkParent
          ? (
            <a
              className='comment__link'
              href={route('comments.show', { comment: parent.id })}
              title={this.parentPreview}
            >
              {content}
            </a>
          ) : (
            <span title={this.parentPreview}>{content}</span>
          )}
      </span>
    );
  }

  private renderPermalink() {
    return (
      <div className='comment__row-item'>
        <span className='comment__action comment__action--permalink'>
          <ClickToCopy
            label={trans('common.buttons.permalink')}
            value={route('comments.show', { comment: this.props.comment.id })}
            valueAsUrl
          />
        </span>
      </div>
    );
  }

  private renderPin() {
    if (!this.props.comment.canPin) return;

    return (
      <div className='comment__row-item'>
        <button
          className='comment__action'
          onClick={this.onTogglePinned}
          type='button'
        >
          {trans(`common.buttons.${this.props.comment.pinned ? 'unpin' : 'pin'}`)}
        </button>
      </div>
    );
  }

  private renderRepliesText() {
    if (this.props.comment.visibleReplyCount === 0) return;

    let label: string;
    let callback: () => void;

    if (!this.expandReplies && this.replies.length === 0) {
      callback = this.onLoadReplies;
      label = trans('comments.load_replies');
    } else {
      callback = this.onToggleReplies;
      label = transChoice('comments.replies_count', this.props.comment.repliesCount);
    }

    return (
      <div className='comment__row-item comment__row-item--replies'>
        <ShowMoreLink
          callback={callback}
          direction={this.expandReplies ? 'up' : 'down'}
          hasMore
          label={label}
          modifiers='comment-replies'
        />
      </div>
    );
  }

  private renderRepliesToggle() {
    if (this.props.depth > 0 || this.replies.length === 0) return;

    return (
      <div className='comment__float-container comment__float-container--right'>
        <button
          className='comment__top-show-replies'
          onClick={this.onToggleReplies}
          type='button'
        >
          <span className={`fas ${this.expandReplies ? 'fa-angle-up' : 'fa-angle-down'}`} />
        </button>
      </div>
    );
  }

  private renderReplyBox() {
    if (!this.showNewReply) return;

    return (
      <div className='comment__reply-box'>
        <CommentEditor
          close={this.onCloseReplyBox}
          commentableMeta={this.meta}
          controller={this.props.controller}
          modifiers={this.props.modifiers}
          onPosted={this.onReplyPosted}
          parent={this.props.comment}
        />
      </div>
    );
  }

  private renderReplyButton() {
    if (this.props.comment.isDeleted) return;

    return (
      <div className='comment__row-item'>
        <button
          className={classWithModifiers('comment__action', { active: this.showNewReply })}
          onClick={this.onToggleNewReply}
          type='button'
        >
          {trans('common.buttons.reply')}
        </button>
      </div>
    );
  }

  private renderReport() {
    if (!this.props.comment.canReport) return;

    return (
      <div className='comment__row-item'>
        <ReportReportable
          className='comment__action'
          reportableId={this.props.comment.id.toString()}
          reportableType='comment'
          user={this.user}
        />
      </div>
    );
  }

  private renderRestore() {
    if (!this.props.comment.isDeleted || !this.props.comment.canRestore) return;

    return (
      <div className='comment__row-item'>
        <button
          className='comment__action'
          onClick={this.onRestore}
          type='button'
        >
          {trans('common.buttons.restore')}
        </button>
      </div>
    );
  }

  private renderToggleClipButton() {
    return (
      <button
        className='comment__toggle-clip'
        onClick={this.onToggleClip}
        type='button'
      >
        {trans(`common.buttons.${this.clipped ? 'read_more' : 'show_less'}`)}
      </button>
    );
  }

  private renderToolbar() {
    if (!this.props.showToolbar) return;
    if (!canModerateComments()) return;

    return (
      <div className='comment__toolbar'>
        <div className='sort'>
          <div className='sort__items'>
            <button
              className='sort__item sort__item--button'
              onClick={this.onShowDeletedToggleClick}
              type='button'
            >
              <span className='sort__item-icon'>
                <span className={core.userPreferences.get('comments_show_deleted')
                  ?'fas fa-check-square'
                  : 'far fa-square'
                } />
              </span>
              {trans('common.buttons.show_deleted')}
            </button>
          </div>
        </div>
      </div>
    );
  }

  private renderUserAvatar() {
    const user = this.user;

    return ('id' in user)
      ? (
        <a
          className='comment__avatar js-usercard'
          data-user-id={user.id}
          href={route('users.show', { user: user.id })}
        >
          <UserAvatar modifiers='full-circle' user={user} />
        </a>
      ) : (
        <span className='comment__avatar'>
          <UserAvatar modifiers='full-circle' user={{ avatar_url: undefined, ...user }} />
        </span>
      );
  }

  private renderVoteButton(inline: boolean) {
    const hasVoted = this.hasVoted;

    const className = classWithModifiers('comment-vote',
      this.props.modifiers,
      {
        disabled: !this.props.comment.canVote,
        inline,
        on: hasVoted,
        posting: this.postingVote,
      },
    );

    const hover = !inline && !hasVoted
      ? <div className='comment-vote__hover'>+1</div>
      : null;

    return (
      <button
        className={className}
        disabled={this.postingVote || !this.props.comment.canVote}
        onClick={this.onToggleVote}
        type='button'
      >
        <span className='comment-vote__text'>
          +{formatNumberSuffixed(this.props.comment.votesCount)}
        </span>
        {this.postingVote &&
          <span className='comment-vote__spinner'>
            <Spinner />
          </span>
        }
        {hover}
      </button>
    );
  }
}
