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
import * as React from 'react';
import { Spinner } from 'spinner';

interface Props {
  isMarkingAsRead: boolean;
  modifiers: string[];
  onMarkAsRead?: () => void;
  text?: string;
}

@observer
export default class NotificationReadButton extends React.Component<Props> {
  static defaultProps = {
    modifiers: [],
  };

  render() {
    if (this.props.isMarkingAsRead) {
      return (
        <div className={osu.classWithModifiers('notification-read-button', this.props.modifiers)}>
          <span className='notification-read-button__text'>{this.props.text}</span>
          <div className='notification-read-button__icon'>
            <Spinner />
          </div>
        </div>
      );
    } else {
      return (
        <button
          type='button'
          className={osu.classWithModifiers('notification-read-button', this.props.modifiers)}
          onClick={this.props.onMarkAsRead}
        >
          <span className='notification-read-button__text'>{this.props.text}</span>
          <div className='notification-read-button__icon'>
            <span className='fas fa-times' />
          </div>
        </button>
      );
    }
  }
}
