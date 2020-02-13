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

import { observer } from 'mobx-react';
import NotificationStack from 'models/notification-stack';
import * as React from 'react';
import ItemGroup from './item-group';
import ItemSingular from './item-singular';

interface Props {
  stack: NotificationStack;
}

@observer
export default class Stack extends React.Component<Props> {
  render() {
    if (!this.props.stack.hasVisibleNotifications) {
      return null;
    }

    const Component = this.props.stack.isSingle ? ItemSingular : ItemGroup;

    return <Component stack={this.props.stack} key={this.props.stack.id} />;
  }
}
