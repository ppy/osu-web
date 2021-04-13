// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import * as React from 'react';

interface Props {
  className?: string;
  children?: React.ReactNode;
  user: {
    id: number;
    username: string;
  };
}

export class UserLink extends React.PureComponent<Props> {
  render() {
    let className = 'js-usercard';
    if (this.props.className != null) {
      className += ` ${this.props.className}`;
    }

    return (
      <a
        className={className}
        data-user-id={this.props.user.id}
        href={route('users.show', { user: this.props.user.id })}
      >
        {this.props.children ?? this.props.user.username}
      </a>
    );
  }
}
