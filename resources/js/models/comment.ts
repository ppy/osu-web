// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import CommentsController from 'components/comments-controller';
import CommentJson from 'interfaces/comment-json';
import { computed, makeObservable } from 'mobx';
import core from 'osu-core-singleton';

export function canModerateComments(): boolean {
  return core.currentUser != null && (core.currentUser.is_admin || core.currentUser.is_moderator);
}

export type CommentSort = 'new' | 'old' | 'top';

export default class Comment {
  commentableId: number;
  commentableType: string; // TODO: type?
  createdAt: string;
  deletedAt: string | null;
  deletedById?: number | null;
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

  constructor(json: CommentJson, private readonly controller: CommentsController) {
    this.commentableId = json.commentable_id;
    this.commentableType = json.commentable_type;
    this.createdAt = json.created_at;
    this.deletedAt = json.deleted_at;
    this.deletedById = json.deleted_by_id;
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

    makeObservable(this);
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
  get canReply() {
    if (this.isDeleted) {
      return false;
    }

    const meta = this.controller.getCommentableMeta(this);

    if (
      'current_user_attributes' in meta &&
      meta.current_user_attributes.can_new_comment_reason == null
    ) {
      return true;
    }

    return 'locked' in meta && !meta.locked;
  }

  @computed
  get canHaveVote() {
    return !this.isDeleted;
  }

  @computed
  get canModerate() {
    return canModerateComments();
  }

  @computed
  get canPin() {
    if (core.currentUser == null || (this.parentId != null && !this.pinned)) {
      return false;
    }

    if (core.currentUser.is_admin) {
      return true;
    }

    if (
      this.commentableType !== 'beatmapset' ||
      (!this.pinned && this.controller.state.pinnedCommentIds.length > 0)
    ) {
      return false;
    }

    if (this.canModerate) {
      return true;
    }

    if (!this.isOwner) {
      return false;
    }

    const meta = this.controller.getCommentableMeta(this);

    return meta != null && 'owner_id' in meta && meta.owner_id === core.currentUser.id;
  }

  @computed
  get canReport() {
    return core.currentUser != null && this.userId !== core.currentUser.id;
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
  get isVisible(): boolean {
    return !this.isDeleted || this.visibleReplyCount > 0;
  }

  @computed
  get isOwner() {
    return core.currentUser != null && this.userId === core.currentUser.id;
  }

  @computed
  get visibleReplyCount() {
    const baseCount = this.repliesCount;
    if (canModerateComments()) {
      return baseCount;
    }

    const deletedCount = this.controller.getReplies(this).filter((reply) => !reply.isVisible).length;

    return Math.max(0, baseCount - deletedCount);
  }

  toJson(): CommentJson {
    return {
      commentable_id: this.commentableId,
      commentable_type: this.commentableType,
      created_at: this.createdAt,
      deleted_at: this.deletedAt,
      deleted_by_id: this.deletedById,
      edited_at: this.editedAt,
      edited_by_id: this.editedById,
      id: this.id,
      legacy_name: this.legacyName,
      message: this.message,
      message_html: this.messageHtml,
      parent_id: this.parentId,
      pinned: this.pinned,
      replies_count: this.repliesCount,
      updated_at: this.updatedAt,
      user_id: this.userId,
      votes_count: this.votesCount,
    };
  }
}
