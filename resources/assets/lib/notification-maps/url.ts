/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import { route } from 'laroute';
import LegacyPmNotification from 'models/legacy-pm-notification';
import Notification from 'models/notification';

export function urlGroup(item: Notification) {
  if (item.name === 'comment_new') {
    switch (item.objectType) {
      case 'beatmapset':
        return route('beatmapsets.show', { beatmapset: item.objectId });
      case 'build':
        return route('changelog.show', { changelog: item.objectId, key: 'id' });
      case 'news_post':
        return route('news.show', { news: item.objectId, key: 'id' });
    }
  }

  switch (item.objectType) {
    case 'beatmapset':
      return route('beatmapsets.discussion', { beatmapset: item.objectId });
    case 'channel':
      return route('chat.index', { sendto: item.sourceUserId });
    case 'forum_topic':
      return route('forum.topics.show', { topic: item.objectId, start: 'unread' });
  }
}

export function urlSingular(item: Notification) {
  if (item instanceof LegacyPmNotification) {
    return '/forum/ucp.php?i=pm&folder=inbox';
  }

  switch (item.name) {
    case 'beatmapset_discussion_lock':
    case 'beatmapset_discussion_unlock':
    case 'beatmapset_disqualify':
    case 'beatmapset_love':
    case 'beatmapset_nominate':
    case 'beatmapset_qualify':
    case 'beatmapset_reset_nominations':
      return route('beatmapsets.discussion', { beatmapset: item.objectId });
    case 'beatmapset_discussion_post_new':
    case 'beatmapset_discussion_qualified_problem':
      return BeatmapDiscussionHelper.url({
        beatmapId: item.details.beatmapId,
        beatmapsetId: item.objectId,
        discussionId: item.details.discussionId,
      });
    case 'beatmapset_rank':
      return route('beatmapsets.show', { beatmapset: item.objectId });
    case 'channel_message':
      return route('chat.index', { sendto: item.sourceUserId });
    case 'comment_new':
      return route('comments.show', { comment: item.details.commentId });
    case 'forum_topic_reply':
      return route('forum.posts.show', { post: item.details.postId });
    case 'user_achievement_unlock':
      return `${route('users.show', { user: item.details.userId })}#medals`;
  }
}
