// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { CommentJson } from 'interfaces/comment-json';
import { computed } from 'mobx';

export type CommentSort = 'new' | 'old' | 'top';

export class Comment {
  commentableId: number;
  commentableType: string; // TODO: type?
  createdAt: string;
  deletedAt: string | null;
  editedAt: string | null;
  editedById: number | null;
  id: number;
  legacyName: string | null;
  message?: string;
  messageHtml?: string;
  parentId: number | null;
  pinned: boolean;
  repliesCount: number;
  updatedAt: string;
  userId: number | null;
  votesCount: number;

  constructor(json: CommentJson) {
    this.commentableId = json.commentable_id;
    this.commentableType = json.commentable_type;
    this.createdAt = json.created_at;
    this.deletedAt = json.deleted_at;
    this.editedAt = json.edited_at;
    this.editedById = json.edited_by_id;
    this.id = json.id;
    this.legacyName = json.legacy_name;
    this.message = json.message;
    this.messageHtml = json.message_html;
    this.parentId = json.parent_id;
    this.pinned = json.pinned;
    this.repliesCount = json.replies_count;
    this.updatedAt = json.updated_at;
    this.userId = json.user_id;
    this.votesCount = json.votes_count;
  }

  @computed
  get canDelete() {
    return this.canModerate || this.isOwner;
  }

  @computed
  get canEdit() {
    return this.canModerate || (this.isOwner && !this.isDeleted);
  }

  @computed
  get canHaveVote() {
    return !this.isDeleted;
  }

  @computed
  get canModerate() {
    return currentUser.is_admin || currentUser.is_moderator;
  }

  @computed
  get canPin() {
    return currentUser.is_admin && (this.parentId == null || this.pinned);
  }

  @computed
  get canReport() {
    return currentUser.id != null && this.userId !== currentUser.id;
  }

  @computed
  get canRestore() {
    return this.canModerate;
  }

  @computed
  get canVote() {
    return !this.isOwner;
  }

  @computed
  get isDeleted() {
    return this.deletedAt != null;
  }

  @computed
  get isEdited() {
    return this.editedAt != null;
  }

  @computed
  get isOwner() {
    return currentUser.id != null && this.userId === currentUser.id;
  }
}
