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

import * as _ from 'lodash';
import { observer } from 'mobx-react';
import { nameToIcons } from 'notification-maps/icons';
import { messageOne } from 'notification-maps/message';
import { urlOne } from 'notification-maps/url';
import * as React from 'react';
import { Spinner } from 'spinner';
import ItemProps from './item-props';
import { withMarkRead, WithMarkReadProps } from './with-mark-read';

export default withMarkRead(observer(class ItemOne extends React.Component<ItemProps & WithMarkReadProps, {}> {
  render() {
    return (
      <div className='notification-popup-item clickable-row' onClick={this.props.markRead}>
        <div
          className='notification-popup-item__cover'
          style={{
            backgroundImage: osu.urlPresence(this.props.item.details.coverUrl),
          }}
        >
          <div className='notification-popup-item__cover-overlay'>
            {this.renderCoverIcon()}
          </div>
        </div>
        <div className='notification-popup-item__main'>
          <div className='notification-popup-item__content'>
            {this.renderCategory()}
            {this.renderMessage()}
            {this.renderTime()}
          </div>
          <div className='notification-popup-item__side-buttons'>
            {this.renderMarkAsReadButton()}
          </div>
        </div>
      </div>
    );
  }

  private renderCategory() {
    const label = osu.trans(`notifications.item.${this.props.item.objectType}.${this.props.item.category}._`);

    if (label === '') {
      return null;
    }

    return <div className='notification-popup-item__row notification-popup-item__row--category'>{label}</div>;
  }

  private renderCoverIcon() {
    const icons = nameToIcons[this.props.item.name || ''];

    if (icons == null) {
      return null;
    }

    return icons.map((icon) => {
      return (
        <div key={icon} className='notification-popup-item__cover-icon'>
          <span className={icon} />
        </div>
      );
    });
  }

  private renderMarkAsReadButton() {
    if (!this.props.canMarkRead) {
      return null;
    }

    if (this.props.markingAsRead) {
      return (
        <div className='notification-popup-item__read-button'>
          <Spinner />
        </div>
      );
    } else {
      return (
        <button
          type='button'
          className='notification-popup-item__read-button'
        >
          <span className='fas fa-times' />
        </button>
      );
    }
  }

  private renderMessage() {
    return (
      <a href={urlOne(this.props.item)} className='notification-popup-item__row notification-popup-item__row--message clickable-row-link'>
        {messageOne(this.props.item)}
      </a>
    );
  }

  private renderTime() {
    if (this.props.item.createdAtJson == null) {
      return null;
    }

    return (
      <div
        className='notification-popup-item__row notification-popup-item__row--time'
        dangerouslySetInnerHTML={{
          __html: osu.timeago(this.props.item.createdAtJson),
        }}
      />
    );
  }
}));
