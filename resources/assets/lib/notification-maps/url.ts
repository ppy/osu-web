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

import LegacyPmNotification from 'models/legacy-pm-notification';
import Notification from 'models/notification';

function legacyPmUrl() {
  return '/forum/ucp.php?i=pm&folder=inbox';
}

export function urlGroup(item: Notification) {
  if (item instanceof LegacyPmNotification) {
    return legacyPmUrl();
  }

  let route: string = '';
  let params: any;

  switch (item.objectType) {
    case 'beatmapset':
      route = 'beatmapsets.discussion';
      params = { beatmapset: item.objectId };
      break;
    case 'forum_topic':
      route = 'forum.topics.show';
      params = { topic: item.objectId, start: 'unread' };
      break;
  }

  if (route != null) {
    return laroute.route(route, params);
  }
}

export function urlOne(item: Notification) {
  if (item instanceof LegacyPmNotification) {
    return legacyPmUrl();
  }

  let route: string = '';
  let params: any;

  switch (item.name) {
    case 'beatmapset_discussion_lock':
      route = 'beatmapsets.discussion';
      params = { beatmapset: item.objectId };
      break;
    case 'beatmapset_discussion_post_new':
      return BeatmapDiscussionHelper.url({
        beatmapId: item.details.beatmapId,
        beatmapsetId: item.objectId,
        discussionId: item.details.discussionId,
      });
    case 'beatmapset_discussion_unlock':
      route = 'beatmapsets.discussion';
      params = { beatmapset: item.objectId };
      break;
    case 'beatmapset_disqualify':
      route = 'beatmapsets.discussion';
      params = { beatmapset: item.objectId };
      break;
    case 'beatmapset_love':
      route = 'beatmapsets.show';
      params = { beatmapset: item.objectId };
      break;
    case 'beatmapset_nominate':
      route = 'beatmapsets.discussion';
      params = { beatmapset: item.objectId };
      break;
    case 'beatmapset_qualify':
      route = 'beatmapsets.discussion';
      params = { beatmapset: item.objectId };
      break;
    case 'beatmapset_reset_nominations':
      route = 'beatmapsets.discussion';
      params = { beatmapset: item.objectId };
      break;
    case 'forum_topic_reply':
      route = 'forum.posts.show';
      params = { post: item.details.postId };
      break;
  }

  if (route != null) {
    return laroute.route(route, params);
  }
}
