/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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
          canMarkRead={this.canMarkRead()}
          markRead={this.markRead}
          markReadFallback={this.markReadFallback}
          markingAsRead={this.state.markingAsRead}
          {...this.props}
        />
      );
    }

    private canMarkRead = () => {
      return this.props.item.id > 0;
    }

    private markRead = () => {
      if (this.state.markingAsRead) {
        return;
      }

      if (!this.canMarkRead()) {
        return;
      }

      this.setState({ markingAsRead: true });
      const ids = this.props.items.map((i) => i.id);

      this.props.worker.sendMarkRead(ids)
      .fail(() => {
        if (!this.isComponentMounted) {
          return;
        }

        this.setState({ markingAsRead: false });
      });
    }

    private markReadFallback = (event: React.MouseEvent<HTMLElement>) => {
      if (!osu.isClickable(event.target as HTMLElement)) {
        this.markRead();
      }
    }
  };
}
