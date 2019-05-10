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
import Notification from 'models/notification';
import * as React from 'react';
import { Spinner } from 'spinner';
import Worker from './worker';

interface Props {
  item: Notification;
  worker: Worker;
}

interface State {
  markingAsRead: boolean;
}

interface IconsMap {
  [key: string]: string[];
}

const ITEM_NAME_ICONS: IconsMap = {
  beatmapset_discussion_lock: ['fas fa-lock'],
  beatmapset_discussion_post_new: ['fas fa-comment-medical'],
  beatmapset_discussion_unlock: ['fas fa-unlock'],
  beatmapset_disqualify: ['far fa-times-circle'],
  beatmapset_love: ['fas fa-heart'],
  beatmapset_nominate: ['fas fa-vote-yea'],
  beatmapset_qualify: ['fas fa-check'],
  beatmapset_reset_nominations: ['fas fa-undo'],
  forum_topic_reply: ['fas fa-comment-medical'],
  legacy_pm: ['fas fa-envelope'],
};

@observer
export default class ItemCompact extends React.Component<Props, State> {

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
    const item = this.props.item;

    return (
      <div className='notification-popup-item notification-popup-item--compact clickable-row' onClick={this.markRead}>
        <div className='notification-popup-item__cover'>
          <div className='notification-popup-item__cover-overlay'>
            {this.renderCoverIcon()}
          </div>
        </div>
        <div className='notification-popup-item__main'>
          <div className='notification-popup-item__content'>
            {this.renderMessage()}
            <div
              className='notification-popup-item__time'
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

  private markRead = () => {
    if (this.state.markingAsRead) {
      return;
    }

    if (this.props.item.id < 0) {
      return;
    }

    this.setState({ markingAsRead: true });
    const ids = [this.props.item.id];

    this.props.worker.sendMarkRead(ids)
    .fail(() => {
      if (!this.isComponentMounted) {
        return;
      }

      this.setState({ markingAsRead: false });
    });
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
    if (this.props.item.id < 0) {
      return null;
    }

    if (this.state.markingAsRead) {
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

    const key = `notifications.item.${item.objectType}.${item.category}.${item.name}_compact`;

    if (item instanceof LegacyPmNotification) {
      message = osu.transChoice(key, item.details.count, replacements);
    } else {
      message = osu.trans(key, replacements);
    }

    return (
      <a href={this.url()} className='notification-popup-item__message clickable-row-link'>
        {message}
      </a>
    );
  }

  private url() {
    const item = this.props.item;

    if (item instanceof LegacyPmNotification) {
      return '/forum/ucp.php?i=pm&folder=inbox';
    }

    let route: string = '';
    let params: any;

    switch (item.name) {
      case 'beatmapset_discussion_lock':
        route = 'beatmapsets.discussion';
        params = { beatmapset: item.objectId };
        break;
      case 'beatmapset_discussion_post_new':
        return BeatmapDiscussionHelper.url({
          beatmapId: item.details.beatmapId,
          beatmapsetId: item.objectId,
          discussionId: item.details.discussionId,
        });
      case 'beatmapset_discussion_unlock':
        route = 'beatmapsets.discussion';
        params = { beatmapset: item.objectId };
        break;
      case 'beatmapset_disqualify':
        route = 'beatmapsets.discussion';
        params = { beatmapset: item.objectId };
        break;
      case 'beatmapset_love':
        route = 'beatmapsets.show';
        params = { beatmapset: item.objectId };
        break;
      case 'beatmapset_nominate':
        route = 'beatmapsets.discussion';
        params = { beatmapset: item.objectId };
        break;
      case 'beatmapset_qualify':
        route = 'beatmapsets.discussion';
        params = { beatmapset: item.objectId };
        break;
      case 'beatmapset_reset_nominations':
        route = 'beatmapsets.discussion';
        params = { beatmapset: item.objectId };
        break;
      case 'forum_topic_reply':
        route = 'forum.posts.show';
        params = { post: item.details.postId };
        break;
    }

    if (route != null) {
      return laroute.route(route, params);
    }
  }
}
