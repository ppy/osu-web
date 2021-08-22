// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetSearch } from 'beatmaps/beatmapset-search';
import ChatStateStore from 'chat/chat-state-store';
import { CommentBundleJson } from 'interfaces/comment-json';
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
  chatState: ChatStateStore;
  clientStore: ClientStore;
  commentStore: CommentStore;
  commentableMetaStore: CommentableMetaStore;
  notificationStore: NotificationStore;
  ownClientStore: OwnClientStore;
  uiState: UIStateStore;
  userStore: UserStore;

  constructor() {
    // TODO: needs re-re-refactoring
    this.beatmapsetStore = new BeatmapsetStore();
    this.beatmapsetSearch = new BeatmapsetSearch(this.beatmapsetStore);
    this.clientStore = new ClientStore();
    this.commentableMetaStore = new CommentableMetaStore();
    this.commentStore = new CommentStore();
    this.notificationStore = new NotificationStore();
    this.ownClientStore = new OwnClientStore();
    this.userStore = new UserStore();
    this.channelStore = new ChannelStore(this.userStore);
    this.chatState = new ChatStateStore(this.channelStore);
    this.uiState = new UIStateStore(this.commentStore);
  }

  @action
  updateWithCommentBundleJson(commentBundle: CommentBundleJson) {
    this.commentableMetaStore.updateWithJson(commentBundle.commentable_meta);
    this.commentStore.updateWithJson(commentBundle.comments);
    this.commentStore.updateWithJson(commentBundle.included_comments);
    this.commentStore.updateWithJson(commentBundle.pinned_comments);
    this.userStore.updateWithJson(commentBundle.users);
    this.commentStore.addVoted(commentBundle.user_votes);
  }
}
