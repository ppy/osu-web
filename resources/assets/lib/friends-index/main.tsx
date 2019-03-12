/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import * as React from 'react';
import { UserCard } from 'user-card';

interface PropsInterface {
  data: [];
}

export class Main extends React.PureComponent<PropsInterface> {
  render(): React.ReactNode {
    const users: any = this.props.data;
    const usersjsx: React.ReactNode[] = [];

    for (const user of users) {
      usersjsx.push(<UserCard key={user.id} user={user} />);
    }

    return (
      <div className='user-friends'>
        <h2 className='user-friends__title'>{ osu.trans('friends.title') }</h2>
        <div className='page-title page-title--lighter'>Users ({users.length})</div>
          <div className='usercard-list'>
            <div className='usercard-list__cards'>
              { usersjsx }
            </div>
          </div>
      </div>
    );
  }
}
