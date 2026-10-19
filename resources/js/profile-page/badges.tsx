// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserBadgeJson from 'interfaces/user-badge-json';
import * as React from 'react';
import { Modifiers, classWithModifiers } from 'utils/css';
import Badge from './badge';

interface Props {
  badges: UserBadgeJson[];
  modifiers?: Modifiers;
}

export default class Badges extends React.PureComponent<Props> {
  render() {
    if (this.props.badges.length === 0) return null;

    return (
      <div className={classWithModifiers('profile-badges', this.props.modifiers)}>
        {this.props.badges.map((badge) => <Badge key={badge.image_url} badge={badge} />)}
      </div>
    );
  }
}
