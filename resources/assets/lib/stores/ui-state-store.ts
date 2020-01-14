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

import ChatStateStore from 'chat/chat-state-store';
import { CommentBundleJSON } from 'interfaces/comment-json';
import { Dictionary, orderBy } from 'lodash';
import { action, observable } from 'mobx';
import { Comment, CommentSort } from 'models/comment';
import { OwnClient } from 'models/oauth/own-client';
import Store from 'stores/store';

interface AccountUIState {
  client: OwnClient | null;
  isCreatingNewClient: boolean;
  newClientVisible: boolean;
}

interface CommentsUIState {
  currentSort: CommentSort;
  hasMoreComments: Dictionary<boolean>;
  isShowDeleted: boolean;
  loadingFollow: boolean | null;
  loadingSort: CommentSort | null;
  pinnedCommentIds: number[];
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
  pinnedCommentIds: [],
  topLevelCommentIds: [],
  topLevelCount: 0,
  total: 0,
  userFollow: false,
};

export default class UIStateStore extends Store {
  @observable account: AccountUIState = {
    client: null,
    isCreatingNewClient: false,
    newClientVisible: false,
  };

  chat = new ChatStateStore(this.root);

  // only for the currently visible page
  @observable comments = Object.assign({}, defaultCommentsUIState);

  private orderedCommentsByParentId: Dictionary<Comment[]> = {};

  exportCommentsUIState() {
    return {
      comments: this.comments,
      orderedCommentsByParentId: this.orderedCommentsByParentId,
    };
  }

  getOrderedCommentsByParentId(parentId: number) {
    this.populateOrderedCommentsForParentId(parentId);
    return this.orderedCommentsByParentId[parentId];
  }

  // TODO: all the methods below should be moved out

  @action
  importCommentsUIState(json: any) {
    this.comments = Object.assign({}, defaultCommentsUIState, json.comments);
    this.orderedCommentsByParentId = json.orderedCommentsByParentId;
  }

  @action
  initializeWithCommentBundleJSON(commentBundle: CommentBundleJSON) {
    this.comments.hasMoreComments = {};
    this.comments.hasMoreComments[commentBundle.has_more_id] = commentBundle.has_more;
    this.comments.currentSort = commentBundle.sort as CommentSort;
    this.comments.userFollow = commentBundle.user_follow;
    this.comments.topLevelCount = commentBundle.top_level_count ? commentBundle.top_level_count : 0;
    this.comments.total = commentBundle.total ? commentBundle.total : 0;

    if (commentBundle.comments != null) {
      this.comments.topLevelCommentIds = commentBundle.comments.map((x) => x.id);
    }

    this.updatePinnedCommentIds(commentBundle);

    this.orderedCommentsByParentId = {};
  }

  @action
  updateFromCommentsAdded(commentBundle: CommentBundleJSON) {
    this.comments.hasMoreComments[commentBundle.has_more_id] = commentBundle.has_more;
    if (commentBundle.top_level_count && commentBundle.total) {
      this.comments.topLevelCount = commentBundle.top_level_count;
      this.comments.total = commentBundle.total;
    }

    for (const json of commentBundle.comments) {
      const comment = new Comment(json);
      const parentId = comment.parentId;
      if (parentId == null) {
        this.comments.topLevelCommentIds.push(comment.id);
      } else {
        this.populateOrderedCommentsForParentId(parentId);
        this.orderedCommentsByParentId[parentId].push(comment);
      }
    }
  }

  @action
  updateFromCommentsNew(commentBundle: CommentBundleJSON) {
    if (commentBundle.top_level_count && commentBundle.total) {
      this.comments.topLevelCount = commentBundle.top_level_count;
      this.comments.total = commentBundle.total;
    }

    const comment = new Comment(commentBundle.comments[0]);
    const parentId = comment.parentId;
    if (parentId == null) {
      this.comments.topLevelCommentIds.unshift(comment.id);
    } else {
      this.populateOrderedCommentsForParentId(parentId);
      this.orderedCommentsByParentId[parentId].unshift(comment);
    }
  }

  @action
  updateFromCommentUpdated(commentBundle: CommentBundleJSON) {
    this.updatePinnedCommentIds(commentBundle);
  }

  private orderComments(comments: Comment[]) {
    switch (this.comments.currentSort) {
      case 'old':
        return orderBy(comments, 'createdAt', 'asc');
      case 'top':
        return orderBy(comments, 'votesCount', 'desc');
      default:
        return orderBy(comments, 'createdAt', 'desc');
    }
  }

  private populateOrderedCommentsForParentId(parentId: number) {
    if (this.orderedCommentsByParentId[parentId] == null) {
      const comments = this.root.commentStore.getRepliesByParentId(parentId);
      this.orderedCommentsByParentId[parentId] = this.orderComments(comments);
    }
  }

  private updatePinnedCommentIds(commentBundle: CommentBundleJSON) {
    if (commentBundle.pinned_comments != null) {
      this.comments.pinnedCommentIds = commentBundle.pinned_comments.map((x) => x.id);
    }
  }
}
