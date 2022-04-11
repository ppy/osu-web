// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { CommentBundleJson } from 'interfaces/comment-json';
import { Dictionary, orderBy } from 'lodash';
import { action, makeObservable, observable } from 'mobx';
import { Comment, CommentSort } from 'models/comment';
import { OwnClient } from 'models/oauth/own-client';
import CommentStore from 'stores/comment-store';

interface AccountUIState {
  client: OwnClient | null;
  isCreatingNewClient: boolean;
  newClientVisible: boolean;
}

interface CommentsUIState {
  currentSort: CommentSort;
  hasMoreComments: Dictionary<boolean>;
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
  loadingFollow: null,
  loadingSort: null,
  pinnedCommentIds: [],
  topLevelCommentIds: [],
  topLevelCount: 0,
  total: 0,
  userFollow: false,
};

export default class UIStateStore {
  @observable account: AccountUIState = {
    client: null,
    isCreatingNewClient: false,
    newClientVisible: false,
  };

  // only for the currently visible page
  @observable comments = Object.assign({}, defaultCommentsUIState);

  private orderedCommentsByParentId: Dictionary<Comment[]> = {};

  constructor(protected commentStore: CommentStore) {
    makeObservable(this);
  }

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
  initializeWithCommentBundleJson(commentBundle: CommentBundleJson) {
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
  updateFromCommentUpdated(commentBundle: CommentBundleJson) {
    this.updatePinnedCommentIds(commentBundle);
  }

  @action
  updateFromCommentsAdded(commentBundle: CommentBundleJson) {
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
  updateFromCommentsNew(commentBundle: CommentBundleJson) {
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
      const comments = this.commentStore.getRepliesByParentId(parentId);
      this.orderedCommentsByParentId[parentId] = this.orderComments(comments);
    }
  }

  private updatePinnedCommentIds(commentBundle: CommentBundleJson) {
    if (commentBundle.pinned_comments != null) {
      this.comments.pinnedCommentIds = commentBundle.pinned_comments.map((x) => x.id);
    }
  }
}
