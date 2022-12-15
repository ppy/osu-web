// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapsetDiscussionJson, { BeatmapsetDiscussionJsonForBundle, BeatmapsetDiscussionJsonForShow } from 'interfaces/beatmapset-discussion-json';
import BeatmapsetDiscussionPostJson from 'interfaces/beatmapset-discussion-post-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import UserJson from 'interfaces/user-json';
import { findLast, kebabCase } from 'lodash';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import { deletedUser } from 'models/user';
import core from 'osu-core-singleton';
import * as React from 'react';
import { badgeGroup, canModeratePosts, formatTimestamp, startingPost } from 'utils/beatmapset-discussion-helper';
import { classWithModifiers, groupColour } from 'utils/css';
import { trans } from 'utils/lang';
import { discussionTypeIcons } from './discussion-type';
import DiscussionVoteButtons from './discussion-vote-buttons';
import { NewReply } from './new-reply';
import Post from './post';
import SystemPost from './system-post';
import { UserCard } from './user-card';

const bn = 'beatmap-discussion';

interface PropsBase {
  beatmapset: BeatmapsetExtendedJson;
  collapsed: boolean;
  currentBeatmap: BeatmapExtendedJson;
  highlighted: boolean;
  isTimelineVisible: boolean;
  parentDiscussion?: BeatmapsetDiscussionJson;
  readPostIds?: Set<number>;
  showDeleted: boolean;
  users: Partial<Record<number | string, UserJson>>;
}

// preview version is used on pages other than the main discussions page.
type Props = PropsBase & ({
  // BeatmapsetDiscussionJsonForShow is because editing still returns
  // BeatmapsetDiscussionJsonForShow which gets merged into the parent discussions blob.
  discussion: BeatmapsetDiscussionJsonForBundle | BeatmapsetDiscussionJsonForShow;
  preview: true;
} | {
  discussion: BeatmapsetDiscussionJsonForShow;
  preview: false;
});

@observer
export class Discussion extends React.Component<Props> {
  private lastResolvedState = false;

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  @computed
  private get canBeRepliedTo() {
    return (!this.props.beatmapset.discussion_locked || canModeratePosts())
      && (this.props.discussion.beatmap_id == null || this.props.currentBeatmap.deleted_at == null);
  }

  @computed
  private get resolvedSystemPostId() {
    // TODO: handling resolved status in bundles....?
    if (this.props.preview) return -1;

    const systemPost = findLast(this.props.discussion.posts, (post) => post != null && post.system && post.message.type === 'resolve');
    return systemPost?.id ?? -1;
  }

  render() {
    if (!this.isVisible(this.props.discussion)) return null;
    const firstPost = startingPost(this.props.discussion);
    // TODO: check if possible to have null post...
    if (firstPost == null) return null;

    const lineClasses = classWithModifiers(`${bn}__line`, { resolved: this.props.discussion.resolved });

    this.lastResolvedState = false;

    const user = this.props.users[this.props.discussion.user_id] ?? deletedUser.toJson();
    const group = badgeGroup({
      beatmapset: this.props.beatmapset,
      currentBeatmap: this.props.currentBeatmap,
      discussion: this.props.discussion,
      user,
    });

    const topClasses = classWithModifiers(bn, {
      deleted: this.props.discussion.deleted_at != null,
      highlighted: this.props.highlighted,
      'horizontal-desktop': this.props.discussion.message_type !== 'review',
      preview: this.props.preview,
      review: this.props.discussion.message_type === 'review',
      timeline: this.props.discussion.timestamp != null,
      unread: !this.isRead(firstPost),
    });

    return (
      <div
        className={`${topClasses} js-beatmap-discussion-jump`}
        data-id={this.props.discussion.id}
        onClick={this.handleSetHighlight}
      >
        <div className={`${bn}__timestamp hidden-xs`}>
          {this.renderTimestamp()}
        </div>

        <div className={`${bn}__discussion`}>
          <div
            className={`${bn}__top`}
            style={groupColour(group)}
          >
            <div className={`${bn}__top-user`}>
              <UserCard group={group} hideStripe user={user} />
            </div>
            <div className={`${bn}__top-message`}>
              {this.renderPost(firstPost, 'discussion')}
            </div>
            {this.renderPostButtons()}
          </div>
          {this.postFooter()}
          <div className={lineClasses} />
        </div>
      </div>
    );
  }

  private readonly handleCollapseClick = () => {
    $.publish('beatmapset-discussions:collapse', { discussionId: this.props.discussion.id });
  };

