// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetDiscussionJson, { BeatmapsetDiscussionJsonForBundle, BeatmapsetDiscussionJsonForShow } from 'interfaces/beatmapset-discussion-json';
import BeatmapsetDiscussionPostJson from 'interfaces/beatmapset-discussion-post-json';
import BeatmapsetDiscussionsStore from 'interfaces/beatmapset-discussions-store';
import { findLast } from 'lodash';
import { action, computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import { deletedUserJson } from 'models/user';
import core from 'osu-core-singleton';
import * as React from 'react';
import { badgeGroup, canModeratePosts, formatTimestamp, makeUrl, startingPost } from 'utils/beatmapset-discussion-helper';
import { downloadLimited } from 'utils/beatmapset-helper';
import { classWithModifiers, groupColour } from 'utils/css';
import { trans } from 'utils/lang';
import { DiscussionType, discussionTypeIcons } from './discussion-type';
import DiscussionVoteButtons from './discussion-vote-buttons';
import DiscussionsState from './discussions-state';
import { NewReply } from './new-reply';
import Post from './post';
import SystemPost from './system-post';
import { UserCard } from './user-card';

const bn = 'beatmap-discussion';

interface BaseProps {
  isTimelineVisible: boolean;
  parentDiscussion?: BeatmapsetDiscussionJson | null;
  store: BeatmapsetDiscussionsStore;
}

type Props = BaseProps & ({
  discussion: BeatmapsetDiscussionJsonForBundle;
  discussionsState: null; // TODO: make optional?
} | {
  discussion: BeatmapsetDiscussionJsonForShow;
  discussionsState: DiscussionsState;
});

function DiscussionTypeIcon({ type }: { type: DiscussionType | 'resolved' }) {
  const titleKey = type === 'resolved'
    ? 'beatmaps.discussions.resolved'
    : `beatmaps.discussions.message_type.${type}`;

  return (
    <span
      className={discussionTypeIcons[type]}
      style={{ color: `var(--beatmapset-discussion-colour--${type})` }}
      title={trans(titleKey)}
    />
  );
}

@observer
export class Discussion extends React.Component<Props> {
  private lastResolvedState = false;

  private get beatmapset() {
    return this.props.discussionsState?.beatmapset;
  }

  private get currentBeatmap() {
    return this.props.discussionsState?.currentBeatmap;
  }

  @computed
  private get canBeRepliedTo() {
    return this.beatmapset != null
      && !downloadLimited(this.beatmapset)
      && (!this.beatmapset.discussion_locked || canModeratePosts())
      && (this.props.discussion.beatmap_id == null || this.currentBeatmap?.deleted_at == null);
  }

  @computed
  private get collapsed() {
    return this.props.discussionsState?.discussionCollapsed.get(this.props.discussion.id) ?? this.props.discussionsState?.discussionDefaultCollapsed ?? false;
  }

  @computed
  private get highlighted() {
    return this.props.discussionsState?.highlightedDiscussionId === this.props.discussion.id;
  }

  private get readonly() {
    return this.props.discussionsState == null;
  }

  private get readPostIds() {
    return this.props.discussionsState?.readPostIds;
  }

  @computed
  private get resolvedStateChangedPostId() {
    // TODO: handling resolved status in bundles....?
    if (this.props.discussionsState == null) return -1;

    const systemPost = findLast(this.props.discussion.posts, (post) => post.system && post.message.type === 'resolved');
    return systemPost?.id ?? -1;
  }

  private get showDeleted() {
    return this.props.discussionsState?.showDeleted ?? true;
  }

  private get users() {
    return this.props.store.users;
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  render() {
    if (!this.isVisible(this.props.discussion)) return null;
    const firstPost = startingPost(this.props.discussion);
    // firstPost shouldn't be null anymore;
    // just simpler to allow startingPost to return undefined and adding a null check in render.
    if (firstPost == null) return null;

    const lineClasses = classWithModifiers(`${bn}__line`, { resolved: this.props.discussion.resolved });

    this.lastResolvedState = false;

    const user = this.users.get(this.props.discussion.user_id) ?? deletedUserJson;
    const group = badgeGroup({
      beatmapset: this.beatmapset,
      currentBeatmap: this.currentBeatmap,
      discussion: this.props.discussion,
      user,
    });

    const topClasses = classWithModifiers(bn, {
      deleted: this.props.discussion.deleted_at != null,
      highlighted: this.highlighted,
      'horizontal-desktop': this.props.discussion.message_type !== 'review',
      preview: this.readonly,
      review: this.props.discussion.message_type === 'review',
      timeline: this.props.discussion.timestamp != null,
      unread: !this.isRead(firstPost),
    });

    return (
      <div
        className={`${topClasses}`}
        onClick={this.handleSetHighlight}
        style={{
          '--discussion-colour': `var(--beatmapset-discussion-colour--${this.props.discussion.message_type})`,
        } as React.CSSProperties}
      >
        <div className={`${bn}__timestamp hidden-xs`}>
          {this.renderTimestamp()}
        </div>
        {/* jump is here instead of the top to have the margin on the element so that Chrome will anchor properly when an image lazy loads. */}
        <div className={`${bn}__discussion js-beatmap-discussion-jump`} data-id={this.props.discussion.id}>
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
          {this.renderReplies()}
          <div className={lineClasses} />
        </div>
      </div>
    );
  }

  @action
  private readonly handleCollapseClick = () => {
    this.props.discussionsState?.discussionCollapsed.set(this.props.discussion.id, !this.collapsed);
  };

  @action
  private readonly handleSetHighlight = (e: React.MouseEvent<HTMLDivElement>) => {
    if (e.defaultPrevented || this.props.discussionsState == null) return;
    this.props.discussionsState.highlightedDiscussionId = this.props.discussion.id;
  };

  private isOwner(object: { user_id: number }) {
    return core.currentUser != null && core.currentUser.id === object.user_id;
  }

  private isRead(post: BeatmapsetDiscussionPostJson) {
    return this.readPostIds?.has(post.id) || this.isOwner(post) || this.readonly;
  }

  private isVisible(object: BeatmapsetDiscussionJson | BeatmapsetDiscussionPostJson) {
    return object != null && (this.showDeleted || object.deleted_at == null);
  }

  private renderPost(post: BeatmapsetDiscussionPostJson, type: 'discussion' | 'reply') {
    const user = this.users.get(post.user_id) ?? deletedUserJson;

    if (post.system) {
      return (
        <SystemPost key={post.id} post={post} user={user} />
      );
    }

    return (
      <Post
        key={post.id}
        discussion={this.props.discussion}
        discussionsState={this.props.discussionsState}
        post={post}
        read={this.isRead(post)}
        readonly={this.readonly}
        resolvedStateChangedPostId={this.resolvedStateChangedPostId}
        store={this.props.store}
        type={type}
        user={user}
      />
    );
  }

  private renderPostButtons() {
    if (this.props.discussionsState == null) {
      return null;
    }

    const user = this.props.store.users.get(this.props.discussion.user_id);

    return (
      <div className={`${bn}__top-actions`}>
        <div className={`${bn}__actions`}>
          {this.props.parentDiscussion != null && (
            <a
              className={`${bn}__link-to-parent js-beatmap-discussion--jump`}
              href={makeUrl({ discussion: this.props.parentDiscussion })}
              title={trans('beatmap_discussions.review.go_to_parent')}
            >
              <i className='fas fa-tasks' />
            </a>
          )}
          <span className='visible-xs'>
            <DiscussionTypeIcon type={this.props.discussion.message_type} />
          </span>
          <DiscussionVoteButtons
            cannotVote={this.isOwner(this.props.discussion) || (user?.is_bot ?? false) || !this.canBeRepliedTo}
            discussion={this.props.discussion}
            discussionsState={this.props.discussionsState}
            users={this.users}
          />
          <button
            className={`${bn}__action ${bn}__action--with-line`}
            onClick={this.handleCollapseClick}
          >
            <div
              className={classWithModifiers('beatmap-discussion-expand', { expanded: !this.collapsed })}
            >
              <i className='fas fa-chevron-down' />
            </div>
          </button>
        </div>
      </div>
    );
  }

  private renderReplies() {
    if (this.props.discussionsState == null) return null;

    let cssClasses = `${bn}__expanded`;
    if (this.collapsed) {
      cssClasses += ' hidden';
    }

    return (
      <div className={cssClasses}>
        <div className={`${bn}__replies`}>
          {this.props.discussion.posts.slice(1).map(this.renderReply)}
        </div>
        {this.props.discussionsState != null && this.canBeRepliedTo && (
          <NewReply
            discussion={this.props.discussion}
            discussionsState={this.props.discussionsState}
          />
        )}
      </div>
    );
  }

  private readonly renderReply = (post: BeatmapsetDiscussionPostJson) => {
    if (!this.isVisible(post)) return null;
    if (post.system && post.message.type === 'resolved') {
      if (this.lastResolvedState === post.message.value) return null;
      this.lastResolvedState = post.message.value;
    }

    return this.renderPost(post, 'reply');
  };

  private renderTimestamp() {
    return (
      <div className={classWithModifiers('beatmap-discussion-timestamp', { sticky: this.props.isTimelineVisible })}>
        {this.props.discussion.timestamp != null && this.props.isTimelineVisible && <div className="beatmap-discussion-timestamp__point" />}
        <div className="beatmap-discussion-timestamp__icons-container">
          <div className="beatmap-discussion-timestamp__icons">
            <DiscussionTypeIcon type={this.props.discussion.message_type} />
            {this.props.discussion.resolved && (
              <DiscussionTypeIcon type='resolved' />
            )}
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
