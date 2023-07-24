// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapsetDiscussionJson, { BeatmapsetDiscussionJsonForBundle, BeatmapsetDiscussionJsonForShow } from 'interfaces/beatmapset-discussion-json';
import BeatmapsetDiscussionPostJson from 'interfaces/beatmapset-discussion-post-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import UserJson from 'interfaces/user-json';
import { findLast } from 'lodash';
import { action, computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import { deletedUser } from 'models/user';
import core from 'osu-core-singleton';
import * as React from 'react';
import { badgeGroup, canModeratePosts, formatTimestamp, makeUrl, startingPost } from 'utils/beatmapset-discussion-helper';
import { downloadLimited } from 'utils/beatmapset-helper';
import { classWithModifiers, groupColour } from 'utils/css';
import { trans } from 'utils/lang';
import { DiscussionType, discussionTypeIcons } from './discussion-type';
import DiscussionVoteButtons from './discussion-vote-buttons';
import DiscussionsStateContext from './discussions-state-context';
import { NewReply } from './new-reply';
import Post from './post';
import SystemPost from './system-post';
import { UserCard } from './user-card';

const bn = 'beatmap-discussion';

interface PropsBase {
  beatmapset: BeatmapsetExtendedJson;
  currentBeatmap: BeatmapExtendedJson | null;
  isTimelineVisible: boolean;
  parentDiscussion?: BeatmapsetDiscussionJson | null;
  readonly: boolean;
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
  static contextType = DiscussionsStateContext;
  static defaultProps = {
    preview: false,
    readonly: false,
  };

  declare context: React.ContextType<typeof DiscussionsStateContext>;
  private lastResolvedState = false;

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  @computed
  private get canBeRepliedTo() {
    return !downloadLimited(this.props.beatmapset)
      && (!this.props.beatmapset.discussion_locked || canModeratePosts())
      && (this.props.discussion.beatmap_id == null || this.props.currentBeatmap?.deleted_at == null);
  }

  @computed
  private get collapsed() {
    return this.context.discussionCollapsed.get(this.props.discussion.id) ?? this.context.discussionDefaultCollapsed;
  }

  @computed
  private get highlighted() {
    return this.context.highlightedDiscussionId === this.props.discussion.id;
  }

  @computed
  private get resolvedSystemPostId() {
    // TODO: handling resolved status in bundles....?
    if (this.props.preview) return -1;

    const systemPost = findLast(this.props.discussion.posts, (post) => post != null && post.system && post.message.type === 'resolved');
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
      highlighted: this.highlighted,
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
        style={{
          '--discussion-colour': `var(--beatmapset-discussion-colour--${this.props.discussion.message_type})`,
        } as React.CSSProperties}
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

  @action
  private readonly handleCollapseClick = () => {
    this.context.discussionCollapsed.set(this.props.discussion.id, !this.collapsed);
  };

  @action
  private readonly handleSetHighlight = (e: React.MouseEvent<HTMLDivElement>) => {
    if (e.defaultPrevented) return;
    this.context.highlightedDiscussionId = this.props.discussion.id;
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
    if (this.collapsed) {
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
        readonly={this.props.readonly}
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
            users={this.props.users}
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
      <div className='beatmap-discussion-timestamp'>
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
