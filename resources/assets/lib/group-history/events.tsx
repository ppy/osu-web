// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserGroupEventJson from 'interfaces/user-group-event-json';
import { observer } from 'mobx-react';
import * as React from 'react';
import Event from './event';

interface Props {
  events: UserGroupEventJson[];
}

@observer
export default class Events extends React.Component<Props> {
  render() {
    if (this.props.events.length === 0) {
      return osu.trans('group_history.none');
    }

    return (
      <div className='group-history-events'>
        {this.props.events.map((event) => (
          <Event key={event.id} event={event} />
        ))}
      </div>
    );
  }
}
