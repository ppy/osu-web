// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

    return <Component key={this.props.stack.id} stack={this.props.stack} />;
  }
}
