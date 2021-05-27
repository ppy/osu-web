// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import RoomJson from 'interfaces/room-json';
import * as React from 'react';
import Room from './room';

interface Props {
  rooms: (RoomJson & Required<Pick<RoomJson, 'playlist'>>)[];
}

export default class MultiplayerHistory extends React.Component<Props> {
  render() {
    return (
      <div className='multiplayer-history'>
        {this.props.rooms.map((room) => <Room key={room.id} room={room} />)}
      </div>
    );
  }
}
