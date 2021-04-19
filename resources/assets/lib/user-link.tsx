// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import * as React from 'react';

interface Props {
  children?: React.ReactNode;
  className?: string;
  user: {
    id?: number;
    username: string;
  };
}

export class UserLink extends React.PureComponent<Props> {
  render() {
    let className = 'js-usercard';
    if (this.props.className != null) {
      className += ` ${this.props.className}`;
    }

    const href = this.props.user.id ? route('users.show', { user: this.props.user.id }) : undefined;

    return (
      <a
        className={className}
        data-user-id={this.props.user.id}
        href={href}
      >
        {this.props.children ?? this.props.user.username}
      </a>
    );
  }
}
