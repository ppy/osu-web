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
import { CommentBundleJSON } from 'interfaces/comment-json';
import { action } from 'mobx';
import { BeatmapsetStore } from './beatmapset-store';
import ChannelStore from './channel-store';
import ClientStore from './client-store';
import CommentStore from './comment-store';
import CommentableMetaStore from './commentable-meta-store';
import NotificationStore from './notification-store';
import OwnClientStore from './own-client-store';
import UIStateStore from './ui-state-store';
import UserStore from './user-store';

export default class RootDataStore {
  beatmapsetSearch: BeatmapsetSearch;
  beatmapsetStore: BeatmapsetStore;
  channelStore: ChannelStore;
  clientStore: ClientStore;
  commentableMetaStore: CommentableMetaStore;
  commentStore: CommentStore;
  notificationStore: NotificationStore;
  ownClientStore: OwnClientStore;
  uiState: UIStateStore;
  userStore: UserStore;

  constructor() {
    // TODO: needs re-re-refactoring
    this.uiState = new UIStateStore(this);
    this.beatmapsetStore = new BeatmapsetStore(this);
    this.beatmapsetSearch = new BeatmapsetSearch(this.beatmapsetStore);
    this.clientStore = new ClientStore(this);
    this.commentableMetaStore = new CommentableMetaStore(this);
    this.commentStore = new CommentStore(this);
    this.channelStore = new ChannelStore(this);
    this.notificationStore = new NotificationStore();
    this.ownClientStore = new OwnClientStore(this);
    this.userStore = new UserStore(this);
  }

  @action
  updateWithCommentBundleJSON(commentBundle: CommentBundleJSON) {
    this.commentableMetaStore.updateWithJSON(commentBundle.commentable_meta);
    this.commentStore.updateWithJSON(commentBundle.comments);
    this.commentStore.updateWithJSON(commentBundle.included_comments);
    this.commentStore.updateWithJSON(commentBundle.pinned_comments);
    this.userStore.updateWithJSON(commentBundle.users);
    this.commentStore.addVoted(commentBundle.user_votes);
  }
}
