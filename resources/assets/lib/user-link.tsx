// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJSON from 'interfaces/user-json';
import { route } from 'laroute';
import * as React from 'react';

interface Props {
  user: UserJSON;
}

export class UserLink extends React.PureComponent<Props> {
  render() {
    return (
      <a
        className='js-usercard'
        data-user-id={this.props.user.id}
        href={route('users.show', { user: this.props.user.id })}
      >
        {this.props.user.username}
      </a>
    );
  }
}
