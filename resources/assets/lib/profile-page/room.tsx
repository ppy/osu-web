// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import RoomJson from 'interfaces/room-json';
import * as React from 'react';
import { StringWithComponent } from 'string-with-component';
import TimeWithTooltip from 'time-with-tooltip';
import { UserLink } from 'user-link';

interface Props {
  room: RoomJson;
}

export default class Room extends React.Component<Props> {
  render() {
    return (
      <div className='multiplayer-room'>
        <div className='multiplayer-room__details'>
          <div className='multiplayer-room__ends'>
            <TimeWithTooltip dateTime={this.props.room.ends_at} relative />
          </div>
          <div className='multiplayer-room__name'>{this.props.room.name}</div>
          <div className='multiplayer-room__maps'>A number</div>
        </div>

        {this.renderHost()}
        {this.renderParticipants()}
      </div>
    );
  }

  private renderHost() {
    return (
      <div className='multiplayer-room__host'>
        <StringWithComponent
          mappings={{ ':user': <UserLink user={this.props.room.host} /> }}
          pattern={osu.trans('multiplayer.room.hosted_by')}
        />
      </div>
    );
  }

  private renderParticipants() {
    return (
      <div className='multiplayer-room__participants'>
        {this.props.room.participant_count} players
      </div>
    );
  }
}
