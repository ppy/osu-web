// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4';
import { UserList } from 'components/user-list';
import homeLinks from 'home-links';
import CurrentUserJson from 'interfaces/current-user-json';
import UserJson from 'interfaces/user-json';
import UserRelationJson from 'interfaces/user-relation-json';
import * as React from 'react';
import UserCardTypeContext from 'user-card-type-context';

interface Props {
  friends: UserJson[];
  user: CurrentUserJson;
  userRelations: Map<number, UserRelationJson | undefined>;
}

export class Main extends React.PureComponent<Props> {
  render() {
    return (
      <>
        <HeaderV4
          backgroundImage={this.props.user.cover.url}
          links={homeLinks('friends.index')}
          theme='friends'
        />

        <div className='osu-page osu-page--generic-compact'>
          <UserCardTypeContext.Provider value={{ isFriendsPage: true }}>
            <UserList userRelations={this.props.userRelations} users={this.props.friends} />
          </UserCardTypeContext.Provider>
        </div>
      </>
    );
  }
}
