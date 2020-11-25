// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetEventJson from 'interfaces/beatmapset-event-json';
import GameMode from 'interfaces/game-mode';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { kebabCase } from 'lodash';
import * as React from 'react';
import TimeWithTooltip from 'time-with-tooltip';

interface Props {
  discussions?: Record<string, BeatmapsetDiscussionJson>;
  event: BeatmapsetEventJson;
  mode: 'discussions' | 'profile';
  time?: string;
  users: Record<string, UserJson>;
}

export default class Event extends React.PureComponent<Props> {
  static readonly defaultProps = {
    mode: 'discussions',
  };

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
        <div className={osu.classWithModifiers('beatmapset-event__icon', [kebabCase(this.props.event.type)])} />
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
        <div className={osu.classWithModifiers('beatmapset-event__icon', [kebabCase(this.props.event.type), 'beatmapset-activities'])} />

        <div>
          <div
            className='beatmapset-event__content'
            dangerouslySetInnerHTML={{
              __html: this.contentText(),
            }}
          />
          <div className='beatmap-discussion-post__info'>
            <TimeWithTooltip dateTime={this.props.event.created_at} relative={true} />
          </div>
        </div>
      </div>
    );
  }

  private contentText() {
    let discussionLink = '';
    let text = '';
    let url = '';
    let user: string | undefined;

    if (this.discussionId != null) {
      if (this.discussion != null) {
        const firstPostMessage = this.firstPost?.message;
        url = BeatmapDiscussionHelper.url({ discussion: this.discussion });
        text = firstPostMessage != null ? BeatmapDiscussionHelper.previewMessage(firstPostMessage) : '[no preview]';
      } else {
        url = route('beatmap-discussions.show', { beatmap_discussion: this.discussionId });
        text = osu.trans('beatmapset_events.item.discussion_deleted');
      }

      discussionLink = osu.link(url, `#${this.discussionId}`, { classNames: ['js-beatmap-discussion--jump'] });
    } else {
      text = BeatmapDiscussionHelper.format(this.props.event.comment, { newlines: false });
    }

    if (this.props.event.type === 'discussion_lock' || this.props.event.type === 'remove_from_loved') {
      text = BeatmapDiscussionHelper.format(this.props.event.comment.reason, { newlines: false });
    }

    if (this.props.event.user_id != null) {
      user = osu.link(route('users.show', { user: this.props.event.user_id }), this.props.users[this.props.event.user_id]?.username);
    }

    const params = {
      discussion: discussionLink,
      text,
      user,
      ...this.props.event.comment,
    };

    let eventType = this.props.event.type === 'disqualify' && this.discussion == null ? 'disqualify_legacy' : this.props.event.type;

    if (eventType === 'nominate' && this.props.event.comment?.modes.length > 0) {
      eventType = `nominate_modes`;
      const nominationModes = this.props.event.comment.modes.map((mode: GameMode) => osu.trans(`beatmaps.mode.${mode}`));
      params.modes = osu.transArray(nominationModes);
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
}
