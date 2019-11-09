/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import * as React from 'react';
import { UserCard } from 'user-card';

interface Props {
  container: HTMLElement;
  user: User;
}

interface State {
  user?: User;
}

/**
 * This component's job shims UserCard for store-supporter-tag to update UserCard's props.
 */
export class UserCardStore extends React.PureComponent<Props, State> {
  readonly state: State = { user: this.props.user };

  componentDidMount() {
    $.subscribe('store-supporter-tag:update-user.user-card-store', this.setUser);
  }

  componentWillUnmount() {
    $.unsubscribe('.user-card-store');
  }

  render() {
    return <UserCard user={this.state.user} />;
  }

  setUser = (event: JQuery.Event, user?: User) => {
    this.setState({ user });
  }
}
