/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import { BeatmapsetSearch } from 'beatmaps/beatmapset-search';
import Dispatcher from 'dispatcher';
import { CommentBundleJSON } from 'interfaces/comment-json';
import { action } from 'mobx';
import { BeatmapsetStore } from './beatmapset-store';
import ChannelStore from './channel-store';
import ClientStore from './client-store';
import CommentStore from './comment-store';
import CommentableMetaStore from './commentable-meta-store';
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
  ownClientStore: OwnClientStore;
  uiState: UIStateStore;
  userStore: UserStore;

  constructor(dispatcher: Dispatcher) {
    // TODO: needs re-re-refactoring
    this.uiState = new UIStateStore(this, dispatcher);
    this.beatmapsetStore = new BeatmapsetStore(this, dispatcher);
    this.beatmapsetSearch = new BeatmapsetSearch(this.beatmapsetStore, dispatcher);
    this.clientStore = new ClientStore(this, dispatcher);
    this.commentableMetaStore = new CommentableMetaStore(this, dispatcher);
    this.commentStore = new CommentStore(this, dispatcher);
    this.channelStore = new ChannelStore(this, dispatcher);
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
