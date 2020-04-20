// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetEventJson from 'interfaces/beatmapset-event-json';
import UserJSON from 'interfaces/user-json';
import { route } from 'laroute';
import { Dictionary, kebabCase } from 'lodash';
import * as moment from 'moment';
import * as React from 'react';

interface Props {
  discussions?: Dictionary<BeatmapDiscussion>;
  event: BeatmapsetEventJson;
  mode: 'discussions' | 'profile';
  time?: moment.Moment;
  users: Dictionary<UserJSON>;
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

  private get discussion() {
    const discussion = this.props.event.discussion ?? this.props.discussions?.[this.discussionId ?? ''];

    // TODO: transformer should return null instead of [] when no permission
    return Array.isArray(discussion) ? undefined : discussion;
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
    const eventTime = this.props.time ?? moment(this.props.event.created_at);

    return (
      <div className='beatmapset-event'>
        <div className={osu.classWithModifiers('beatmapset-event__icon', [kebabCase(this.props.event.type)])} />
        <time
          className='beatmapset-event__time js-tooltip-time'
          dateTime={this.props.event.created_at}
          title={this.props.event.created_at}
        >
          {eventTime.format('LT')}
        </time>
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
    let discussionLink = route('beatmapsets.discussion', { beatmapset: this.beatmapsetId });
    if (this.discussionId != null) {
      discussionLink = `${discussionLink}#/${this.discussionId}`;
    }

    return (
      <div className='beatmapset-event'>
        <a href={discussionLink}>
          <img className='beatmapset-activities__beatmapset-cover' src={cover} />
        </a>

        <div className={osu.classWithModifiers('beatmapset-event__icon', [kebabCase(this.props.event.type), 'beatmapset-activities'])} />

        <div>
          <div
            className='beatmapset-event__content'
            dangerouslySetInnerHTML={{
              __html: this.contentText(),
            }}
          />
          <div
            className='beatmap-discussion-post__info'
            dangerouslySetInnerHTML={{ __html: osu.timeago(this.props.event.created_at) }}
          />
        </div>
      </div>
    );
  }

  private contentText() {
    let discussionLink = '';
    let text = '';
    let url = '';
    let user = '';

    if (this.discussionId != null) {
      if (this.discussion != null) {
        const message = this.firstPost?.message;
        url = BeatmapDiscussionHelper.url({ discussion: this.discussion });
        text = message != null ? BeatmapDiscussionHelper.previewMessage(message) : '[no preview]';
      } else {
        url = route('beatmap-discussions.show', { beatmap_discussion: this.discussionId });
        text = osu.trans('beatmapset_events.item.discussion_deleted');
      }

      discussionLink = osu.link(url, `#${this.discussionId}`, { classNames: ['js-beatmap-discussion--jump'] });
    } else {
      text = BeatmapDiscussionHelper.format(this.props.event.comment, { newlines: false });
    }

    if (this.props.event.type === 'discussion_lock') {
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

    const key = this.props.event.type === 'disqualify' && this.discussionId == null ? 'disqualify_legacy' : this.props.event.type;

    let message = osu.trans(`beatmapset_events.event.${key}`, params);

    // append owner of the event if not already included in main message
    if (user != null
      && !(this.props.event.type in ['disqualify', 'kudosu_gain', 'kudosu_lost', 'nominate'])
    ) {
      message += ` (${user})`;
    }

    return message;
  }
}
