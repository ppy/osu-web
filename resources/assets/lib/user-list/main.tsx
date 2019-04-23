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
import { UserCards } from 'user-cards';

interface PropsInterface {
  data: {
    online: [],
    offline: [],
  };
  title?: string;
}

export class Main extends React.PureComponent<PropsInterface> {
  render(): React.ReactNode {
    const online: any = this.props.data.online;
    const offline: any = this.props.data.offline;

    return (
      <div className='user-list'>
        {
          this.props.title != null
            ? <h2 className='user-list__title'>{this.props.title}</h2>
            : null
        }
        <div className='page-title page-title--lighter'>{osu.trans('users.status.online')} ({online.length})</div>
        <UserCards users={online} />
        <div className='page-title page-title--lighter'>{osu.trans('users.status.offline')} ({offline.length})</div>
        <UserCards users={offline} />
      </div>
    );
  }
}
