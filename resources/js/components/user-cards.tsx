// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { ContainerContext, KeyContext } from 'stateful-activation-context';
import { classWithModifiers, mergeModifiers, Modifiers } from 'utils/css';
import { UserCard, ViewMode } from './user-card';

interface Props {
  modifiers?: Modifiers;
  users: UserJson[];
  viewMode: ViewMode;
}

@observer
export class UserCards extends React.PureComponent<Props> {
  @observable activeKey: number | null = null;
  private readonly containerContextValue;

  constructor(props: Props) {
    super(props);
    makeObservable(this);
    this.containerContextValue = { activeKeyDidChange: this.activeKeyDidChange };
  }

  render() {
    const classMods = {
      'menu-active': this.activeKey != null,
      [this.props.viewMode]: true,
    };

    return (
      <ContainerContext.Provider value={this.containerContextValue}>
        <div className={classWithModifiers('user-cards', classMods)}>
          {
            this.props.users.map((user) => {
              const activated = this.activeKey === user.id;

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

  @action
  private readonly activeKeyDidChange = (key: number | null) => {
    this.activeKey = key;
  };
}
