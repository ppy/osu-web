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
import Notification from 'models/notification';
import * as React from 'react';
import { Spinner } from 'spinner';
import ItemCompact from './item-compact';
import ItemProps from './item-props';
import { group as url } from './url';
import { withMarkRead, WithMarkReadProps } from './with-mark-read';

interface State {
  expanded: boolean;
}

interface IconsMap {
  [key: string]: string[];
}

const ITEM_CATEGORY_ICONS: IconsMap = {
  beatmapset_discussion: ['fas fa-drafting-compass', 'fas fa-comment'],
  beatmapset_state: ['fas fa-drafting-compass'],
  forum_topic_reply: ['fas fa-comment-medical'],
  legacy_pm: ['fas fa-envelope'],
};

export default withMarkRead(observer(class ItemGroup extends React.Component<ItemProps & WithMarkReadProps, State> {
  state = {
    expanded: false,
  };

  render() {
    if (this.props.items.length === 0) {
      return null;
    }

    const item = this.props.item;

    return (
      <div className='notification-popup-item-group'>
        <div className='notification-popup-item notification-popup-item--group clickable-row' onClick={this.props.markReadFallback}>
          <div
            className='notification-popup-item__cover'
            style={{
              backgroundImage: osu.urlPresence(item.details.coverUrl),
            }}
          >
            <div className='notification-popup-item__cover-overlay'>
              {this.renderCoverIcon()}
            </div>
          </div>
          <div className='notification-popup-item__main'>
            <div className='notification-popup-item__content'>
              <div className='notification-popup-item__row notification-popup-item__row--name'>
                {osu.trans(`notifications.item.${item.objectType}.${item.category}._`)}
              </div>
              {this.renderMessage()}
              <div
                className='notification-popup-item__row notification-popup-item__row--time'
                dangerouslySetInnerHTML={{
                  __html: osu.timeago(item.createdAtJson),
                }}
              />
              <div className='notification-popup-item__expand'>
                {this.renderExpandButton()}
              </div>
            </div>
            <div className='notification-popup-item__side-buttons'>
              {this.renderMarkAsReadButton()}
            </div>
          </div>
        </div>
        {this.renderItems()}
      </div>
    );
  }

  private renderCoverIcon() {
    if (this.props.items.length === 0) {
      return null;
    }

    const item = this.props.items[0];

    if (item.name == null || item.category == null) {
      return null;
    }

    const icons = ITEM_CATEGORY_ICONS[item.category];

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

  private renderExpandButton() {
    return (
      <button
        type='button'
        className='show-more-link show-more-link--notification-group show-more-link--t-greysky'
        onClick={this.toggleExpand}
      >
        <span className='show-more-link__label'>
          <span className='show-more-link__label-text'>
            {osu.transChoice('common.count.update', this.props.items.length)}
          </span>
          <span className='show-more-link__label-icon'>
            <span className={`fas fa-angle-${this.state.expanded ? 'up' : 'down'}`} />
          </span>
        </span>
      </button>
    );
  }

  private renderItem = (item: Notification) => {
    return (
      <div className='notification-popup-item-group__item' key={item.id}>
        <ItemCompact item={item} items={[item]} worker={this.props.worker} />
      </div>
    );
  }

  private renderItems() {
    if (!this.state.expanded) {
      return null;
    }

    return <div className='notification-popup-item-group__items'>{this.props.items.map(this.renderItem)}</div>;
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
          onClick={this.props.markRead}
        >
          <span className='fas fa-times' />
        </button>
      );
    }
  }

  private renderMessage() {
    if (this.props.items.length === 0) {
      return null;
    }

    return (
      <a href={url(this.props.item)} className='notification-popup-item__row notification-popup-item__row--message clickable-row-link'>
        {this.props.item.details.title}
      </a>
    );
  }

  private toggleExpand = () => {
    this.setState({ expanded: !this.state.expanded });
  }
}));
