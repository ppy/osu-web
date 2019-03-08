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

interface PropsInterface {
  userId: number | string;
}

interface StateInterface {
  user: User;
}

/**
 * This component's job is to get the data and bootstrap the actual UserCard component for tooltips.
 */
export class UserCardTooltip extends React.PureComponent<PropsInterface, StateInterface> {
  constructor(props: PropsInterface) {
    super(props);

    this.state = {
      user: {
        cover: {},
        default_group: '',
        id: -1,
        is_active: false,
        is_bot: false,
        is_online: false,
        is_supporter: false,
        pm_friends_only: true,
        username: osu.trans('users.card.loading'),
      },
    };

    this.getUser().then((user) => {
      this.setState({ user });
    });
  }

  async getUser() {
    const url = laroute.route('users.card', { user: this.props.userId });
    const response = await fetch(url, { headers: { Accept: 'application/json' } });
    return await response.json();
  }

  render(): React.ReactNode {
    return <UserCard user={this.state.user} />;
  }
}
