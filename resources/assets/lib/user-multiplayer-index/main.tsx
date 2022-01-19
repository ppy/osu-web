// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserExtendedJson from 'interfaces/user-extended-json';
import * as React from 'react';
import UserMultiplayerHistoryContext, { Stores } from 'user-multiplayer-history-context';
import Header from 'user-multiplayer-index/header';
import MultiplayerHistory from 'user-multiplayer-index/multiplayer-history';
import UserProfileContainer from 'user-profile-container';

interface Props {
  stores: Stores;
  user: UserExtendedJson;
}

function renderHistory(props: Props, type: 'playlists' | 'realtime') {
  return (
    <div className='user-profile-pages__item'>
      <div className='page-extra'>
        <h2 className='title title--page-extra'>{osu.trans(`users.show.extra.multiplayer.${type}.title`)}</h2>
        <UserMultiplayerHistoryContext.Provider value={props.stores[type]}>
          <MultiplayerHistory type={type} user={props.user} />
        </UserMultiplayerHistoryContext.Provider>
      </div>
    </div>
  );
}

export default function Main(props: Props) {
  return (
    <UserProfileContainer user={props.user}>
      <Header user={props.user} />
      <div className='user-profile-pages'>
        {renderHistory(props, 'playlists')}
        {renderHistory(props, 'realtime')}
      </div>
    </UserProfileContainer>
  );
}
