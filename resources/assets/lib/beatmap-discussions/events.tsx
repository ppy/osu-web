// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetEventJson from 'interfaces/beatmapset-event-json';
import UserJSON from 'interfaces/user-json';
import * as React from 'react';
import Event from './event';

interface Props {
  discussions: Record<string, BeatmapDiscussion>;
  events: BeatmapsetEventJson[];
  users: Record<string, UserJSON>;
}

export default class Events extends React.PureComponent<Props> {
  render() {
    return this.props.events.map((event) => <Event discussions={this.props.discussions} event={event} key={event.id} mode='profile' users={this.props.users} />);
  }
}
