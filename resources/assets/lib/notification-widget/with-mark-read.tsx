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

import * as React from 'react';
import ItemProps from './item-props';

interface State {
  markingAsRead: boolean;
}

export interface WithMarkReadProps {
  canMarkRead: boolean;
  markingAsRead: boolean;
  markRead: () => void;
  markReadFallback: (event: React.MouseEvent<HTMLElement>) => void;
}

export function withMarkRead(Component: React.ComponentType<ItemProps & WithMarkReadProps>) {
  return class extends React.Component<ItemProps, State> {
    state = {
      markingAsRead: false,
    };

    private isComponentMounted = false;

    componentDidMount() {
      this.isComponentMounted = true;
    }

    componentWillUnmount() {
      this.isComponentMounted = false;
    }

    render() {
      return (
        <Component
          markReadFallback={this.markReadFallback}
          {...this.props}
        />
      );
    }

    private markRead = () => {
      if (this.state.markingAsRead) {
        return;
      }

      // this.setState({ markingAsRead: true });
      // const ids = this.props.items.map((i) => i.id);

      this.props.items.forEach((notification) => notification.markAsRead());
      // .fail(() => {
      //   if (!this.isComponentMounted) {
      //     return;
      //   }

      //   this.setState({ markingAsRead: false });
      // });
    }

    private markReadFallback = (event: React.MouseEvent<HTMLElement>) => {
      if (!osu.isClickable(event.target as HTMLElement)) {
        this.markRead();
      }
    }
  };
}
