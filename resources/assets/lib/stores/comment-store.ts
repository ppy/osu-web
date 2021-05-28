// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';
import { UserLogoutAction } from 'actions/user-login-actions';
import { CommentJson } from 'interfaces/comment-json';
import { Dictionary } from 'lodash';
import { action, observable } from 'mobx';
import { Comment } from 'models/comment';

export default class CommentStore {
  @observable comments = observable.map<number, Comment>();
  @observable userVotes = new Set<number>();
  private groupedByParentId: Dictionary<Comment[]> = {};

  @action
  addUserVote(comment: Comment) {
    this.userVotes.add(comment.id);
  }

  @action
  addVoted(commentIds: number[] | undefined | null) {
    if (commentIds == null) return;
    commentIds.forEach((value) => this.userVotes.add(value));
  }

  @action
  flushStore() {
    this.invalidate();
    this.comments.clear();
    this.userVotes.clear();
  }

  getRepliesByParentId(parentId: number | null) {
    // indexers get converted to string and null becomes "null".
    return this.groupedByParentId[String(parentId)];
  }

  handleDispatchAction(dispatchedAction: DispatcherAction) {
    if (dispatchedAction instanceof UserLogoutAction) {
      this.flushStore();
    }
  }

  @action
  initialize(comments: CommentJson[] | undefined | null, votes: number[] | undefined | null) {
    this.flushStore();
    this.addVoted(votes);
    this.updateWithJson(comments);
  }

  @action
  removeUserVote(comment: Comment) {
    this.userVotes.delete(comment.id);
  }

  @action
  updateWithJson(data: CommentJson[] | undefined | null) {
    if (data == null) return;

    for (const json of data) {
      const comment = new Comment(json);
      const exists = this.comments.has(comment.id);
      this.comments.set(comment.id, comment);

      // assume already grouped if key exists
      if (!exists) {
        const key = String(comment.parentId);
        if (this.groupedByParentId[key] != null) {
          this.groupedByParentId[key].push(comment);
        } else {
          this.groupedByParentId[key] = [comment];
        }
      }
    }
  }

  private invalidate() {
    this.groupedByParentId = {};
  }
}
