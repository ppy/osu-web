// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4';
import ProfileHeaderBanners from 'components/profile-header-banners';
import { MultiplayerTypeGroup } from 'interfaces/user-multiplayer-history-json';
import UserProfileJson from 'interfaces/user-profile-json';
import Badges from 'profile-page/badges';
import Detail from 'profile-page/detail';
import HeaderInfo from 'profile-page/header-info';
import headerLinks from 'profile-page/header-links';
import Links from 'profile-page/links';
import * as React from 'react';

interface Props {
  typeGroup: MultiplayerTypeGroup;
  user: UserProfileJson;
}

export default class Header extends React.Component<Props> {
  render() {
    return (
      <div>
        <HeaderV4
          backgroundImage={this.props.user.cover.url}
          contentPrepend={<ProfileHeaderBanners user={this.props.user} />}
          links={headerLinks(this.props.user, this.props.typeGroup)}
          theme='users'
        />
        <div className='osu-page osu-page--users'>
          <div className='profile-header'>
            <div className='profile-header__top'>
              <HeaderInfo coverUrl={this.props.user.cover.url} currentMode={this.props.user.playmode} user={this.props.user} />
            </div>

            <Detail type='multiplayer' user={this.props.user} />
            <Badges badges={this.props.user.badges} />
            <Links user={this.props.user} />
          </div>
        </div>
      </div>
    );
  }
}
