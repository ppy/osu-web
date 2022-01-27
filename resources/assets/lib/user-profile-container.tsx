// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BlockButton from 'components/block-button';
import UserJson from 'interfaces/user-json';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import { NotificationBanner } from 'notification-banner';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { isBlocked } from 'utils/user-helper';

interface Props {
  user: UserJson;
}

interface State {
  forceShow: boolean;
}

@observer
export default class UserProfileContainer extends React.Component<Props, State> {
  // TODO: move to context?
  state = { forceShow: false };

  @computed
  get isBlocked() {
    return isBlocked(this.props.user);
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    let cssClass: string | undefined;
    const modifiers = ['full'];
    if (this.isBlocked && !this.state.forceShow) {
      cssClass = 'osu-layout__no-scroll';
      modifiers.push('masked');
    }

    return (
      <div className={cssClass}>
        {this.isBlocked && this.renderBanner()}
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
