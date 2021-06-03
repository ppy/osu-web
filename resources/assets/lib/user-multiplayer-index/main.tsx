// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import MultiplayerHistory, { Props as MultiplayerHistoryProps } from 'profile-page/multiplayer-history';
import * as React from 'react';
import UserProfileContainer from 'user-profile-container';
import Header from './header';

export default class Main extends React.Component<MultiplayerHistoryProps> {
  render() {
    return (
      <UserProfileContainer user={this.props.user}>
        <Header user={this.props.user} />
        <div className='user-profile-pages'>
          <div className='user-profile-pages__item js-switchable-mode-page--scrollspy js-switchable-mode-page--page'>
            <div className='page-extra'>
              <h2 className='title title--page-extra'>Multiplayer Games</h2>
              <MultiplayerHistory {...this.props} />
            </div>
          </div>
        </div>
      </UserProfileContainer>
    );
  }
}
