// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { kebabCase } from 'lodash';
import { BeatmapsetEvent, contentText } from 'modding-helpers';
import * as moment from 'moment';
import * as React from 'react';

interface Props {
  discussions: any;
  event: BeatmapsetEvent;
  time: moment.Moment;
  users: any;
}

export default class Event extends React.PureComponent<Props> {
  render() {
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
            __html: contentText(this.props.event, this.props.users, this.props.event.comment?.beatmap_discussion_id, this.props.discussions),
          }}
        />
      </div>
    );
  }
}
