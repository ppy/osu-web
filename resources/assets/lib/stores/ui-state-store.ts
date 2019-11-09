/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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
  @observable account: AccountUIState = {
    client: null,
    isCreatingNewClient: false,
    newClientVisible: false,
  };

  chat = new ChatStateStore(this.root, this.dispatcher);

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
}
