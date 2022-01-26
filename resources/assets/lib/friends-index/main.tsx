// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'header-v4';
import homeLinks from 'home-links';
import CurrentUserJson from 'interfaces/current-user-json';
import UserJson from 'interfaces/user-json';
import * as React from 'react';
import UserCardTypeContext from 'user-card-type-context';
import { UserList } from 'user-list';

interface Props {
  friends: UserJson[];
  user: CurrentUserJson;
}

export class Main extends React.PureComponent<Props> {
  render() {
    return (
      <div className='osu-layout osu-layout--full'>
        <HeaderV4
          backgroundImage={this.props.user.cover.url}
          links={homeLinks('friends.index')}
          theme='friends'
        />

        <div className='osu-page osu-page--users'>
          <UserCardTypeContext.Provider value={{isFriendsPage: true}}>
            <UserList users={this.props.friends} />
          </UserCardTypeContext.Provider>
        </div>
      </div>
    );
  }
}
