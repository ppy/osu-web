// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetEvent from 'components/beatmapset-event';
import BeatmapsetDiscussionJson from 'interfaces/beatmapset-discussion-json';
import BeatmapsetEventJson from 'interfaces/beatmapset-event-json';
import UserJson from 'interfaces/user-json';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import moment from 'moment';
import React from 'react';
import { trans } from 'utils/lang';

interface Props {
  discussions: Map<number | null | undefined, BeatmapsetDiscussionJson>;
  events: BeatmapsetEventJson[];
  users: Map<number | null | undefined, UserJson>;
}

@observer
export class Events extends React.PureComponent<Props> {
  @computed
  get events() {
    return this.props.events
      .filter((event) => event.type !== 'nomination_reset_received')
      .sort((a, b) => b.created_at === a.created_at
        ? b.id > a.id ? 1 : -1
        : b.created_at > a.created_at ? 1 : -1);
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }


  render() {
    return (
      <div className='beatmapset-events'>
        {this.events.length === 0 ? (
          <div className='beatmapset-events__empty'>
            {trans('beatmap_discussions.events.empty')}
          </div>
        ) : [...this.renderEventsGenerator()]}
      </div>
    );
  }

  private *renderEventsGenerator() {
    let lastCreatedAtString: string | null = null;

    for (const event of this.events) {
      const createdAtString = moment(event.created_at).format('LL');
      if (lastCreatedAtString !== createdAtString) {
        lastCreatedAtString = createdAtString;
        yield <div key={`date-${lastCreatedAtString}`} className='beatmapset-events__title'>{lastCreatedAtString}</div>;
      }

      yield (
        <BeatmapsetEvent
          key={event.id}
          discussions={this.props.discussions}
          event={event}
          mode='discussions'
          time={event.created_at}
          users={this.props.users}
        />
      );
    }
  }
}
