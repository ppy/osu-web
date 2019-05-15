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
import LegacyPmNotification from 'models/legacy-pm-notification';
import * as React from 'react';
import { Spinner } from 'spinner';
import ItemProps from './item-props';
import { one as url } from './url';
import { withMarkRead, WithMarkReadProps } from './with-mark-read';

interface IconsMap {
  [key: string]: string[];
}

const ITEM_NAME_ICONS: IconsMap = {
  beatmapset_discussion_lock: ['fas fa-drafting-compass', 'fas fa-lock'],
  beatmapset_discussion_post_new: ['fas fa-drafting-compass', 'fas fa-comment-medical'],
  beatmapset_discussion_unlock: ['fas fa-drafting-compass', 'fas fa-unlock'],
  beatmapset_disqualify: ['fas fa-drafting-compass', 'far fa-times-circle'],
  beatmapset_love: ['fas fa-drafting-compass', 'fas fa-heart'],
  beatmapset_nominate: ['fas fa-drafting-compass', 'fas fa-vote-yea'],
  beatmapset_qualify: ['fas fa-drafting-compass', 'fas fa-check'],
  beatmapset_reset_nominations: ['fas fa-drafting-compass', 'fas fa-undo'],
  forum_topic_reply: ['fas fa-comment-medical'],
  legacy_pm: ['fas fa-envelope'],
};

export default withMarkRead(observer(class ItemOne extends React.Component<ItemProps & WithMarkReadProps, {}> {
  render() {
    const item = this.props.item;

    return (
      <div className='notification-popup-item clickable-row' onClick={this.props.markRead}>
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
          </div>
          <div className='notification-popup-item__side-buttons'>
            {this.renderMarkAsReadButton()}
          </div>
        </div>
      </div>
    );
  }

  private renderCoverIcon() {
    const item = this.props.item;

    if (item.name == null || item.category == null) {
      return null;
    }

    const icons = ITEM_NAME_ICONS[item.name];

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
    const item = this.props.item;
    let message: string;

    const replacements = {
      title: item.details.title,
      username: item.details.username,
    };

    const key = `notifications.item.${item.objectType}.${item.category}.${item.name}`;

    if (item instanceof LegacyPmNotification) {
      message = osu.transChoice(key, item.details.count, replacements);
    } else {
      message = osu.trans(key, replacements);
    }

    return (
      <a href={url(this.props.item)} className='notification-popup-item__row notification-popup-item__row--message clickable-row-link'>
        {message}
      </a>
    );
  }
}));
