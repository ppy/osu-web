// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';
import osu from 'osu-common';
import * as React from 'react';
import { activeKeyDidChange, ContainerContext, KeyContext, State as ActiveKeyState } from 'stateful-activation-context';
import { UserCard, ViewMode } from 'user-card';
import { classWithModifiers } from 'utils/css';

interface Props {
  modifiers: string[];
  users: UserJson[];
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
        <div className={classWithModifiers('user-cards', classMods)}>
          {
            this.props.users.map((user) => {
              const activated = this.state.activeKey === user.id;

              return (
                <KeyContext.Provider key={user.id} value={user.id}>
                  <UserCard
                    activated={activated}
                    mode={this.props.viewMode}
                    modifiers={['has-outline', ...this.props.modifiers]}
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