  private readonly handleSetHighlight = (e: React.MouseEvent<HTMLDivElement>) => {
    if (e.defaultPrevented) return;
    $.publish('beatmapset-discussions:highlight', { discussionId: this.props.discussion.id });
  };

  private isOwner(object: { user_id: number }) {
    return core.currentUser != null && core.currentUser.id === object.user_id;
  }

  private isRead(post: BeatmapsetDiscussionPostJson) {
    return this.props.readPostIds?.has(post.id) || this.isOwner(post) || this.props.preview;
  }

  private isVisible(object: BeatmapsetDiscussionJson | BeatmapsetDiscussionPostJson) {
    return object != null && (this.props.showDeleted || object.deleted_at == null);
  }

  private postFooter() {
    if (this.props.preview) return null;

    let cssClasses = `${bn}__expanded`;
    if (this.props.collapsed) {
      cssClasses += ' hidden';
    }

    return (
      <div className={cssClasses}>
        <div className={`${bn}__replies`}>
          {this.props.discussion.posts.slice(1).map(this.renderReply)}
        </div>
        {this.canBeRepliedTo && (
          <NewReply
            beatmapset={this.props.beatmapset}
            currentBeatmap={this.props.currentBeatmap}
            discussion={this.props.discussion}
          />
        )}
      </div>
    );
  }

  private renderPost(post: BeatmapsetDiscussionPostJson, type: 'discussion' | 'reply') {
    const user = this.props.users[post.user_id] ?? deletedUser.toJson();

    if (post.system) {
      return (
        <SystemPost key={post.id} post={post} user={user} />
      );
    }

    return (
      <Post
        key={post.id}
        beatmap={this.props.currentBeatmap}
        beatmapset={this.props.beatmapset}
        discussion={this.props.discussion}
        post={post}
        read={this.isRead(post)}
        resolvedSystemPostId={this.resolvedSystemPostId}
        type={type}
        user={user}
        users={this.props.users}
      />
    );
  }

  private renderPostButtons() {
    if (this.props.preview) return null;

    const user = this.props.users[this.props.discussion.user_id];

    return (
      <div className={`${bn}__top-actions`}>
        <div className={`${bn}__actions`}>
          {this.props.parentDiscussion != null && (
            <a
              className={`${bn}__link-to-parent js-beatmap-discussion--jump`}
              href={BeatmapDiscussionHelper.url({ discussion: this.props.parentDiscussion })}
              title={trans('beatmap_discussions.review.go_to_parent')}
            >
              <i className='fas fa-tasks' />
            </a>
          )}
          <DiscussionVoteButtons
            cannotVote={this.isOwner(this.props.discussion) || (user?.is_bot ?? false) || !this.canBeRepliedTo}
            discussion={this.props.discussion}
            users={this.props.users}
          />
          <button
            className={`${bn}__action ${bn}__action--with-line`}
            onClick={this.handleCollapseClick}
          >
            <div
              className={classWithModifiers('beatmap-discussion-expand', { expanded: !this.props.collapsed })}
            >
              <i className='fas fa-chevron-down' />
            </div>
          </button>
        </div>
      </div>
    );
  }

  private readonly renderReply = (post: BeatmapsetDiscussionPostJson) => {
    if (!this.isVisible(post)) return null;
    if (post.system && post.message.type === 'resolve') {
      if (this.lastResolvedState === post.message.value) return null;
      this.lastResolvedState = post.message.value;
    }

    return this.renderPost(post, 'reply');
  };

  private renderTimestamp() {
    return (
      <div className='beatmap-discussion-timestamp'>
        {this.props.discussion.timestamp != null && this.props.isTimelineVisible && <div className="beatmap-discussion-timestamp__point" />}
        <div className="beatmap-discussion-timestamp__icons-container">
          <div className="beatmap-discussion-timestamp__icons">
            <div className="beatmap-discussion-timestamp__icon">
              <span className={classWithModifiers('beatmap-discussion-message-type', kebabCase(this.props.discussion.message_type))}>
                <i
                  className={discussionTypeIcons[this.props.discussion.message_type]}
                  title={trans(`beatmaps.discussions.message_type.${this.props.discussion.message_type}`)}
                />
              </span>
              {this.props.discussion.resolved && (
                <div className="beatmap-discussion-timestamp__icon beatmap-discussion-timestamp__icon--resolved">
                  <i
                    className='far fa-check-circle'
                    title={trans('beatmaps.discussions.resolved')}
                  />
                </div>
              )}
            </div>
          </div>
          {this.props.discussion.timestamp != null && (
            <div className="beatmap-discussion-timestamp__text">
              {formatTimestamp(this.props.discussion.timestamp)}
            </div>
          )}
        </div>
      </div>
    );
  }
}
