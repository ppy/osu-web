// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetEventJson from 'interfaces/beatmapset-event-json';
import GameMode from 'interfaces/game-mode';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { escape, kebabCase } from 'lodash';
import { deletedUser } from 'models/user';
import * as React from 'react';
import TimeWithTooltip from 'time-with-tooltip';
import { classWithModifiers } from 'utils/css';
import { link } from 'utils/url';

const isBeatmapOwnerChangeEventJson = (event: BeatmapsetEventJson): event is BeatmapOwnerChangeEventJson =>
  event.type === 'beatmap_owner_change';

const isNominationResetReceivedEventJson = (event: BeatmapsetEventJson): event is NominationResetReceivedEventJson =>
  event.type === 'nomination_reset_received';

export type EventViewMode = 'discussions' | 'profile' | 'list';

interface BeatmapOwnerChangeEventJson extends BeatmapsetEventJson {
  comment: {
    beatmap_id: number;
    beatmap_version: string;
    new_user_id: number;
    new_user_username: string;
  };
  type: 'beatmap_owner_change';
}

interface NominationResetReceivedEventJson extends BeatmapsetEventJson {
  comment: {
    beatmap_discussion_id: number;
    source_user_id: number;
    source_user_username: string;
  };
  type: 'nomination_reset_received';
}

interface Props {
  discussions?: Partial<Record<string, BeatmapsetDiscussionJson>>;
  event: BeatmapsetEventJson;
  mode: EventViewMode;
  time?: string;
  users: Partial<Record<string, UserJson>>;
}

export default class Event extends React.PureComponent<Props> {
  private get beatmapsetId(): number | undefined {
    return this.props.event.beatmapset?.id;
  }

  private get discussionId(): number | undefined {
    return this.props.event.comment?.beatmap_discussion_id;
  }

  // discussion page doesn't include the discussion as part of the event.
  private get discussion() {
    return this.props.event.discussion ?? this.props.discussions?.[this.discussionId ?? ''];
  }

  private get firstPost() {
    return this.discussion?.starting_post ?? this.discussion?.posts?.[0];
  }

  render() {
    return this.props.mode === 'discussions'
      ? this.renderDiscussionsVersion()
      : this.renderProfileVersion();
  }

  renderDiscussionsVersion() {
    const eventTime = this.props.time ?? this.props.event.created_at;

    return (
      <div className='beatmapset-event'>
        <div className='beatmapset-event__icon' style={this.iconStyle()} />
        <div className='beatmapset-event__time'>
          <TimeWithTooltip dateTime={eventTime} format='LT' />
        </div>
        <div
          className={'beatmapset-event__content'}
          dangerouslySetInnerHTML={{
            __html: this.contentText(),
          }}
        />
      </div>
    );
  }

  renderProfileVersion() {
    const cover = this.props.event.beatmapset?.covers?.list;

    let discussionLink: string | undefined;
    if (this.beatmapsetId != null) {
      discussionLink = route('beatmapsets.discussion', { beatmapset: this.beatmapsetId });
      if (this.discussionId != null) {
        discussionLink = `${discussionLink}#/${this.discussionId}`;
      }
    }

    return (
      <div className='beatmapset-event'>
        {discussionLink != null ? (
          <a href={discussionLink}>
            <img className='beatmapset-cover' src={cover} />
          </a>
        ) : (
          // TODO: this text barely fits and should be replaced with an icon
          // instead of a translation that overflows.
          <span className='beatmapset-cover'>beatmap deleted</span>
        )}
        <div
          className={classWithModifiers('beatmapset-event__icon', ['beatmapset-activities'])}
          style={this.iconStyle()}
        />

        <div>
          <div
            className='beatmapset-event__content'
            dangerouslySetInnerHTML={{
              __html: this.contentText(),
            }}
          />
          <div className='beatmap-discussion-post__info'>
            <TimeWithTooltip dateTime={this.props.event.created_at} relative />
          </div>
        </div>
      </div>
    );
  }

  private contentText() {
    let discussionLink = '';
    let discussionUserLink = '[unknown user]';
    let text = '';
    let url = '';
    let user: string | undefined;

    if (this.discussionId != null) {
      if (this.discussion == null) {
        url = route('beatmapsets.discussions.show', { discussion: this.discussionId });
        text = osu.trans('beatmapset_events.item.discussion_deleted');
      } else {
        const firstPostMessage = this.firstPost?.message;
        url = BeatmapDiscussionHelper.url({ discussion: this.discussion });
        text = firstPostMessage != null ? BeatmapDiscussionHelper.previewMessage(firstPostMessage) : '[no preview]';

        const discussionUser = this.props.users[this.discussion.user_id];

        if (discussionUser != null) {
          discussionUserLink = link(route('users.show', { user: discussionUser.id }), discussionUser.username);
        }
      }

      discussionLink = link(url, `#${this.discussionId}`, { classNames: ['js-beatmap-discussion--jump'] });
    } else {
      text = BeatmapDiscussionHelper.format(this.props.event.comment, { newlines: false });
    }

    if (this.props.event.type === 'discussion_lock' || this.props.event.type === 'remove_from_loved') {
      text = BeatmapDiscussionHelper.format(this.props.event.comment.reason, { newlines: false });
    }

    if (this.props.event.user_id != null) {
      const userData = this.props.users[this.props.event.user_id];

      if (userData == null) {
        user = escape(deletedUser.username);
      } else {
        user = link(route('users.show', { user: userData.id }), userData.username);
      }
    }

    const params = {
      discussion: discussionLink,
      discussion_user: discussionUserLink,
      text,
      user,
      ...this.props.event.comment,
    };

    let eventType = this.props.event.type === 'disqualify' && this.discussion == null ? 'disqualify_legacy' : this.props.event.type;

    if (eventType === 'nominate' && this.props.event.comment?.modes.length > 0) {
      eventType = 'nominate_modes';
      const nominationModes = this.props.event.comment.modes.map((mode: GameMode) => osu.trans(`beatmaps.mode.${mode}`));
      params.modes = osu.transArray(nominationModes);
    }

    if (eventType === 'nsfw_toggle') {
      const newState = this.props.event.comment?.new ? 'to_1' : 'to_0';
      eventType += `.${newState}`;
    }

    if (isBeatmapOwnerChangeEventJson(this.props.event)) {
      const data = this.props.event.comment;
      params.new_user = link(route('users.show', { user: data.new_user_id }), data.new_user_username);
      params.beatmap = link(route('beatmaps.show', { beatmap: data.beatmap_id }), data.beatmap_version);
    }

    if (isNominationResetReceivedEventJson(this.props.event)) {
      const data = this.props.event.comment;
      if (this.props.mode === 'profile') {
        eventType += '_profile';
        params.user = link(route('users.show', { user: data.source_user_id }), data.source_user_username);
      } else {
        params.source_user = link(route('users.show', { user: data.source_user_id }), data.source_user_username);
      }
    }

    const key = `beatmapset_events.event.${eventType}`;
    let message = osu.trans(key, params);

    // append owner of the event if not already included in main message
    // naive check; we don't use anything other than :user
    if (user != null && !osu.trans(key).includes(':user')) {
      message += ` (${user})`;
    }

    return message;
  }

  private iconStyle() {
    return {
      '--bg': `var(--bg-${kebabCase(this.props.event.type)})`,
    } as React.CSSProperties;
  }
}
