// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Img2x from 'components/img2x';
import UserBadgeJson from 'interfaces/user-badge-json';
import { escape } from 'lodash';
import { observer } from 'mobx-react';
import * as moment from 'moment';
import * as React from 'react';
import { present } from 'utils/string';
import BadgePinButton from './badge-pin-button';
import Controller from './controller';

interface Props {
  badge: UserBadgeJson;
  controller: Controller | undefined;
}

@observer
export default class Badge extends React.PureComponent<Props> {
  render() {
    return (
      <div className='profile-badge'>
        {present(this.props.badge.url) ? (
          <a className='u-contents' href={this.props.badge.url}>
            {this.renderImage()}
          </a>
        ) : this.renderImage()}
        {this.props.controller != null && (
          <span className='profile-badge__pin'>
            <BadgePinButton badge={this.props.badge} controller={this.props.controller} />
          </span>
        )}
      </div>
    );
  }

  private renderImage() {
    return (
      <Img2x
        className='profile-badge__image'
        data-html-title={this.renderTitle()}
        src={this.props.badge.image_url}
        title={this.props.badge.description}
      />
    );
  }

  private renderTitle() {
    return this.props.badge.awarded_at == null
      ? undefined
      : `
        <div class='profile-badge-tooltip'>
          <div>${escape(this.props.badge.description)}</div>
          <div class='profile-badge-tooltip__date'>
            ${moment(this.props.badge.awarded_at).format('LL')}
          </div>
        </div>
      `;
  }
}
