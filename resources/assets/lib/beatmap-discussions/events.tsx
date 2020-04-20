// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJSON from 'interfaces/user-json';
import { Dictionary } from 'lodash';
import { BeatmapsetEvent } from 'modding-helpers';
import * as React from 'react';
import Event from './event';

interface Props {
  discussions: Dictionary<BeatmapDiscussion>;
  events: BeatmapsetEvent[];
  users: Dictionary<UserJSON>;
}

export default class Events extends React.PureComponent<Props> {
  render() {
    return this.props.events.map((event) => <Event discussions={this.props.discussions} event={event} key={event.id} mode='profile' users={this.props.users} />);
  }
}
