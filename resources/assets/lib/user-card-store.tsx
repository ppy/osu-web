// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';
import * as React from 'react';
import { UserCard } from 'user-card';

interface Props {
  user: UserJson | null;
}

interface State {
  user?: UserJson | null;
}

/**
 * This component's job shims UserCard for store-supporter-tag to update UserCard's props.
 */
export class UserCardStore extends React.PureComponent<Props, State> {
  state: Readonly<State> = { user: this.props.user };

  componentDidMount() {
    $.subscribe('store-supporter-tag:update-user', this.setUser);
  }

  componentWillUnmount() {
    $.unsubscribe('store-supporter-tag:update-user', this.setUser);
  }

  render() {
    return <UserCard user={this.state.user} />;
  }

  setUser = (event: JQuery.Event, user?: UserJson) => {
    this.setState({ user });
  };
}
