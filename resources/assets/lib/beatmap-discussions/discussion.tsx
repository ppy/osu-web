// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserListPopup, { createTooltip } from 'components/user-list-popup';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapsetDiscussionJson, { BeatmapsetDiscussionJsonForShow } from 'interfaces/beatmapset-discussion-json';
import BeatmapsetDiscussionPostJson from 'interfaces/beatmapset-discussion-post-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import CurrentUserJson from 'interfaces/current-user-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { findLast, kebabCase } from 'lodash';
import { action, computed, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import { deletedUser } from 'models/user';
import core from 'osu-core-singleton';
import * as React from 'react';
import { renderToStaticMarkup } from 'react-dom/server';
import { onError } from 'utils/ajax';
import { badgeGroup, canModeratePosts, formatTimestamp, startingPost } from 'utils/beatmapset-discussion-helper';
import { classWithModifiers, groupColour } from 'utils/css';
import { trans } from 'utils/lang';
import { hideLoadingOverlay, showLoadingOverlay } from 'utils/loading-overlay';
import { discussionTypeIcons } from './discussion-type';
import { NewReply } from './new-reply';
import Post from './post';
import SystemPost from './system-post';
import { UserCard } from './user-card';

const bn = 'beatmap-discussion';

const voteTypes = ['up', 'down'] as const;
type VoteType = typeof voteTypes[number];

interface Props {
  beatmapset: BeatmapsetExtendedJson;
  collapsed: boolean;
  currentBeatmap: BeatmapExtendedJson;
  currentUser: CurrentUserJson;
  discussion: BeatmapsetDiscussionJsonForShow & Required<Pick<BeatmapsetDiscussionJson, 'current_user_attributes'>>;
  highlighted: boolean;
  isTimelineVisible: boolean;
  parentDiscussion?: BeatmapsetDiscussionJson & Required<Pick<BeatmapsetDiscussionJson, 'current_user_attributes'>>;
  preview: boolean;
  readPostIds?: Set<number>;
  showDeleted: boolean;
  users: Partial<Record<number | string, UserJson>>;
  visible: boolean;
}

@observer
export class Discussion extends React.Component<Props> {
  private lastResolvedState = false;
  private readonly tooltips: Partial<Record<VoteType, unknown>> = {};
  @observable private voteXhr: JQuery.jqXHR<BeatmapsetDiscussionJsonForShow> | null = null;

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  @computed
  private get canDownvote() {
    return core.currentUser != null && (core.currentUser.is_admin || core.currentUser.is_moderator || core.currentUser.is_bng);
  }

  @computed
  private get canBeRepliedTo() {
    return (!this.props.beatmapset.discussion_locked || canModeratePosts())
      && (this.props.discussion.beatmap_id == null || this.props.currentBeatmap.deleted_at == null);
  }

  @computed
  private get resolvedSystemPostId() {
    const systemPost = findLast(this.props.discussion.posts, (post) => post != null && post.system && post.message.type === 'resolve');
    return systemPost?.id ?? -1;
  }

  componentDidUpdate() {
    for (const type of voteTypes) {
      this.tooltips[type]?.qtip('api').set('content.text', this.getTooltipContent(type));
    }
  }

  componentWillUnmount() {
    this.voteXhr?.abort();
  }

  render() {
    if (!this.isVisible(this.props.discussion)) return null;
    const firstPost = startingPost(this.props.discussion);
    // TODO: check if possible to have null post...
    if (firstPost == null) return null;

    const lineClasses = classWithModifiers(`${bn}__line`, { resolved: this.props.discussion.resolved});

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
            <div className={`${bn}__top-actions`}>
              {!this.props.preview && this.renderPostButtons()}
            </div>
          </div>
          {!this.props.preview && this.postFooter()}
          <div className={lineClasses} />
        </div>
      </div>
    );
  }

  private getTooltipContent(type: VoteType) {
    const count = this.props.discussion.votes[type];
    const title = count < 1
      ? trans(`beatmaps.discussions.votes.none.${type}`)
      : `${trans(`beatmaps.discussions.votes.latest.${type}`)}:`;

    const users = this.props.discussion.votes.voters[type].map((id) => this.props.users[id] ?? {});

    return renderToStaticMarkup(<UserListPopup count={count} title={title} users={users} />);
  }

  private readonly handleCollapseClick = () => {
    $.publish('beatmapset-discussions:collapse', { discussionId: this.props.discussion.id });
  };

  private readonly handleSetHighlight = (e: React.MouseEvent<HTMLDivElement>) => {
    if (e.defaultPrevented) return;
    $.publish('beatmapset-discussions:highlight', { discussionId: this.props.discussion.id });
  };

  @action
  private readonly handleVoteClick = (e: React.MouseEvent<HTMLButtonElement>) => {
    if (this.voteXhr != null) return;

    showLoadingOverlay();

    this.voteXhr = $.ajax(route('beatmapsets.discussions.vote', { discussion: this.props.discussion.id }), {
      data: {
        beatmap_discussion_vote: {
          score: e.currentTarget.dataset.score,
        },
      },
      method: 'PUT',
    });

    this.voteXhr
      .done((data) => runInAction(() => {
        $.publish('beatmapsetDiscussions:update', { beatmapset: data });
      })).fail(onError)
      .always(action(() => {
        hideLoadingOverlay();
        this.voteXhr = null;
      }));
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
    let cssClasses = `${bn}__expanded`;
    if (this.props.collapsed) {
      cssClasses += ' hidden';
    }

    return (
      <div className={cssClasses}>
        <div className={`${bn}__replies`}>
          {this.props.discussion.posts?.slice(1).map(this.renderReply)}
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
    const canModerate = canModeratePosts(this.props.currentUser);
    const canBeEdited = this.isOwner(post) && post.id > this.resolvedSystemPostId && !this.props.beatmapset.discussion_locked;
    const canBeDeleted = type === 'discussion' ? this.props.discussion.current_user_attributes?.can_destroy : canModerate || canBeEdited;
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
        canBeDeleted={canBeDeleted}
        canBeEdited={this.props.currentUser.is_admin || canBeEdited}
        canBeRestored={canModerate}
        discussion={this.props.discussion}
        lastEditor={post.last_editor_id != null ? this.props.users[post.last_editor_id] ?? deletedUser.toJson() : undefined}
        post={post}
        read={this.isRead(post)}
        type={type}
        user={user}
        users={this.props.users}
      />
    );
  }

  private renderPostButtons() {
    return (
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
        {voteTypes.map((type) => (
          <div
            key={type}
            className={`${bn}__action`}
            data-type={type}
            onMouseOver={this.showVoters}
            onTouchStart={this.showVoters}
          >
            {this.renderVote(type)}
          </div>
        ))}
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

  private renderVote(type: VoteType) {
    const [baseScore, icon] = type === 'up' ? [1, 'thumbs-up'] : [-1, 'thumbs-down'];
    const currentVote = this.props.discussion.current_user_attributes?.vote_score;
    const score = currentVote === baseScore ? 0 : baseScore;

    const user = this.props.users[this.props.discussion.user_id];
    const cannotVote = this.isOwner(this.props.discussion) || (user?.is_bot ?? false) || (type === 'down' && !this.canDownvote) || !this.canBeRepliedTo;

    return (
      <button
        className={classWithModifiers('beatmap-discussion-vote', type, { inactive: score !== 0 })}
        data-score={score}
        disabled={this.voteXhr != null || cannotVote}
        onClick={this.handleVoteClick}
      >
        <i className={`fas fa-${icon}`} />
        <span className='beatmap-discussion-vote__count'>{this.props.discussion.votes[type]}</span>,
      </button>
    );
  }

  private readonly showVoters = (event: React.MouseEvent<HTMLDivElement> | React.TouchEvent<HTMLDivElement>) => {
    const target = event.currentTarget;
    const type = target.dataset.type as VoteType;

    this.tooltips[type] ??= createTooltip(target, 'top center', this.getTooltipContent(type));

    return this.tooltips[type];
  };
}
