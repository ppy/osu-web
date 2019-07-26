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
