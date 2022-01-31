// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserProfileContainer from 'components/user-profile-container';
import UserExtendedJson from 'interfaces/user-extended-json';
import * as React from 'react';
import Header from 'user-multiplayer-index/header';
import MultiplayerHistory from 'user-multiplayer-index/multiplayer-history';
import MultiplayerHistoryStore from './multiplayer-history-store';

interface Props {
  store: MultiplayerHistoryStore;
  user: UserExtendedJson;
}

export default function Main(props: Props) {
  return (
    <UserProfileContainer user={props.user}>
      <Header typeGroup={props.store.typeGroup} user={props.user} />
      <div className='user-profile-pages'>
        <div className='user-profile-pages__item'>
          <div className='page-extra'>
            <h2 className='title title--page-extra'>{osu.trans(`users.show.extra.${props.store.typeGroup}.title`)}</h2>
            <MultiplayerHistory store={props.store} user={props.user} />
          </div>
        </div>

      </div>
    </UserProfileContainer>
  );
}
