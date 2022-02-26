// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserProfileContainer from 'components/user-profile-container';
import UserProfileJson from 'interfaces/user-profile-json';
import * as React from 'react';
import Header from 'user-multiplayer-index/header';
import MultiplayerHistory from 'user-multiplayer-index/multiplayer-history';
import MultiplayerHistoryStore from './multiplayer-history-store';

interface Props {
  store: MultiplayerHistoryStore;
  user: UserProfileJson;
}

export default function Main(props: Props) {
  return (
    <UserProfileContainer user={props.user}>
      <Header typeGroup={props.store.typeGroup} user={props.user} />
      <div className='osu-page osu-page--generic-compact'>
        <div className='user-profile-pages user-profile-pages--no-tabs'>
          <div className='page-extra'>
            <h2 className='title title--page-extra'>{osu.trans(`users.show.extra.${props.store.typeGroup}.title`)}</h2>
            <MultiplayerHistory store={props.store} user={props.user} />
          </div>
        </div>

      </div>
    </UserProfileContainer>
  );
}
