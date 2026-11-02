// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserBadgeJson from 'interfaces/user-badge-json';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import Controller from './controller';

interface Props {
  badge: UserBadgeJson;
  controller: Controller;
}

@observer
export default class BadgePinButton extends React.PureComponent<Props> {
  @computed
  private get isActivated() {
    return this.props.controller.state.user.profile_pinned_badge === this.props.badge.image;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <button
        className={classWithModifiers('btn-circle', 'page-toggle', { activated: this.isActivated })}
        onClick={this.onClickPin}
        title={trans(`users.show.badge.pin.to_${+!this.isActivated}`)}
        type='button'
      >
        <span className='fas fa-thumbtack' />
      </button>
    );
  }

  private readonly onClickPin = () => {
    const image = this.isActivated ? null : this.props.badge.image;

    this.props.controller.apiSetPinnedBadge(image);
  };
}
