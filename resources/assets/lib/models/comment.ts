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

import { CommentJSON } from 'interfaces/comment-json';
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
  message: string;
  messageHtml: string;
  parentId: number | null;
  pinned: boolean;
  repliesCount: number;
  updatedAt: string;
  userId: number;
  votesCount: number;

  constructor(json: CommentJSON) {
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
