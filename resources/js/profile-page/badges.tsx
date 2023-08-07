// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Img2x from 'components/img2x';
import UserBadgeJson from 'interfaces/user-badge-json';
import * as React from 'react';
import { present } from 'utils/string';

interface Props {
  badges: UserBadgeJson[];
}

export default class Badges extends React.PureComponent<Props> {
  static defaultProps = { badges: [] };

  render() {
    if (this.props.badges.length === 0) return null;

    return (
      <div className='profile-badges'>
        {this.props.badges.map((badge) => {
          const img = (
            <Img2x
              className='profile-badges__badge'
              src={badge.image_url}
              title={badge.description}
            />
          );

          return present(badge.url) ? (
            <a key={badge.image_url} href={badge.url}>
              {img}
            </a>
          ) : (
            <span key={badge.image_url}>
              {img}
            </span>
          );
        })}
      </div>
    );
  }
}
