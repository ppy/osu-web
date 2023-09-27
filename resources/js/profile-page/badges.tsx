// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Img2x from 'components/img2x';
import UserBadgeJson from 'interfaces/user-badge-json';
import * as moment from 'moment';
import * as React from 'react';
import { Modifiers, classWithModifiers } from 'utils/css';
import { present } from 'utils/string';

interface Props {
  badges: UserBadgeJson[];
  modifiers?: Modifiers;
}

export default class Badges extends React.PureComponent<Props> {
  static defaultProps = { badges: [] };

  render() {
    if (this.props.badges.length === 0) return null;

    return (
      <div className={classWithModifiers('profile-badges', this.props.modifiers)}>
        {this.props.badges.map((badge) => {
          const hasDate = present(badge.awarded_at);
          const htmlTitle = hasDate ? `<div>${badge.description}</div>
            <div class='profile-badges__date'>${moment(badge.awarded_at).format('LL')}</div>` : null;

          const img = (
            <Img2x
              className='profile-badges__badge'
              data-html-title={htmlTitle}
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
