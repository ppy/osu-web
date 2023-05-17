// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetEvent from 'components/beatmapset-event';
import BeatmapsetDiscussionJson from 'interfaces/beatmapset-discussion-json';
import BeatmapsetEventJson from 'interfaces/beatmapset-event-json';
import UserJson from 'interfaces/user-json';
import moment from 'moment';
import React from 'react';
import { trans } from 'utils/lang';

interface Props {
  discussions: Partial<Record<string, BeatmapsetDiscussionJson>>;
  events: BeatmapsetEventJson[];
  users: Partial<Record<string, UserJson>>;
}

export class Events extends React.PureComponent<Props> {
  render() {
    const events = this.props.events.filter((event) => event.type !== 'nomination_reset_received');

    return (
      <div className='osu-page osu-page--small osu-page--generic'>
        <div className='beatmapset-events'>
          {events.length === 0 ? (
            <div className='beatmapset-events__empty'>
              {trans('beatmap_discussions.events.empty')}
            </div>
          ) : this.renderEvents(events)}
        </div>
      </div>
    );
  }

  private renderEvents(events: BeatmapsetEventJson[]) {
    let lastCreatedAtString: string | null = null;

    const nodes: React.ReactNode[] = [];

    for (let i = events.length - 1; i >= 0; i--) {
      const event = events[i];
      const createdAtString = moment(event.created_at).format('LL');
      if (lastCreatedAtString !== createdAtString) {
        lastCreatedAtString = createdAtString;
        nodes.push(<div key={`date-${lastCreatedAtString}`} className='beatmapset-events__title'>{lastCreatedAtString}</div>);
      }

      nodes.push(
        <BeatmapsetEvent
          key={event.id}
          discussions={this.props.discussions}
          event={event}
          mode='discussions'
          time={event.created_at}
          users={this.props.users}
        />,
      );
    }

    return nodes;
  }
}
