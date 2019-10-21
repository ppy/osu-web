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
import { activeKeyDidChange, ContainerContext, KeyContext, State as ActiveKeyState } from 'stateful-activation-context';
import { UserCard, ViewMode } from 'user-card';

interface Props {
  modifiers: string[];
  users: User[];
  viewMode: ViewMode;
}

export class UserCards extends React.PureComponent<Props> {
  static defaultProps = {
    modifiers: [],
  };

  readonly activeKeyDidChange = activeKeyDidChange.bind(this);
  readonly state: ActiveKeyState = {};

  render() {
    const classMods = this.state.activeKey != null ? ['menu-active'] : [];
    classMods.push(this.props.viewMode);

    return (
      <ContainerContext.Provider value={{ activeKeyDidChange: this.activeKeyDidChange }}>
        <div className={osu.classWithModifiers('user-cards', classMods)}>
          {
            this.props.users.map((user) => {
              const activated = this.state.activeKey === user.id;

              return (
                <KeyContext.Provider key={user.id} value={user.id}>
                  <UserCard activated={activated} mode={this.props.viewMode} modifiers={['has-outline', ...this.props.modifiers]} user={user} />
                </KeyContext.Provider>
              );
            })
          }
        </div>
      </ContainerContext.Provider>
    );
  }
}
