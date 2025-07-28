// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4';
import ProfileTournamentBanner from 'components/profile-tournament-banner';
import RoomList from 'components/room-list';
import UserProfileContainer from 'components/user-profile-container';
import UserExtendedJson from 'interfaces/user-extended-json';
import { ProfileHeaderIncludes } from 'interfaces/user-json';
import { MultiplayerTypeGroup } from 'interfaces/user-multiplayer-history-json';
import { route } from 'laroute';
import core from 'osu-core-singleton';
import Badges from 'profile-page/badges';
import Cover from 'profile-page/cover';
import DetailBar from 'profile-page/detail-bar';
import headerLinks from 'profile-page/header-links';
import * as React from 'react';
import RoomListStore from 'stores/room-list-store';
import { trans } from 'utils/lang';

interface Props {
  store: {
    active: RoomListStore;
    ended: RoomListStore;
  };
  typeGroup: MultiplayerTypeGroup;
  user: UserExtendedJson & Required<Pick<UserExtendedJson, ProfileHeaderIncludes>>;
}

export default function Main(props: Props) {
  return (
    <UserProfileContainer user={props.user}>
      <HeaderV4
        backgroundImage={props.user.cover.url}
        links={headerLinks(props.user, props.typeGroup)}
        // add space for warning banner when user is blocked
        modifiers={{ restricted: core.currentUserModel.blocks.has(props.user.id) || props.user.is_restricted }}
        theme='users'
      />

      <div className='osu-page osu-page--generic-compact'>
        <Cover coverUrl={props.user.cover.url} currentMode={props.user.playmode} modifiers='multiplayer' user={props.user} />

        {props.user.active_tournament_banners.map((banner) => (
          <ProfileTournamentBanner key={banner.id} banner={banner} />
        ))}

        <Badges badges={props.user.badges} modifiers='multiplayer' />

        <DetailBar user={props.user} />

        <div className='user-profile-pages user-profile-pages--no-tabs'>
          <div className='page-extra'>
            <h2 className='title title--page-extra'>{trans(`users.show.extra.${props.typeGroup}.title`)}</h2>

            <div className='page-extra__user-multiplayer-rooms'>
              <div>
                <h3 className='title title--page-extra-small'>
                  {trans('users.multiplayer.index.active')}
                </h3>
                <RoomList
                  showMoreUrl={route('users.multiplayer.index', { is_active: true, typeGroup: props.typeGroup, user: props.user.id })}
                  store={props.store.active}
                  typeGroup={props.typeGroup}
                />
              </div>

              <div>
                <h3 className='title title--page-extra-small'>
                  {trans('users.multiplayer.index.ended')}
                </h3>
                <RoomList
                  showMoreUrl={route('users.multiplayer.index', { is_active: false, typeGroup: props.typeGroup, user: props.user.id })}
                  store={props.store.ended}
                  typeGroup={props.typeGroup}
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </UserProfileContainer>
  );
}
