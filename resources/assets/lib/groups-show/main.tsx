/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import HeaderV3 from 'header-v3';
import * as React from 'react';
import { UserList } from 'user-list';

interface Group {
  group_desc?: string;
  group_name: string;
}

interface Props {
  group: Group;
  users: User[];
}

export class Main extends React.PureComponent<Props> {
  render() {
    return (
      <div className='osu-layout osu-layout--full'>
        <HeaderV3
          theme='users'
          title={this.props.group.group_name}
        />

        <div className='osu-page osu-page--users'>
          <UserList users={this.props.users} />
        </div>
      </div>
    );
  }
}
