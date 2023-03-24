// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';
import * as React from 'react';
import { activeKeyDidChange, ContainerContext, KeyContext, State as ActiveKeyState } from 'stateful-activation-context';
import { classWithModifiers, mergeModifiers, Modifiers } from 'utils/css';
import { UserCard, ViewMode } from './user-card';

interface Props {
  modifiers?: Modifiers;
  users: UserJson[];
  viewMode: ViewMode;
}

export class UserCards extends React.PureComponent<Props> {
  readonly activeKeyDidChange = activeKeyDidChange.bind(this);
  readonly state: ActiveKeyState = {};

  render() {
    const classMods = {
      'menu-active': this.state.activeKey != null,
      [this.props.viewMode]: true,
    };

    return (
      <ContainerContext.Provider value={{ activeKeyDidChange: this.activeKeyDidChange }}>
        <div className={classWithModifiers('user-cards', classMods)}>
          {
            this.props.users.map((user) => {
              const activated = this.state.activeKey === user.id;

              return (
                <KeyContext.Provider key={user.id} value={user.id}>
                  <UserCard
                    activated={activated}
                    mode={this.props.viewMode}
                    modifiers={mergeModifiers('has-outline', this.props.modifiers)}
                    user={user}
                  />
                </KeyContext.Provider>
              );
            })
          }
        </div>
      </ContainerContext.Provider>
    );
  }
}
