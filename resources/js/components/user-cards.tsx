// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { ActiveKeyState, ContainerContext, KeyContext } from 'stateful-activation-context';
import { classWithModifiers, isModifiersEqual, mergeModifiers, Modifiers } from 'utils/css';
import { UserCard, ViewMode } from './user-card';

interface Props {
  modifiers?: Modifiers;
  users: UserJson[];
  viewMode: ViewMode;
}

@observer
export class UserCards extends React.PureComponent<Props> {
  @observable private readonly activeKeyState = new ActiveKeyState<number>();
  @observable private observableModifiers = this.props.modifiers;

  @computed
  private get modifiers() {
    return mergeModifiers('has-outline', this.observableModifiers);
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  @action
  componentDidUpdate(prevProps: Readonly<Props>) {
    if (!isModifiersEqual(prevProps.modifiers, this.props.modifiers)) {
      this.observableModifiers = this.props.modifiers;
    }
  }

  render() {
    const classMods = {
      'menu-active': this.activeKeyState.value != null,
      [this.props.viewMode]: true,
    };

    return (
      <ContainerContext.Provider value={this.activeKeyState}>
        <div className={classWithModifiers('user-cards', classMods)}>
          {
            this.props.users.map((user) => {
              const activated = this.activeKeyState.value === user.id;

              return (
                <KeyContext.Provider key={user.id} value={user.id}>
                  <UserCard
                    activated={activated}
                    mode={this.props.viewMode}
                    modifiers={this.modifiers}
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
