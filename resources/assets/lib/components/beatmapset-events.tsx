// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetEvent, { EventViewMode } from 'components/beatmapset-event';
import BeatmapsetEventJson from 'interfaces/beatmapset-event-json';
import UserJson from 'interfaces/user-json';
import * as React from 'react';

interface Props {
  events: BeatmapsetEventJson[];
  mode: EventViewMode;
  users: Partial<Record<string, UserJson>>;
}

export default class BeatmapsetEvents extends React.PureComponent<Props> {
  render() {
    return this.props.events.map((event) => <BeatmapsetEvent key={event.id} event={event} mode={this.props.mode} users={this.props.users} />);
  }
}
