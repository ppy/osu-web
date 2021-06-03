// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'header-v4';
import UserJsonExtended from 'interfaces/user-json-extended';
import headerLinks from 'profile-page/header-links';
import ProfileTournamentBanner from 'profile-tournament-banner';
import Badges from 'profile-page/badges';
import HeaderInfo from 'profile-page/header-info';
import Links from 'profile-page/links';
import * as React from 'react';

interface Props {
  user: UserJsonExtended;
}

export default class Header extends React.Component<Props> {
  render() {
    return (
      <div>
        <HeaderV4
          backgroundImage={this.props.user.cover.url}
          contentPrepend={<ProfileTournamentBanner banner={this.props.user.active_tournament_banner} />}
          links={headerLinks(this.props.user, 'multiplayer')}
          theme='users'
        />
        <div className='osu-page osu-page--users'>
          <div className='profile-header'>
            <div className='profile-header__top'>
              <HeaderInfo coverUrl={this.props.user.cover.url} currentMode={this.props.user.playmode} user={this.props.user} />
            </div>
            <Badges badges={this.props.user.badges} />
            <Links user={this.props.user} />
          </div>
        </div>
      </div>
    );
  }
}
