// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'header-v4';
import UserJson from 'interfaces/user-json';
import * as React from 'react';
import { UserList } from 'user-list';

interface Group {
  group_desc?: string;
  group_name: string;
  has_playmodes: boolean;
}

interface Props {
  group: Group;
  users: UserJson[];
}

export class Main extends React.PureComponent<Props> {
  render() {
    return (
      <div className='osu-layout osu-layout--full'>
        <HeaderV4 theme='friends' />

        <div className='osu-page osu-page--users'>
          <UserList playmodeFilter={this.props.group.has_playmodes} title={this.props.group.group_name} users={this.props.users} />
        </div>
      </div>
    );
  }
}
