// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJSON from 'interfaces/user-json';
import { route } from 'laroute';
import { Dictionary, kebabCase } from 'lodash';
import { BeatmapsetEvent, contentText } from 'modding-helpers';
import * as React from 'react';

interface Props {
  event: BeatmapsetEvent;
  users: Dictionary<UserJSON>;
}

export default class EventDetailed extends React.PureComponent<Props> {
  render() {
    const cover = this.props.event.beatmapset?.covers?.list;
    const discussionId = this.props.event.comment?.beatmap_discussion_id;
    let discussionLink = route('beatmapsets.discussion', { beatmapset: this.props.event.beatmapset?.id });
    if (discussionId != null) {
      discussionLink = `${discussionLink}#/${discussionId}`;
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
              __html: contentText(this.props.event, this.props.users, discussionId),
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
}
