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

import { UserJSON } from 'chat/chat-api-responses';

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
