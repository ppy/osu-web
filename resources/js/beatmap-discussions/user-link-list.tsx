// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserLink from 'components/user-link';
import UserJson from 'interfaces/user-json';
import React from 'react';

interface Props {
  users: Pick<UserJson, 'id' | 'username'>[];
}

export default class UserLinkList extends React.PureComponent<Props> {
  render() {
    const endIndex = this.props.users.length - 1;

    return this.props.users.map((user, index) => (
      <React.Fragment key={index}>
        <UserLink user={user} />
        {index < endIndex && ', '}
      </React.Fragment>
    ));
  }
}
