// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Notification from 'models/notification';

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

// sync with app/Models/Notification.php
export const nameToCategory: Partial<Record<string, string>> = {
  beatmap_owner_change: 'beatmap_owner_change',
  beatmapset_discussion_lock: 'beatmapset_discussion',
  beatmapset_discussion_post_new: 'beatmapset_discussion',
  beatmapset_discussion_qualified_problem: 'beatmapset_problem',
  beatmapset_discussion_review_new: 'beatmapset_discussion',
  beatmapset_discussion_unlock: 'beatmapset_discussion',
  beatmapset_disqualify: 'beatmapset_state',
  beatmapset_love: 'beatmapset_state',
  beatmapset_nominate: 'beatmapset_state',
  beatmapset_qualify: 'beatmapset_state',
  beatmapset_rank: 'beatmapset_state',
  beatmapset_remove_from_loved: 'beatmapset_state',
  beatmapset_reset_nominations: 'beatmapset_state',
  channel_announcement: 'announcement',
  channel_message: 'channel',
  comment_new: 'comment',
  comment_reply: 'comment',
  forum_topic_reply: 'forum_topic_reply',
  team_application_accept: 'team_application',
  team_application_reject: 'team_application',
  team_application_store: 'team_application',
  user_achievement_unlock: 'user_achievement_unlock',
  user_beatmapset_new: 'user_beatmapset_new',
  user_beatmapset_revive: 'user_beatmapset_new',
};
