// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BlockButton } from 'block-button';
import UserJson from 'interfaces/user-json';
import { find } from 'lodash';
import { NotificationBanner } from 'notification-banner';
import * as osu from 'osu-common';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  user: UserJson;
}

interface State {
  forceShow: boolean;
}

export default class UserProfileContainer extends React.PureComponent<Props, State> {
  state = { forceShow: false };

  render() {
    const isBlocked = find(currentUser.blocks, { target_id: this.props.user.id });

    let cssClass: string | undefined;
    const modifiers = ['full'];
    if (isBlocked && !this.state.forceShow) {
      cssClass = 'osu-layout__no-scroll';
      modifiers.push('masked');
    }

    return (
      <div className={cssClass}>
        {isBlocked && this.renderBanner()}
        <div className={classWithModifiers('osu-layout', modifiers)}>
          {this.props.children}
        </div>
      </div>
    );
  }

  renderBanner() {
    const message = (
      <div className='grid-items grid-items--notification-banner-buttons'>
        <div>
          <BlockButton userId={this.props.user.id} />
        </div>
        <div>
          <button className='textual-button' onClick={this.handleClick} type='button'>
            <span>
              <i className='textual-button__icon fas fa-low-vision' />
              {' '}
              {this.state.forceShow ? osu.trans('users.blocks.hide_profile') : osu.trans('users.blocks.show_profile')}
            </span>
          </button>
        </div>
      </div>
    );

    return (
      <div className='osu-page'>
        <NotificationBanner message={message} title={osu.trans('users.blocks.banner_text')} type='warning' />
      </div>
    );
  }

  private handleClick = () => {
    this.setState({ forceShow: !this.state.forceShow });
  };
}
