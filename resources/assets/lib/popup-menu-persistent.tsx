/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import { PopupMenu } from 'popup-menu';
import * as React from 'react';

interface Props {
  activationDidChange: (active: boolean, sender: any) => void;
  items: (dismiss: () => void) => React.ReactFragment;
}

export class PopupMenuPersistent extends React.PureComponent<Props> {
  static defaultProps = {
    // TODO: should be from a provider so it doesn't have to be passed multiple layers down?
    activation: {},
  };

  onHide = () => {
    this.props.activationDidChange(false, this);
  }

  onShow = () => {
    this.props.activationDidChange(true, this);
  }

  render() {
    return (
      <PopupMenu onHide={this.onHide} onShow={this.onShow} items={this.props.items} />
    );
  }
}
