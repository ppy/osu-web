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

import * as moment from 'moment';
import * as React from 'react';
import { UserCards } from 'user-cards';


interface Props {
  title?: string;
  users: User[];
}

interface State {
  users: User[];
}

export class Main extends React.PureComponent<Props> {
  readonly state: State = { users: [] };

  constructor(props: Props) {
    super(props);

    this.state.users = this.props.users.slice();
    this.state.users.sort((x, y) => moment(y.last_visit || 0).unix() - moment(x.last_visit || 0).unix());
  }

  render(): React.ReactNode {
    return (
      <div className='user-list'>
        {
          this.props.title != null
            ? <h2 className='user-list__title'>{this.props.title}</h2>
            : null
        }
        <div className='page-title page-title--lighter'>({this.props.users.length})</div>
        <UserCards users={this.state.users} />
      </div>
    );
  }
}
