// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetEventJson from 'interfaces/beatmapset-event-json';
import UserJson from 'interfaces/user-json';
import * as React from 'react';
import Event from './event';

interface Props {
  events: BeatmapsetEventJson[];
  users: Partial<Record<string, UserJson>>;
}

export default class Events extends React.PureComponent<Props> {
  render() {
    return this.props.events.map((event) => <Event key={event.id} event={event} mode='profile' users={this.props.users} />);
  }
}
