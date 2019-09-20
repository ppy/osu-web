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

import DispatcherAction from 'actions/dispatcher-action';
import ChatStateStore from 'chat/chat-state-store';
import { CommentBundleJSON } from 'interfaces/comment-json';
import { Dictionary, orderBy } from 'lodash';
import { action, observable } from 'mobx';
import { Comment, CommentSort } from 'models/comment';
import Store from 'stores/store';

interface CommentsUIState {
  currentSort: CommentSort;
  hasMoreComments: Dictionary<boolean>;
  isShowDeleted: boolean;
  loadingFollow: boolean | null;
  loadingSort: CommentSort | null;
  topLevelCommentIds: number[];
  topLevelCount: number;
  total: number;
  userFollow: boolean;
}

const defaultCommentsUIState: CommentsUIState = {
  currentSort: 'new',
  hasMoreComments: {},
  isShowDeleted: false,
  loadingFollow: null,
  loadingSort: null,
  topLevelCommentIds: [],
  topLevelCount: 0,
  total: 0,
  userFollow: false,
};

export default class UIStateStore extends Store {
  chat = new ChatStateStore(this.root, this.dispatcher);

  // only for the currently visible page
  @observable comments = Object.assign({}, defaultCommentsUIState);
  private orderedCommentsByParentId: Dictionary<Comment[]> = {};

  getOrderedCommentsByParentId(parentId: number) {
    if (this.orderedCommentsByParentId[parentId] == null) {
      const comments = this.root.commentStore.getRepliesByParentId(parentId);
      this.orderedCommentsByParentId[parentId] = orderBy(comments, 'votes_count', 'desc');
    }

    return this.orderedCommentsByParentId[parentId];
  }

  handleDispatchAction(action: DispatcherAction) { /* do nothing */}

  @action
  importCommentsUIStateJSON(json: any) {
    this.comments = Object.assign({}, defaultCommentsUIState, json);
  }

  @action
  initializeWithCommentBundleJSON(commentBundle: CommentBundleJSON) {
    this.comments.hasMoreComments[commentBundle.has_more_id] = commentBundle.has_more;
    this.comments.currentSort = commentBundle.sort as CommentSort;
    this.comments.userFollow = commentBundle.user_follow;
    this.comments.topLevelCount = commentBundle.top_level_count;
    this.comments.total = commentBundle.total;

    if (commentBundle.comments != null) {
      this.comments.topLevelCommentIds = commentBundle.comments.map((x) => x.id);
    }
  }

  @action
  updateWithCommentBundleJSON(commentBundle: Partial<CommentBundleJSON>) {
    if (commentBundle.has_more_id !== undefined && commentBundle.has_more !== undefined) {
      this.comments.hasMoreComments[commentBundle.has_more_id] = commentBundle.has_more;
    }

    if (commentBundle.sort !== undefined) this.comments.currentSort = commentBundle.sort as CommentSort;
    if (commentBundle.user_follow !== undefined) this.comments.userFollow = commentBundle.user_follow;
    if (commentBundle.top_level_count !== undefined) this.comments.topLevelCount = commentBundle.top_level_count;
    if (commentBundle.total !== undefined) this.comments.total = commentBundle.total;

    if (commentBundle.comments !== undefined) {
      const ids = commentBundle.comments.map((x) => x.id);

      // don't add existing ids; vote updates, etc will have existing ids.
      for (const id of ids) {
        if (!this.comments.topLevelCommentIds.includes(id)) {
          this.comments.topLevelCommentIds.push(id);
        }
      }
    }
  }
}
