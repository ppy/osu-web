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
import { PopupMenu } from 'popup-menu';
import * as React from 'react';
import { UserCards } from 'user-cards';

enum SortMode {
  LastVisit = 'last_visit',
  Username = 'username',
}

interface Props {
  title?: string;
  users: User[];
}

interface State {
  sortMode: SortMode;
}

export class Main extends React.PureComponent<Props> {
  readonly state: State = {
    sortMode: SortMode.LastVisit,
   };

  onSelected = (key: keyof typeof SortMode, dismiss: () => void) => {
    dismiss();
    this.setState({ sortMode: SortMode[key] });
  }

  render(): React.ReactNode {
    const items = (dismiss: () => void) =>
      // issue when inferring key type of enum.
      // https://github.com/Microsoft/TypeScript/issues/17800
      Object.keys(SortMode).map((key: keyof typeof SortMode) => {
        return (
            <button
              className='simple-menu__item js-login-required--click'
              key={key}
              onClick={() => this.onSelected(key, dismiss)}>{key}
            </button>
        );
      });

    return (
      <div className='user-list'>
        <div className='user-list__toolbar'>
          <span className='user-list__sort'>
            sort by
            <span className='user-list__sort-select'>
              {this.state.sortMode}
            </span>
            <span className='user-list__sort-select fas fa-angle-down' />
            <PopupMenu showGlyph={false}>
              {items}
            </PopupMenu>
          </span>
        </div>

        <UserCards users={this.sortedUsers} />
      </div>
    );
  }

  private get sortedUsers() {
    const users = this.props.users.slice();

    switch (this.state.sortMode) {
      case SortMode.LastVisit:
        return users.sort((x, y) => moment(y.last_visit || 0).unix() - moment(x.last_visit || 0).unix());
    }

    return users.sort((x, y) => x.username.localeCompare(y.username));
  }
}
