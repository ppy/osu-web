// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import RoomJson from 'interfaces/room-json';
import UserJsonExtended from 'interfaces/user-json-extended';
import * as React from 'react';
import UserProfileContainer from 'user-profile-container';
import MultiplayerHistory from 'profile-page/multiplayer-history';
import Header from './header';

interface Props {
  rooms: RoomJson[];
  user: UserJsonExtended;
}

export default class Main extends React.Component<Props> {
  render() {
    return (
      <UserProfileContainer user={this.props.user}>
        <Header user={this.props.user} />
        <div className='user-profile-pages'>
          <div className='user-profile-pages__item js-switchable-mode-page--scrollspy js-switchable-mode-page--page'>
            <div className='page-extra'>
              <h2 className='title title--page-extra'>Multiplayer Games</h2>
              <MultiplayerHistory rooms={this.props.rooms} />
            </div>
          </div>
        </div>
      </UserProfileContainer>
    );
  }
}
