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

import Notification from 'models/notification';

interface CategoryMap {
  [key: string]: string;
}

export function categoryGroupKey(item: Notification) {
  if (item.objectId == null || item.name == null || item.category == null) {
    return null;
  }

  if (item.name === 'user_achievement_unlock') {
    return `achievement:${item.id}`;
  }

  return `${item.category}:${item.objectId}`;
}

export function categoryFromName(name: string) {
  return nameToCategory[name] ?? name;
}

export const nameToCategory: CategoryMap = {
  beatmapset_discussion_lock: 'beatmapset_discussion',
  beatmapset_discussion_post_new: 'beatmapset_discussion',
  beatmapset_discussion_qualified_problem: 'beatmapset_problem',
  beatmapset_discussion_unlock: 'beatmapset_discussion',
  beatmapset_disqualify: 'beatmapset_state',
  beatmapset_love: 'beatmapset_state',
  beatmapset_nominate: 'beatmapset_state',
  beatmapset_qualify: 'beatmapset_state',
  beatmapset_rank: 'beatmapset_state',
  beatmapset_reset_nominations: 'beatmapset_state',
  channel_message: 'channel',
  comment_new: 'comment',
  forum_topic_reply: 'forum_topic_reply',
  legacy_pm: 'legacy_pm',
  user_achievement_unlock: 'user_achievement_unlock',
};
