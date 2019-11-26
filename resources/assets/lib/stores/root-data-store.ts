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

import { BeatmapsetSearch } from 'beatmaps/beatmapset-search';
import Dispatcher from 'dispatcher';
import { CommentBundleJSON } from 'interfaces/comment-json';
import { action, observable } from 'mobx';
import { BeatmapsetStore } from './beatmapset-store';
import ChannelStore from './channel-store';
import ClientStore from './client-store';
import CommentStore from './comment-store';
import CommentableMetaStore from './commentable-meta-store';
import NotificationStackStore from './notification-stack-store';
import NotificationStore from './notification-store';
import OwnClientStore from './own-client-store';
import UIStateStore from './ui-state-store';
import UnreadNotificationStackStore from './unread-notification-stack-store';
import UserStore from './user-store';

import Notification from 'models/notification';
import NotificationStack from 'models/notification-stack';
import NotificationType from 'models/notification-type';

export default class RootDataStore {
  beatmapsetSearch: BeatmapsetSearch;
  beatmapsetStore: BeatmapsetStore;
  channelStore: ChannelStore;
  clientStore: ClientStore;
  commentableMetaStore: CommentableMetaStore;
  commentStore: CommentStore;
  notificationStackStore: NotificationStackStore;
  notificationStore: NotificationStore;
  ownClientStore: OwnClientStore;
  uiState: UIStateStore;
  unreadNotificationStackStore: NotificationStackStore;
  userStore: UserStore;

  @observable notificationsRead = {
    notifications: [] as Notification[],
    stack: null as NotificationStack | null,
    type: null as NotificationType | null,
  };

  constructor(dispatcher: Dispatcher) {
    // TODO: needs re-re-refactoring
    this.uiState = new UIStateStore(this, dispatcher);
    this.beatmapsetStore = new BeatmapsetStore(this, dispatcher);
    this.beatmapsetSearch = new BeatmapsetSearch(this.beatmapsetStore, dispatcher);
    this.clientStore = new ClientStore(this, dispatcher);
    this.commentableMetaStore = new CommentableMetaStore(this, dispatcher);
    this.commentStore = new CommentStore(this, dispatcher);
    this.channelStore = new ChannelStore(this, dispatcher);
    this.notificationStore = new NotificationStore(this, dispatcher);
    this.notificationStackStore = new NotificationStackStore(this, dispatcher);
    this.unreadNotificationStackStore = new UnreadNotificationStackStore(this, dispatcher);
    this.ownClientStore = new OwnClientStore(this, dispatcher);
    this.userStore = new UserStore(this, dispatcher);
  }

  @action
  updateWithCommentBundleJSON(commentBundle: CommentBundleJSON) {
    this.commentableMetaStore.updateWithJSON(commentBundle.commentable_meta);
    this.commentStore.updateWithJSON(commentBundle.comments);
    this.commentStore.updateWithJSON(commentBundle.included_comments);
    this.userStore.updateWithJSON(commentBundle.users);
    this.commentStore.addVoted(commentBundle.user_votes);
  }
}
