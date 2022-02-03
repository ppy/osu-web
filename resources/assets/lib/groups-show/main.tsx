// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4';
import { UserList } from 'components/user-list';
import GroupJson from 'interfaces/group-json';
import UserJson from 'interfaces/user-json';
import * as React from 'react';

interface Props {
  group: GroupJson;
  users: UserJson[];
}

export class Main extends React.PureComponent<Props> {
  render() {
    return (
      <div className='osu-layout osu-layout--full'>
        <HeaderV4 theme='friends' />

        <div className='osu-page osu-page--users'>
          <UserList
            descriptionHtml={this.props.group.description?.html}
            playmodeFilter={this.props.group.has_playmodes}
            playmodeFilterGroupId={this.props.group.id}
            title={this.props.group.name}
            users={this.props.users}
          />
        </div>
      </div>
    );
  }
}
