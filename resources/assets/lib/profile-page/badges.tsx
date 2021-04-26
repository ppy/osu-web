// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserBadgeJson from 'interfaces/user-badge-json';
import * as React from 'react';

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
          const props = {
            className: 'profile-badges__badge',
            href: osu.presence(badge.url) ?? undefined,
            key: badge.image_url,
            style: { backgroundImage: osu.urlPresence(badge.image_url) },
            title: badge.description,
          };

          return osu.present(badge.url) ? (
            <a {...props} />
          ) : (
            <span {...props} />
          );
        })}
      </div>
    );
  }
}
