// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
