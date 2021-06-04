// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import MultiplayerHistory, { Props as MultiplayerHistoryProps } from 'profile-page/multiplayer-history';
import * as React from 'react';
import UserProfileContainer from 'user-profile-container';
import Header from './header';

export default function Main(props: MultiplayerHistoryProps) {
  return (
    <UserProfileContainer user={props.user}>
      <Header user={props.user} />
      <div className='user-profile-pages'>
        <div className='user-profile-pages__item'>
          <div className='page-extra'>
            <h2 className='title title--page-extra'>{osu.trans('users.show.extra.multiplayer.title')}</h2>
            <MultiplayerHistory {...props} />
          </div>
        </div>
      </div>
    </UserProfileContainer>
  );
}
