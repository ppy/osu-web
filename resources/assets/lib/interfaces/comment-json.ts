// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJSON from 'interfaces/user-json';

export interface CommentableMetaJSON {
  id: number;
  title: string;
  type: string;
  url: string;
}

export interface CommentJSON {
  commentable_id: number;
  commentable_type: string;
  created_at: string;
  deleted_at: string | null;
  edited_at: string | null;
  edited_by_id: number | null;
  id: number;
  legacy_name: string | null;
  message: string;
  message_html: string;
  parent_id: number | null;
  pinned: boolean;
  replies_count: number;
  updated_at: string;
  user_id: number;
  votes_count: number;
}

export interface CommentBundleJSON {
  commentable_meta: CommentableMetaJSON[];
  comments: CommentJSON[];
  has_more: boolean;
  has_more_id: number;
  included_comments: CommentJSON[];
  pinned_comments: CommentJSON[];
  sort: string;
  top_level_count?: number;
  total?: number;
  user_follow: boolean;
  user_votes: number[];
  users: UserJSON[];
}
